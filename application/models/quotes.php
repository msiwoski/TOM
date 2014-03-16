<?php

/*
 * Quotes model, rotating quotes throughout the website
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Quotes extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('quotes', 'id');
        //$this->db->order_by('role asc, id asc');
    }
    function getRandomQuote(){
        $quotes = $this->getAll_array();
        $size = count($quotes);
        return $quotes[rand(0, $size-1)];
    }

}