<?php

/**
 * Our about page.
 * 
 * controllers/about.php
 *
 * ------------------------------------------------------------------------
 */
class About extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('users');
        $this->load->model('quotes');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Who is Thirst of Man?';
        $this->data['pagebody'] = 'about';
        $this->data['users'] = $this->users->getAll_array();
        $this->data['quotes'] = array($this->quotes->getRandomQuote(), $this->quotes->getRandomQuote());
        $this->render();
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */