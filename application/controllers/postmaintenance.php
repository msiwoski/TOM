<?php

/**
 * controllers/postmaintenance.php
 *
 * Post table maintenance
 *
 * ------------------------------------------------------------------------
 */
class PostMaintenance extends Application {

    function __construct() {
        parent::__construct();
        $this->restrict(array(ROLE_ADMIN, ROLE_USER));
        $this->load->model('posts');
        $this->load->model('users');
        $this->load->model('beers');
        $this->load->model('categories');
        $this->load->model('images');
        
        
        $this->load->helper(array('form', 'url'));
    }

    //-------------------------------------------------------------
    //  Show all the posts
    //-------------------------------------------------------------

    function index() {
        $this->data['title'] .= "Posts";
        $posts = array();
        if ($this->session->userdata('userRole') == ROLE_ADMIN) {
            $posts = $this->posts->get_posts();
        }
        else {
            $posts = $this->posts->get_posts_from_user($this->session->userdata('user_name'));
        }
        
        for($i = 0; $i < count($posts); $i++) {
            $user = $this->users->get($posts[$i]['user_id']);
            
            $posts[$i]['display_name'] = $user->display_name;
        }
        
        $this->data['posts'] = $posts;
        $this->data['pagebody'] = 'postlist';
        $this->render();
    }

    //-------------------------------------------------------------
    //  Trigger adding a new post
    //-------------------------------------------------------------

    function add() {
        $this->data['title'] .= "Add a post";
        $this->data['pagebody'] = 'postedit';
        
        $categories = array();
        $all_categories = $this->categories->getAll_array();
        
        foreach($all_categories as $cat) {
            $categories[] = $cat['category'];
        }
        
        
        $beers = array();
        $all_beers = $this->beers->getAll_array();
        
        $beers[] = 'None';
        foreach($all_beers as $beer) {
            $beers[] = $beer['name'];
        }
        
        $this->data['beer']             = makeEditableComboboxField('Beer', 'beer', $beers);
        $this->data['beer_rating']      = makeNumericField('Beer Rating', 'beer_rating', 0, 5);
        $this->data['submit']           = makeNormalButtonField('Submit', 'submit', '#');
        $this->data['category']         = makeEditableComboboxField('Category', 'category', $categories);
        $this->data['editor']           = makeEditorField('edit', 'edit');
        $this->data['image']            = makeImageUpload('Image', 'image', 'image');
        $this->data['post_date']        = makeDateTimeField('Date To Post', 'post_date');
        $this->data['tags']             = makeTextField('Tags', 'tags');
        $this->data['post_title']       = makeTextField('Title', 'title');
        $this->data['slug']             = makeTextField('Slug', 'slug');
        $this->data['id'] = '';
        
        $this->render();
    }

    // Request a post edit
    function edit($id) {
        $post = (array) $this->posts->get($id);
        $this->data['title'] .= "Add a post";
        $this->data['pagebody'] = 'postedit';
        
        $categories = array();
        $all_categories = $this->categories->getAll_array();
        $selected_category = '';
        
        foreach($all_categories as $cat) {
            $categories[] = $cat['category'];
            if ($cat['id'] == $post['category_id']) {
                $selected_category = $cat['category'];
            }
        }
        
        $beers = array();
        $all_beers = $this->beers->getAll_array();
        
        $beers[] = 'None';
        foreach($all_beers as $beer) {
            $beers[] = $beer['name'];
        }
        
        $image = $this->images->get($post['image_id'])->filename;
        
        $this->data['beer']             = makeEditableComboboxField('Beer', 'beer', $beers);
        $this->data['beer_rating']      = makeNumericField('Beer Rating', 'beer_rating', 0, 5);
        $this->data['submit']           = makeNormalButtonField('Submit', 'submit', '#');
        $this->data['category']         = makeEditableComboboxField('Category', 'category', $categories, $selected_category);
        $this->data['editor']           = makeEditorField('edit', 'edit', $post['text']);
        $this->data['image']            = makeImageUpload('Image', 'image', 'image', $image, '/data/images/');
        $this->data['post_date']        = makeDateTimeField('Date To Post', 'post_date');
        $this->data['tags']             = makeTextField('Tags', 'tags');
        $this->data['post_title']       = makeTextField('Title', 'title', $post['post_title']);
        $this->data['slug']             = makeTextField('Slug', 'slug', $post['slug']);
        $this->data['id'] = $post['id'];
        
        $this->render();
    }

