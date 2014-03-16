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
        $this->index($parameter);
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
    
    function edit($id=null){
       if ($id == null){
            redirect('/');
        }
        $users = (array)$this->users->get($id);
        $this->data['title'] .= " Edit Profile";
        $this->data['pagebody'] = 'editprofile';
        $this->data['users'] = $users;
        $this->data = array_merge($this->data, $users);
        $this->render();
    }
}