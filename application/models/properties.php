<?php

/*
 * properties model
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Properties extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('properties', 'key');
    }

}