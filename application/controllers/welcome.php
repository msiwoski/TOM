<?php

/**
 * Our homepage.
 * 
 * controllers/welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('quotes');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] = 'Thirst of Man: Modern Beer Reviews';
        $this->data['pagebody'] = 'welcome';
        $this->data['quotes'] = array($this->quotes->getRandomQuote(), $this->quotes->getRandomQuote());
        $this->render();
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */