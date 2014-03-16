<?php

/**
 * Our Contact page.
 * 
 * controllers/contact.php
 *
 * ------------------------------------------------------------------------
 */
class Contact extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('quotes');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] .= 'Contact Us';
        $this->data['pagebody'] = 'contact';
         $this->data['quotes'] = array($this->quotes->getRandomQuote(), $this->quotes->getRandomQuote());
        $this->render();
    }

}

/* End of file gallery.php */
/* Location: application/controllers/gallery.php */