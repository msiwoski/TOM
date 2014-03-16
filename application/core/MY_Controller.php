<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2013, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = 'Thirst of Man: ';
        $this->errors = array();
        $this->data['pageTitle'] = '??';
    }

    /**
     * Render this page
     */
    function render() {
        $this->data['menubar'] = $this->build_menu_bar($this->config->item('menu_choices'));
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);
        $this->data['sessionid'] = $this->session->userdata('session_id');    
        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->data['login'] = $this->build_login();
        
        
        $newest_posts = $this->posts->newest();
        foreach($newest_posts as $post) {
            $tmp_post = array();
            
            $tmp_post['newest_date_posted'] = date(DATE_FORMAT, strtotime($post['date_posted']));
            $tmp_post['newest_post_title'] = $post['post_title'];
            $tmp_post['newest_slug'] = $post['slug'];
            $tmp_post['newest_id'] = $post['id'];
            
            $this->data['newest_posts'][] = $tmp_post;
        }
        
        $this->data['caboose_styles'] = $this->caboose->styles();
        $this->data['caboose_scripts'] = $this->caboose->scripts();
        $this->data['caboose_trailings'] = $this->caboose->trailings();
        
        
        $this->parser->parse('_template', $this->data);
    }

    /**
     * Build an unordered list of linked items, such as used for a menu bar.
     * @param mixed $choices Array of name=>link pairs
     */
    function build_menu_bar($choices) {
        $menudata = array();
        foreach ($choices as $name => $link)
            $menudata['menudata'][] = array('menulink' => $link, 'menuname' => $name);
        return $this->parser->parse('_menubar', $menudata, true);
    }

     /**
     * Build the collection of stuff that should appear down the right.
     * This will be empty for now.
     */
    function build_login() {
        $result = '';

        if ($this->session->userdata('user_id')) {
            // show user name etc
            $side_data = $this->session->all_userdata();
            $side_data['secret_menu'] = '';
            if ($this->session->userdata('userRole') == 'admin')
                $side_data['secret_menu'] = $this->parser->parse('_admin', $side_data, true);
            
            $result .= $this->parser->parse('_loggedin', $side_data, true);
        } else {
            // show the login form
            $this->data['login_id'] = makeTextField("User:", "id");
            $this->data['login_password'] = makePasswordField("Password:", "password");
            $this->data['login_hidden'] = makeHiddenField("Comment:", "comment");
            $this->data['login_button'] = makeBigButtonField("Login", "login");
            
            $result .= $this->parser->parse('_login', $this->data, true);
        }
        return $result;
    }
    
    /**
     * Enforce role-based authentication.
     * @param string $roleNeeded 
     */
    function restrict($roleNeeded = null) {
        // if we need a role, turn away anyone without the right role
        if ($roleNeeded != null) {
            $userRole = $this->session->userdata('userRole');
            if (!$userRole) {
                // no one is logged in, goodbye
                redirect("/");
                exit;
            }
            // logged in. check the role they have
            if (is_array($roleNeeded)) {
                if (!in_array($userRole, $roleNeeded)) {
                    // Not authorized. Redirect to home page
                    redirect("/");
                    exit;
                }
            } elseif ($userRole != $roleNeeded) {
                redirect("/");
                exit;
            }
        }
    }
    
    
    
    
}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */