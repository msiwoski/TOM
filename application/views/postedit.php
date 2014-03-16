<?php

/*
 * 
 * 
        <p>{post_date}</p>
        <p>{tags}</p>
        <p>{beer}</p>
        <p>{beer_rating}</p>
 * 
 */
?>


<div class='body'>
    <h1>Add your Post</h1>
    <form method="post" action="/postmaintenance/submit/{id}" class="forms forms-columnar" onsubmit="update_editor();" enctype="multipart/form-data">
        <p>{post_title}</p>
        <p>{image}</p>
        <p>{category}</p>
        <p>{slug}</p>
        <p>{editor}</p>
        <p>{submit}</p>
    </form>
</div>