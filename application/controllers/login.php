<?php

/**
 * Login 
 * 
 * controllers/login.php
 *
 * ------------------------------------------------------------------------
 */
class Login extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  Default entry point.
    //-------------------------------------------------------------

    function index() {
        redirect('/');
    }

    // Process a login
    function submit() {
        $key = $_POST['id'];
        $password = md5($_POST['password']);


        $user = $this->users->get($key);
        // what if no such user
        if ($user == null) {
            echo 'No such user<br/>';
            redirect('/');
        }
        
        //check the password
        if ($user->status == 'A' && $password == (string) $user->password) {

            $user->last_visit = date('Y-m-d H:i:s');
            $this->users->update($user);

            $this->session->set_userdata('user_id', $key);
            $this->session->set_userdata('user_name', $user->user_name);
            $this->session->set_userdata('display_name', $user->display_name);
            $this->session->set_userdata('userRole', $user->role);
            
            //session_start();
            //$_SESSION['KCFINDER'] = array();
            //$_SESSION['KCFINDER']['disabled'] = false;
        }     
        
        redirect("/");
    }

}

/* End of file login.php */
/* Location: application/controllers/login.php */