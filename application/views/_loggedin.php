<?php
/**
 *  This is a view fragment, to hold a login form.
 * It is meant to be at the top of the sudebar in our layout.
 */
?>
<div class="well">
    Hi, <a href="/profiles/{user_name}">{display_name}</a> ({userRole})<br/>
    <ul>
        {secret_menu}
        <li><a href="/postmaintenance">Post Maintenance</a></li>
        <li><a href="/profiles/edit">Edit Profile</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>
</div>
