<?php

/*
 * Update site description
 */

class UpdateDescription extends Application {
    
    function __construct() {
        parent::__construct();
        $this->restrict(ROLE_ADMIN);
        $this->load->model('properties');
    }
    
    function index() {
        
        $this->data['title']     .= "Site Description";
        $this->data['pagebody']  = 'updatedescription';
        
        $this->data['boss_name'] = makeTextField("Boss Name:", "boss_name", "showcase.bcitxml.com");
        $this->data['boss_port'] = makeNumericField("Boss Port:", "boss_port", 0, 65535, 80);
        $this->data['site_desc'] = makeTextField("Site Description:", "desc", $this->properties->get('slug')->value);
        $this->data['submit']    = makeNormalButtonField('Submit', 'submit', '#');
        
        $this->render();
    }
    
    function submit() {
        
        if (!isset($_POST['desc']) || strlen($_POST['desc']) == 0) {
            redirect('/');
        }
        
        $slug = $this->properties->get('slug');
        $slug->value = $_POST['desc'];
        
        $this->properties->update($slug);
        
        
        $notification = array();
        $notification[] = $this->properties->get('code')->value;
        $notification[] = $this->properties->get('name')->value;
        $notification[] = $this->properties->get('link')->value;
        $notification[] = $this->properties->get('slug')->value;
        
        $this->load->library('xmlrpc');
        
        $this->xmlrpc->server('http://' . $_POST['boss_name'] . ':' . $_POST['boss_port'] . '/boss');
        $this->xmlrpc->method('update');
        
        $this->xmlrpc->request($notification);
        
        if (!$this->xmlrpc->send_request()) {
            echo $this->xmlrpc->display_error();
            exit();
        }
        
        redirect('/');
    }
    
}