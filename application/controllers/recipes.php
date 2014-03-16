<?php

/**
 * Recipes
 * 
 * controllers/recipes.php
 *
 * ------------------------------------------------------------------------
 */
class Recipes extends Application {

    function __construct() {
        parent::__construct();
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] .= ' Recipes';
        $this->data['pagebody'] = 'recipe';
        $this->render();
    }

}

/* End of file welcome.php */
/* Location: application/controllers/welcome.php */