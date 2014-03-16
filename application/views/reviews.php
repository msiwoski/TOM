<div class="body" id="blog">
    <div id="sidebar">
        <div>
            <h5>Featured Blogs</h5>
            <ul class="posts">
                {featured_blogs}
                <li>
                    <span class="time">{date}</span>
                    <p>
                        <a href="{url}">{name}</a> {description}
                    </p>
                </li>
                {/featured_blogs}
            </ul>
        </div>
        <div>
            <h5>Blog Categories</h5>
            <ul>
                {categories}
                <li>
                    <a href="{link}">{type}</a>
                </li>
                {/categories}
            </ul>
        </div>
        <div>
            <h5>Archives</h5>
            <ul>
                {archives}
                <li>
                    <a href="{link}">{date}</a>
                </li>
                {/archives}
            </ul>
        </div>
    </div>
    <div id="main">
        {posts}
        <div class="viewer"> 
            <span class="time">{date_posted}</span>
            <h3><a href="/reviews/post/{id}">{post_title}</a></h3>
            <p class="info">
                Posted By: <a href="/profiles/{user_id}">{user}</a> in <a href="{category_link}">{category}</a>
            </p>
            <div class="frame">
                <img src="/data/images/{image}" alt="Img" class="thumb_img">
            </div>
            <p>
                {slug}
            </p>
            <a href="/reviews/post/{id}" class="more">Read More</a> <a href="/reviews/post/{id}" class="comments">0 Comments</a>
        </div>
        {/posts}
        {pagination}
    </div>
</div>
