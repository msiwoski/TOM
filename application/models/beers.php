<?php

/*
 * beers model
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Beers extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('beers', 'id');
        //$this->db->order_by('role asc, id asc');
    }

}