<?php

/**
 * Profiles.
 * 
 * controllers/profiles.php
 *
 * ------------------------------------------------------------------------
 */

class Profiles extends Application {

    function __construct() {
        parent::__construct();
    }
    
    function _remap($parameter){
        if($parameter == 'edit'){
            $this->edit();
        } else if ($parameter == 'submit'){
            $this->submit();
        }else
        {
            $this->index($parameter);
        }
    }
    
    //-------------------------------------------------------------
    //  The Profile page layout
    //-------------------------------------------------------------

    function index($id=null) {
        if ($id == null){
            redirect('/');
        }
        $users = (array)$this->users->get($id);
        $this->data['title'] .= " Profile";
        $this->data['pagebody'] = 'profile';
        $this->data['users'] = $users;
        $this->data = array_merge($this->data, $users);
        $this->render();
    }
    
    function edit(){
        $user = (array)$this->users->get($this->session->userdata('user_id'));
        
        $this->data['title'] .= " Edit Profile";
        $this->data['pagebody'] = 'editprofile';
        
        $this->data['display_name']     = makeTextField("Display Name", 'display_name', $user['display_name']);
        $this->data['job_title']        = makeTextField("Job Title", 'job_title', $user['job_title']);
        $this->data['image']            = makeImageUpload('Image', 'image', 'image',  $user['about_image'], '/data/images/');
        $this->data['about_profile']    = makeEditorField('about_profile', 'about_profile', $user['about_profile']);
        $this->data['submit']           = makeNormalButtonField('Submit', 'submit', '#');
        
        $this->render();
    }
        
    function submit() {
        $user = $this->users->get($this->session->userdata('user_id'));
        $this->data['errors'] = array();
        
        if ($user == null) {
            redirect('/');
        }
        
        
        //check for validity
        if (!isset($_POST['display_name']) ||
            strlen($_POST['display_name']) == 0) {
            
            $this->data['errors'][] = "You need a Display Name.";
            
        }
        if (!isset($_POST['job_title']) ||
            strlen($_POST['job_title']) == 0) {
            
            $this->data['errors'][] = "You need a job title.";
            
        }
        if (!isset($_POST['about_profile']) ||
            strlen($_POST['about_profile']) == 0) {
            
            $this->data['errors'][] = "You need a profile.";
        }
        
        
        //upload image
        $config['upload_path'] = './data/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000048';
        $config['max_width']  = '10024';
        $config['max_height']  = '7068';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('about_image')) {
             $file_data = (array)$this->upload->data();
             $user->about_image = $file_data['file_name'];
            }
        
        
        if (count($this->data['errors']) > 0) {
            foreach ($this->data['errors'] as $err) {
                echo "<p>" . $err . "</p>";
            }
            return;
        }
        
        $user->display_name     = $_POST['display_name'];
        $user->job_title        = $_POST['job_title'];
        $user->about_profile    = $_POST['about_profile'];
       
        
        
        $this->users->update($user);
        
        redirect('/profiles/' . $user->user_name);
    }
}