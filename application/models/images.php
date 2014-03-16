<?php

/*
 * Deal with the media photos
 * 
 */

class Images extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('images', 'id', 'filename');
    }

}