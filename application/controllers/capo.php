<?php

/*
 * 
 * XML-RPC stuff for website.
 * 
 */

class Capo extends CI_Controller {
    
    var $remote_port = 90;
    var $remote_name = '';
    
    var $code = 'o01';
    var $name = 'Thirst Of Man';
    var $slug = 'Modern beer drinking beer reviews';
    var $link = 'thirstofman.bcitxml.com';
    
    
    function __construct() {
        parent::__construct();
        $this->load->library('xmlrpc');
        $this->load->library('xmlrpcs');
    }
    
    function index() {
        
        $config['functions']['capo.info'] = array('function' => 'Capo.handle_info');
        $config['functions']['info'] = array('function' => 'Capo.handle_info');
        $config['functions']['capo.latest'] = array('function' => 'Capo.handle_latest');
        $config['functions']['latest'] = array('function' => 'Capo.handle_latest');
        $config['functions']['capo.posts'] = array('function' => 'Capo.handle_posts');
        $config['functions']['posts'] = array('function' => 'Capo.handle_posts');
        $config['functions']['capo.post'] = array('function' => 'Capo.handle_post');
        $config['functions']['post'] = array('function' => 'Capo.handle_post');
        $config['object'] = $this;

        $this->xmlrpcs->initialize($config);
        $this->xmlrpcs->serve();
    }
    
    // Return our blog description, from some of our property values
    function handle_info($request = null) {
        // build our raw response. 
        $answer = array(
            array('code' => array($this->code, 'string')),
            array('name' => array($this->name, 'string')),
            array('link' => array($this->link, 'string')),
            array('plug' => array($this->slug, 'string')),
        );

        // wrap it for XML-RPC
        $response = array();
        foreach ($answer as $row)
            $response[] = array($row, 'struct');
        $response = array($response, 'struct');

        return $this->xmlrpc->send_response($response);
    }

    // Return our most recent post
    function handle_latest($request = null) {
        // get the post
        $newest = $this->posts->newest(); // this gives us our last 3
        $latest = $newest[0];   // and this gives us the latest
        //
        // print_r($latest);exit;
        // build our raw response. 
        $answer = $this->prepare($latest);

        // wrap it for XML-RPC
        $response = array();
        foreach ($answer as $row)
            $response[] = array($row, 'struct');
        $response = array($response, 'struct');

        return $this->xmlrpc->send_response($response);
    }

    // Return a specific post
    function handle_post($request = null) {
        if ($request == null) {
            $which = 2; // local testing assumption
        } else {
            $parameters = $request->output_parameters();
            $which = $parameters[0];
        }

        // get the post
        $thepost = (array) $this->posts->get($which);

        // build our raw response. 
        $answer = $this->prepare($thepost);

        // wrap it for XML-RPC
        $response = array();
        foreach ($answer as $row)
            $response[] = array($row, 'struct');
        $response = array($response, 'struct');

        return $this->xmlrpc->send_response($response);
    }

    // Return all our posts
    function handle_posts($request = null) {
        // get the posts
        $theposts = $this->posts->getAll_array();

        // build our raw response. 
        $answer = array();
        foreach ($theposts as $onepost){
            $part = $this->preparex($onepost);

            $answer[] = array($part, 'struct');
        }

        // wrap it for XML-RPC
        $response = array($answer, 'struct');

        return $this->xmlrpc->send_response($response);
    }


     // Package a blog post entry as an XML-RPC response
    function prepare($record) {
        // build our raw response, tailored to our blog post columns
        $answer = array(
            // our syndication id
            array('code' => $this->code),
            // our post id
            array('id' => $record['id']),
            // our post date
            array('datetime' => $record['date_posted']),
            // a link to our post
            array('link' => $this->link . '/reviews/post/' . $record['id']),
            // blog post title
            array('title' => $record['post_title']),
            // slug for our post
            array('slug' => $record['slug']),
        );
        return $answer;
    }
      // Package a blog post entry as part of a multi-post an XML-RPC response
    function preparex($record) {
        // build our raw response, tailored to our blog post columns
        $answer = array(
            // our syndication id
            'code' => $this->code,
            // our post id
            'id' => $record['id'],
            // our post date
            'datetime' => $record['date_posted'],
            // a link to our post
            'link' => $this->link . '/reviews/post/' . $record['id'],
            // blog post title
            'title' => $record['post_title'],
            // slug for our post
            'slug' => $record['slug'],
        );
        return $answer;
    }
    
}