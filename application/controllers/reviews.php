<?php

/**
 * Blog Reviews.
 * 
 * controllers/reviews.php
 *
 * ------------------------------------------------------------------------
 */
class Reviews extends Application {

    function __construct() {
        parent::__construct();
        $this->load->model('posts');
        $this->load->model('categories');
        $this->load->model('images');
    }

    //-------------------------------------------------------------
    //  The normal pages
    //-------------------------------------------------------------

    function index() {
        $this->page(1);
    }
    
    
    
    function build_page($page_num, $posts, $pagination_link) {
        
        $this->data['pagebody'] = 'reviews';
        $this->data['posts'] = $this->build_posts($page_num, $posts);
        $this->data['pagination'] = $this->build_pagination($page_num, ceil(count($posts) / POSTS_PER_PAGE), $pagination_link);
        
        $this->data['archives'] = $this->build_archives($this->posts->get_posts());
        $this->data['categories'] = $this->build_categories($this->categories->getAll_array());
        $this->data['featured_blogs'] = $this->build_featured_blogs();
    }
    
    function build_posts($page_num, $posts) {
        
        $out_posts = array();
        
        $first_post = $page_num * POSTS_PER_PAGE;
        $last_post = $first_post + POSTS_PER_PAGE;
        
        for($i = $first_post; $i < $last_post; $i++) {
            if ($i >= count($posts))
                break;
            
            $tmp_post = $posts[$i];
            
            $tmp_post['date_posted'] = date(DATE_FORMAT, strtotime($tmp_post['date_posted']));
            $tmp_post['user'] = $this->users->get($tmp_post['user_id'])->display_name;
            $tmp_post['category'] = $this->categories->get($tmp_post['category_id'])->category;
            $tmp_post['category_link'] = '/reviews/categories/' . $tmp_post['category_id'];
            $tmp_post['image'] = $this->images->get($tmp_post['image_id'])->filename;
            
            $out_posts[] = $tmp_post;
        }
        
        return $out_posts;
    }
    
    function build_pagination($current_page, $total_pages, $link) {
        
        $start_page = $current_page - floor(PAGINATION_PAGES / 2);
        if ($start_page < 0)
            $start_page = 0;
        
        $end_page = $start_page + PAGINATION_PAGES;
        if ($end_page >= $total_pages) {
            
            $start_page -= ($end_page - $total_pages);
            if ($start_page < 0)
                $start_page = 0;
                    
            $end_page = $total_pages;
        }
        
        $pagination_pages = "";
        for($i = $start_page; $i < $end_page; $i++) {
            $page_params = array();
            $page_params['page'] = $i + 1;
            
            if ($i == $current_page) {
                $pagination_pages .= $this->parser->parse("/reviewnavigation/_reviewnavigationpageselected", $page_params, true);
            }
            else {
                $page_params['link'] = $link . $page_params['page'];
                $pagination_pages .= $this->parser->parse("/reviewnavigation/_reviewnavigationpage", $page_params, true);
            }
        }
        
        $params = array();
        
        $params['pages'] = $pagination_pages;
        $params['prev'] = $link . $current_page;
        $params['next'] = $link . ($current_page + 2);
        
        if ($params['prev'] < 1)
            $params['prev'] = 1;
        if ($params['next'] >= $total_pages)
            $params['next'] = $total_pages;
        
        
        return $this->parser->parse("/reviewnavigation/_reviewnavigation", $params, true);
    }
    
    function build_archives($posts) {
        $archives = array();
        $used = array();
        
        foreach($posts as $post) {
            
            $arch = date('F Y', strtotime($post['date_posted']));
            
            if (!in_array($arch, $used)) {
                $used[] = $arch;
                $archives[] = array('date' => $arch, 'link' => '/reviews/archives/' . date('Y-m', strtotime($post['date_posted'])));
            }
            
        }
        
        return $archives;
    }
    
    function build_categories($categories) {
        
        $list = array();
        
        foreach($categories as $cat) {
            
            $list[] = array('type' => $cat['category'], 'link' => '/reviews/categories/' . $cat['id']);
            
        }
        
        return $list;
    }
    
    function build_featured_blogs() {
        $links = array(
            /*array(
                "date" => "Feb 23",
                "name" => "Vancouver Pub Reviews",
                "url" => "http://vancouverpubreviews.bcitxml.com/",
                "description" => "This website is a pub review website."
            ),
            array(
                "date" => "Feb 28",
                "name" => "Canadian Hockey Fans",
                "url" => "http://chf.bcitxml.com",
                "description" => "Beer goes well with hockey."
            ),
            array(
                "date" => "Apr 16",
                "name" => "The Newest Innovation On Wooden",
                "url" => "/reviews",
                "description" => "You can replace all this text with your own text. What’s more, they’re absolutely free!"
            )*/
        );
        
        return $links;
    }
    
    
    function page($page_num = 1) {
        
        if (!is_numeric($page_num))
            $page_num = 1;
        
        $page_num = (int)$page_num - 1;
        
        $posts = $this->posts->get_posts();
        
        $this->data['title'] .= ' Reviews';
        
        $this->build_page($page_num, $posts, '/reviews/page/');
        $this->render();
    }
    
    function post($which) {
        // get the post
        $record = (array) $this->posts->get($which);
        
        if ($record == null) {
            $this->index();
        }
        else {
            $this->data = array_merge($this->data, $record);

            $this->data['date_posted'] = date(DATE_FORMAT, strtotime($this->data['date_posted']));

            // get any images/users/category associated with it
            $this->data['images'] = $this->images->querySomeMore('id', $record['image_id']);
            $this->data['user'] = $this->users->get($record['user_id'])->display_name;
            $this->data['category'] = $this->categories->get($record['category_id'])->category;
            $this->data['category_link'] = '/reviews/categories/' . $record['category_id'];
            // and light up the page
            $this->data['title'] .= ' ' . $record['post_title'];
            $this->data['pagebody'] = 'post';
        }
        $this->render();
    }
    
    function archives($date = null, $page_num = 1) {
        
        if ($date == null) {
            redirect('/reviews');
        }
        if (!is_numeric($page_num))
            $page_num = 1;
        
        $page_num = (int)$page_num - 1;
        
        $date_segment = explode('-', $date);
        
        $year = $date_segment[0];
        $month = $date_segment[1];
        
        $posts = $this->posts->get_posts_from_month($year, $month);
        
        $this->data['title'] .= ' Reviews';
        $this->data['pagebody'] = 'reviews';
        
        $this->build_page($page_num, $posts, '/reviews/archives/' . $date . '/');
        $this->render();
    }
    
    function categories($cat = null, $page_num = 1) {
        
        if ($cat == null) {
            redirect('/reviews');
        }
        if (!is_numeric($page_num))
            $page_num = 1;
        
        $page_num = (int)$page_num - 1;
        
        
        $posts = $this->posts->get_posts_with_category($cat);
        
        $this->data['title'] .= ' Reviews';
        $this->data['pagebody'] = 'reviews';
        
        $this->build_page($page_num, $posts, '/reviews/categories/' . $cat . '/');
        $this->render();
    }
    
}

/* End of file reviews.php */
/* Location: application/controllers/reviews.php */