Please mark the following for lab8:
	controllers/Capo.php
	controllers/updateddescription.php
	core/MY_Controller.php	
	views/updatedescription.php

note: 	Editable profiles for each user
	


Please mark the following for Lab7:
	Added KUBE Framework
	Added CKEditor for text editor
	Added Caboose
	Added KCFinder for image uploading
	Redid database to what we wanted (more robust)
	Redid/Added more views
		views/userpost.php
		views/post/php
		views/trends.php - formatted with KUBE
		views/reviews.php - Featured Blogs is dynamic/blog categories is taken from the post, 
							archive is built from dates of post/posts are broken between pages/pagination
		view/reviewnavigation (all files were created for pagination)
		view/fields (used for formfields_helper)
		view/components (js for the ckeditor library)
		models/postTags (adding tags to posts)
		models/beer (adding beer types to posts)
		models/categories (adding categories to posts)
		models/comments (adding comments to posts)
		models/images (changed from media)
		models/tags (to define tags)
		libraries/caboose.php
		helpers/field_helper.php
		controllers/login.php (check to see if the user if active/update last visit date)
		controllers/post.php (editor is now inline)
		controllers/reviews.php (pagination/blogs/categories/archives)
		controllers/usermaintenance.php (updated with db)
		*All of the controllers have form fields*
		
		Notes: My_controller: The controller has the title "Thirst of Man:" All other pages append to
		All posts have a formatted date, along with formatted author and categories
		
        Things we will be adding:
                Add templating for posts
                Post to DB
                Image upload to DB
                Comments to DB
                Re do the DB a bit more for clarity/consistency
                categories/archive/user lookup
                Add users "search" and profile
                Possibly add a search bar


Please mark the following for Lab6:
	/config/config.php				:add config for user roles
	/config/autoload.php			:autoload session library
	/core/MY_Controller.php			:build the login info for footer/blog entries
	/controller/usermaintenance.php	:handles adding/editing/deleting users
	/controller/login.php			:creates the session
	/controller/logout.php			:destroys the session
	/models/users.php				:Handles the user table
	/views/_admin.php 				:Display the user maintenance anchor
	/views/_loggedin.php			:Display the logged in html
	/views/_login.php 				:Display the login text box
	/views/_template.php  			:Added the login to the footer/blog posts are updating on every footer
	/views/useredit.php 			:Display the user edit html
	/views/userlist.php 			:Display the user list html
	/data/scripts/beer.sql			:Added the user/ci_sessions tables
	/assets/css						:fixed some css issues
	
	
Please mark the following for Lab 5:
    /views/trends.php
    /views/consumption/_category.php
    /views/consumption/_headings.php
    /views/consumption/_reportline.php
    /controllers/trends.php
    /models/consumption.php

Please mark the following for Lab 4:
    /views/trends.php   
    /controllers/trends.php
    /data/xml/percapitaconsumption.xml

Please mark the following for Lab 3:
    /views/trends.php   
    /controllers/trends.php
    /data/xml/percapitaconsumption.xml
    
    we have also fixed the friends_list.php aligning it correctly.
    we have corrected the folder path way with virtual hosting.