<?php

/*
 * List all posts
 */
?>

<div class="body">
    <h1>Post Maintenance</h1>
    <div>
        <table class="table user_maintenance table-hovered">
            <tr>
                <th>User Name</th>
                <th>Post Title</th>
                <th>Date Posted</th>
            </tr>
            {posts}
            <tr>
                <td>{display_name}</td>
                <td>{post_title}</td>
                <td>{date_posted}</td>
                <td><a class="btn btn-mini" href="/postmaintenance/edit/{id}">Edit</a></td>
                <td><a class="btn btn-mini" href="/postmaintenance/delete/{id}">Delete</a></td>
            </tr>
            {/posts}
        </table>
    </div>
    <div>
        <a href="/postmaintenance/add">Add a new post</a>
    </div>
</div>