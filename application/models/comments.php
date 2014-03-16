<?php

/*
 * Comments model
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Comments extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('comments', 'id');
        //$this->db->order_by('role asc, id asc');
    }

}