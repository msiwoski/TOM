<?php
/*
 * Recipes model
 */
class Recipes extends _Mymodel {

// Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('posts', 'id');
    }
    
}