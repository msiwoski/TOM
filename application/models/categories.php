<?php
/*
 * categories model
 */


if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Categories extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('categories', 'id');
        //$this->db->order_by('role asc, id asc');
    }
}