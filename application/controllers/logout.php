<?php

/**
 * Logout
 * 
 * controllers/logout.php
 *
 * ------------------------------------------------------------------------
 */
class Logout extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  destory session
    //-------------------------------------------------------------

    function index() {
        $this->session->sess_destroy();
        
        redirect('/');
    }

}

/* End of file logout.php */
/* Location: application/controllers/logout.php */
