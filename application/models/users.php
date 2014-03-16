<?php
/*
 * Users model
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Users extends _Mymodel {

    // Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('users', 'user_name');
    }

}

/* End of file users.php */
/* Location: application/models/users.php */