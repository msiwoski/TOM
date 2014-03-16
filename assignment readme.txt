COMP 4711 Assignment 2
By Mateusz Siwoski (A00758640) and Jordan Marling (A00845629)

Blog title: Thirst of Man
--------------------------------------------------------------------------------
System administrator needs:
- beer.sql 
- /data/scripts/
- nothing should be needed to change the function of the database to working

--------------------------------------------------------------------------------
Critic needs:
- Synopsis: The goal of our website is to review the local BC Craft Beer Market. 
  We define success as our site being used extensively. We hope to achieve this by
  producing intelligent, creative reviews on the local beer market. As well, we would like
  to bring better integration with the BC Craft beer market by adding things such as a recipes section,
  event calendar and detailed news. We want to cover everything that there is to do with beer, but also 
  keep a close eye on what is important to the local market as well.
- Please view the Assignment 2.docx for a detailed description on what we have defined as success for our website

--------------------------------------------------------------------------------
Instructor needs:
- Everything has been completed.
- Profiles have been added (click on the name of the user and a profile of the user will be represented)
  Quotes have been added that will change throughout the site (the quotes do occasionally get repeated twice)
  Event calendar has been added (using Code Igniter)
- When uploading an image w/o using the CKeditor tool, it may not properly work on GOOGLE CHROME.
  We suspect this is an issue to do with the sessions. We have tested this in Firefox and we
  are unable to reproduce. In Chrome, it seems to work 90% of the time. This image is strictly for the
  title image of the review.

--------------------------------------------------------------------------------
Common needs:
- Admin: 	Able to add/delete users/change passwords/add posts
  User:  	Able to add posts 
  Guest: 	someone visiting the website (not logged in)
  Visitor: 	someone who logs in through social media
  
- Admin username: donald
  Admin Password: duck
  
  User username:  mickey
  User Password:  mouse


--------------------------------------------------------------------------------
Notes:
	- Added rotating quotes on welcome.php, about.php and contact.php
	- Added Events calendar using CI calendar library
	- Profiles pages for the users, they are underneath the about.php or 
	  click on the name of the user in reviews/funcitonality to change the profile
	  description has not been implemented
	- KCFinder is the image uploader
	- CKEditor is the rich-text editor
	- Archives is working so you can sort the postings by the date of posting underneath reviews
	- Caboose has been implemented
	- Kube is the CSS-Framework
	- Future additions: possibly adding search/recipes section






--------------------------------------------------------------------------------
COMP 4711 Assignment 1
By Mateusz Siwoski (A00758640) and Jordan Marling (A00845629)

Blog title: Thirst of Man

Our blog is about the appreciation of local craft beer and many other things 
related with the local craft beer market in Vancouver. Our audience is for the 
amateur connuisseur of beer. However, we welcome any one else who may be curious 
about the appreciation of beer.

We will be categorizing our posts by the beer being discussed.  These posts will 
include reviews of the latest beer we have had, images of that beer and possible
other topics such as recipes and general commentary.

--------------------------------------------------------------------------------

Functions in place so far:

-Posts are pulled from the database and displayed in chronological 
 order.
-Menu bar items are handled by different controllers and link to appropriate
 views.
-Each post is accompanied by an image which is stored in the /data/images
 folder.  The image file names are stored in the database.
-Each post in our Reviews page will open a new page with a more complete
review being pulled from our database.

--------------------------------------------------------------------------------

Database schema:

We misunderstood the database portion of the assignment and actually implemented
a database with our posts rather than using dummy data in our model. The database we
used has a media and post table. We decided after re-reading that is not exactly what 
you wanted we believe that there should be more tables in our databse.

The following tables we will need to implement are: user, post, image, comments,
category, tag and rating. 

Every user will be able to have 0 to many posts. A post can have 1-3 images. A 
post can have 0 to many comments. A category can have many posts but a post will have only
1 category. Tag can have many posts and posts can have many tags. Rating can have 1 post
but a post can have many ratings.
--------------------------------------------------------------------------------

Models:

Two models are currently in use: reviewbeer, media. & consumption. The consumption model
deals with the xml trends data.  Reviewbeer and media reflect 2 tables from the sql database we
would like to implement. The consumption model has the get_province_names function for 
getting the province name, the get_province_category for getting the province category
, the get_alcohol_categories for getting the alcohol catgegory and the get_headings which 
gets the years.

NOTES:
- we did not realize we were not suppose to implement the models with the sql and 
we used the two default models you had in your solution to show our posts (rather
than hardcoding the dummy data.) We will need to change the models/tables with the 
tables above in the database portion of this readme.

--------------------------------------------------------------------------------

Controllers & Views:

The following table summarizes what controller & view is used for each page:

Page            | Controller   | View
--------------------------------------------------
Front page      | welcome.php  | welcome.php
About           | about.php    | about.php
Reviews			| overview.php | overview.php & post.php
Recipes			| gallery.php  | gallery.php
Contact         | contact.php  | contact.php
Trends          | trends.php   | trends.php, _category.php, _headings.php & _reportline.php

Notes:
-The blogpost controller uses the overview and post views. the overview is the short 
description of review with the slug line and the image while post view will show the author,
the larger image and the actual review of the beer.
- The trends view is the general outline of the content for the page. _category view is for
each of the major groupings (beer, spirits and wine), _headings.php is for the years and 
_reportline.php is for the actual data.

--------------------------------------------------------------------------------

Other notes:

- We misunderstood what you meant regarding the Database portion of the website and we
 implemented a db for our reviews rather than hardcoding the review in. So our reviews are being
 pulled from the DB. However, because we misunderstood, the database we implemented is not the database
 we want and we will change that portion with the above idea for the next assignment.
-For our blog layout, we used the Wood Working Website Blog template but removed anything we
 didn't need, adding our own photos and posts and re-colored most of the elements with a theme
 based on color theory.
