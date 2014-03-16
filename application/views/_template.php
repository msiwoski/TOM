<?php
if (!defined('APPPATH'))
    exit('No direct script access allowed');
/**
 * view/template.php
 *
 * Pass in $pagetitle (which will in turn be passed along)
 * and $pagebody, the name of the content view.
 *
 * ------------------------------------------------------------------------
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>{title}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/kube/css/kube.css" />
        <link href="/assets/images/favicon.ico" rel="icon" type="image/x-icon" />
        {caboose_styles}
    </head>
    <body>
        <div id="header">
            <div>
                <div id="logo">
                    <a href="/"><img src="/assets/images/logo.png" alt="LOGO"></a>
                </div>
                {menubar}
            </div>
        </div>
        <div id="contents">
            <div>
                {content}
            </div>
        </div>
        <div id="footer">
            <div>
                <div id="links">
                    <div class="showroom">
                        <h4>Read our Reviews</h4>
                        <a href="/reviews"><img src="/assets/images/beerlinedup.png" alt="Img"></a>
                        <p>
                            Vancouver, BC<br><br><br> <br><br> <a href="/">info@thirstofman.com</a>
                        </p>
                    </div>
                    <div>
                        <h4>Recent Blog Posts</h4>
                        <ul class="posts">
                            {newest_posts}
                            <li>
                                <span class="time">{newest_date_posted}</span>
                                <p>
                                    <a href="/reviews/post/{newest_id}">{newest_post_title}</a> {newest_slug}
                                </p>
                            </li>
                            {/newest_posts}
                        </ul>
                    </div>
                    <div>
                        
                            {login}
                      
                        <div id="connect">
                            <h4>Social Media</h4>
                            <a href="http://facebook.com/thirstofman" target="_blank" class="facebook"></a> <a href="https://plus.google.com/u/0/b/116865884656804832752/116865884656804832752/posts" target="_blank" class="googleplus"></a> <a href="http://twitter.com/" target="_blank" class="twitter"></a>
                        </div>
                    </div>
                </div>
                <p id="footnote">
                    © Copyright 2014. All Rights Reserved.
                </p>
            </div>
        </div>
        {caboose_scripts}
        {caboose_trailings}
    </body>
</html>