    // Process an add/edit form submission
    function submit($id = null) {
        
        $this->data['errors'] = array();
        
        if ($id == null) {
            $post = $this->posts->create();
        }
        else {
            $post = $this->posts->get($id);
        }
        if ($post == null) {
            redirect('/');
        }
        
        
        //check for validity
        if (!isset($_POST['title']) ||
            strlen($_POST['title']) == 0) {
            
            $this->data['errors'][] = "You need a title.";
            
        }
        if (!isset($_POST['slug']) ||
            strlen($_POST['slug']) == 0) {
            
            $this->data['errors'][] = "You need a slug.";
            
        }
        if (!isset($_POST['edit']) ||
            strlen($_POST['edit']) == 0) {
            
            $this->data['errors'][] = "You need a text body.";
            
        }
//        if (!isset($_POST['image']) ||
//            strlen($_POST['image']) == 0 ||
//            !file_exists('data/images/' . $_POST['image'])) {
//            
//            $this->data['errors'][] = "You need an image. ";
//            
//        }
//        if (!isset($_POST['post_date'])) {
//            $this->data['errors'][] = "Select a date for this to be posted.";
//        }
        if (!isset($_POST['category']) ||
            strlen($_POST['category']) == 0) {
            
            $this->data['errors'][] = "You need a category.";
        }
//        if (!isset($_POST['tags']) ||
//            strlen($_POST['tags']) == 0) {
//            
//            $this->data['errors'][] = "You need some tags.";
//        }
//        if (!isset($_POST['beer']) ||
//            strlen($_POST['beer']) == 0) {
//            
//            $this->data['errors'][] = "You need to enter a beer or None";
//        }
        
        
        //upload image
        $config['upload_path'] = './data/images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '1000048';
        $config['max_width']  = '10024';
        $config['max_height']  = '7068';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);
        
        if ($id == null && !$this->upload->do_upload('image')) {
            
            $this->data['errors'][] = $this->upload->display_errors();
        }
        
        
        if (count($this->data['errors']) > 0) {
            //$this->data['pagebody'] = 'userpost';
            foreach ($this->data['errors'] as $err) {
                echo "<p>" . $err . "</p>";
            }
            //$this->render();
            return;
        }
        
        
        //category
        $category = $_POST['category'];
        $category_entry = (array)$this->categories->querySome("category", $category);
        
        if (count($category_entry) == 0) { //create category
            $new_category = $this->categories->create();
            $new_category->category = $category;
            $this->categories->add($new_category);
            
            $category_entry = (array)$this->categories->querySome("category", $category);
        }
        
        $category_id = $category_entry[0]->id;
        
        
        
        
        //image
        //$image = $_POST['image'];
        
        $image_id = -1;
        
        if ($id == null) {
            $file_data = (array)$this->upload->data();
            $image = $file_data['file_name'];
            
            $image_entry = (array)$this->images->querySome("filename", $image);
            if (count($image_entry) == 0) { //create image
                $new_image = $this->images->create();
                $new_image->filename = $image;
                $this->images->add($new_image);

                $image_entry = (array)$this->images->querySome("filename", $image);
            }
            
            $image_id = $image_entry[0]->id;
        }
        else {
            $image_id = $post->image_id;
        }
        
        
        $post->date_created = date('Y-m-d H:i:s');
        $post->image_id = $image_id;
        $post->date_posted = date('Y-m-d H:i:s');
        $post->user_id = $this->session->userdata('user_id');
        $post->category_id = $category_id;
        $post->post_title = $_POST['title'];
        $post->slug = $_POST['slug'];
        $post->text = $_POST['edit'];
        
//        if ($_POST['beer'] != "None") {
//            $post->beer = $_POST['beer'];
//            $post->beer_rating = $_POST['beer_rating'];
//        }
        
        //TODO: Figure out what to do with tags.
        //$tags = explode(',', $_POST['tags']);
        
        //foreach ($tags as $tag) {
        //    $t = $this->tags->querySome("tag", $tag);
            
        //}
        
//        var_dump($_POST);
        
        
        if ($id == null) {
            $this->posts->add($post);
        }
        else {
            $this->posts->update($post);
        }
        
        //var_dump($_POST);
        
        $post_id = ($id == null ? $this->posts->last()->id : $id);
        
        redirect('/reviews/post/' . $post_id);
    }

    // Delete a post
    function delete($id) {
        $this->posts->delete($id);
        $this->index();
    }

}

/* End of file postmaintenance.php */
/* Location: ./system/application/controllers/postmaintenance.php */