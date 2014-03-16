<?php

/**
 * controllers/usermaintenance.php
 *
 * User table maintenance
 *
 * ------------------------------------------------------------------------
 */
class UserMaintenance extends Application {

    function __construct() {
        parent::__construct();
        $this->restrict(ROLE_ADMIN);
        //$this->db->order_by('role asc, id asc');
    }

    //-------------------------------------------------------------
    //  Show the user list
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] .= "Users";
        $users = $this->users->getAll_array();
        $this->data['users'] = $users;
        $this->data['pagebody'] = 'userlist';
        $this->render();
    }

    //-------------------------------------------------------------
    //  Trigger adding a new user
    //-------------------------------------------------------------

    function add() {
        $this->data['title'] .= "Add a User";
        $user = (array) $this->users->create();
        $this->data = array_merge($this->data, $user);
        $this->data['id'] = '';
        $this->data['pagebody'] = 'useredit';
        
        $roles = array();
        $roles[ROLE_ADMIN] = 'Admin';
        $roles[ROLE_USER] = 'User';
        
        $status = array();
        $status['A'] = "Active";
        $status['D'] = "Disabled";
        
        $this->data['user_name'] = makeTextField("User Name:", "user_name");
        $this->data['user_display'] = makeTextField("User Display:", "display_name");
        $this->data['user_password'] = makePasswordField("Password:", "password");
        $this->data['user_role'] = makeComboboxField("Role", "role", $roles, ROLE_USER);
        $this->data['user_email'] = makeTextField("Email:", "email");
        $this->data['user_status'] = makeComboboxField("Status:", "status", $status);
        
        
        $this->render();
    }

    // Request a user edit
    function edit($id) {
        $this->data['title'] .= "Edit a User";
        $user = (array) $this->users->get($id);
        $this->data = array_merge($this->data, $user);
        $this->data['id'] = $user['user_name'];
        $this->data['password'] = ''; // assume password to remain the same
        $this->data['pagebody'] = 'useredit';
        
        $roles = array();
        $roles[ROLE_ADMIN] = 'Admin';
        $roles[ROLE_USER] = 'User';
        
        $status = array();
        $status['A'] = "Active";
        $status['D'] = "Disabled";
        
        $this->data['user_name'] = makeTextField("User Name:", "user_name", $user['user_name']);
        $this->data['user_display'] = makeTextField("User Display:", "display_name", $user['display_name']);
        $this->data['user_password'] = makePasswordField("Password:", "password");
        $this->data['user_role'] = makeComboboxField("Role", "role", $roles, $user['role']);
        $this->data['user_email'] = makeTextField("Email:", "email", $user['email']);
        $this->data['user_status'] = makeComboboxField("Status:", "status", $status, $user['status']);
        
        $this->render();
    }

    // Process an add/edit form submission
    function submit($id = null) {
        $this->data['errors'] = array();
        // the form fields we are interested in
        $user_fields = array('user_name', 'display_name', 'password', 'email', 'role', 'status');
        $user = array();
        // either create or retrieve the relevant user record
        if ($id == null) {
            $user = $this->users->create();
        }
        else {
            $user = $this->users->get($id);
        }
        // over-ride the user record fields with submitted values
        fieldExtract($_POST, $user, $user_fields);
        
        // validate the user fields
        if (empty($_POST['user_name']))
            $this->data['errors'][] = 'You need to specify a username';
        if ($id == null && $this->users->exists($_POST['user_name']))
            $this->data['errors'][] = 'That username is already used';
        if (strlen($user->user_name) < 1)
            $this->data['errors'][] = 'You need a user name';
        if (strlen($user->email) < 1)
            $this->data['errors'][] = 'You need an email address';
        if (!strpos($user->email, '@'))
            $this->data['errors'][] = 'The email address is missing the domain';
        if ($id == null && empty($user->password))
            $this->data['errors'][] = 'You must specify a password';
        // if errors, redisplay the form
        
        if (count($this->data['errors']) > 0) {
            // over-ride the view parameters to reflect our data
            $this->data = array_merge($this->data, (array) $user);
            $this->data['pagebody'] = 'useredit';
            $this->render();
            exit;
        }

        // handle the password specially, as it needs to be encrypted
        $new_password = $_POST['password'];
        if (!empty($new_password)) {
            $new_password = md5($new_password);
            if ($new_password != $user->password)
                $user->password = $new_password;
        }

        // either add or update the user record, as appropriate
        if ($id == null) {
            $this->users->add($user);
        } else {
            $this->users->update($user);
        }
        // redisplay the list of users
        redirect('/usermaintenance');
    }

    // Delete a user
    function delete($id) {
        $this->users->delete($id);
        $this->index();
    }

}

/* End of file usermaintenance.php */
/* Location: ./system/application/controllers/usermaintenance.php */