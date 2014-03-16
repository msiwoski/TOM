<div class="viewer body"> 
    <span class="time">{date_posted}</span>
    <h3><a href="/reviews/post/{id}">{post_title}</a></h3>
    {images}
    <p class="info">
        Posted By: <a href="/profiles/{user_id}">{user}</a> in <a href="{category_link}">{category}</a>
    </p>
    <img src="/data/images/{filename}" alt="Img" title="{caption}" class="post_img">
    {/images}
    <p>
        {slug}
    </p>
    <p>
        {text}
    </p>
    <!--<a href="/view/post/{id}" class="more">Read More</a> <a href="/view/post/{id}" class="comments">0 Comments</a>-->
</div>