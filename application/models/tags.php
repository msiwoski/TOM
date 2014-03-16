<?php
/*
 * Tags model
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Tags extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('tags', 'id');
        //$this->db->order_by('role asc, id asc');
    }

}