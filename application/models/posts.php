<?php
/*
 * Posts model
 */
class Posts extends _Mymodel {

// Constructor
    function __construct() {
        parent::__construct();
        $this->setTable('posts', 'id');
    }
    
    function newest() {
        $this->db->order_by('date_posted', 'desc');
        $this->db->limit(3);
        $query = $this->db->get($this->_tableName);
        return $query->result_array();
    }
    
    function get_posts() {
        $this->db->order_by('date_posted', 'desc');
        $query = $this->db->get($this->_tableName);
        return $query->result_array();
    }
    
    function get_posts_from_month($year, $month) {
        $this->db->order_by('date_posted', 'desc');
        $query = $this->db->get_where($this->_tableName, array('YEAR(date_posted)' => $year, 'MONTH(date_posted)' => $month));
        return $query->result_array();
    }
    
    function get_posts_with_category($cat) {
        $this->db->order_by('date_posted', 'desc');
        $query = $this->db->get_where($this->_tableName, array('category_id' => $cat));
        return $query->result_array();
    }
    
    function get_posts_from_user($user) {
        $this->db->order_by('date_posted', 'desc');
        $query = $this->db->get_where($this->_tableName, array('user_id' => $user));
        return $query->result_array();
    }
    
}