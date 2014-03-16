<?php

/*
 * Post tags model
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class PostTags extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('postTags', 'post_id', 'tag_id');
        //$this->db->order_by('role asc, id asc');
    }

}