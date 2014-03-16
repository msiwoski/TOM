<?php
/**
 *  This is a view fragment, to hold a login form.
 * It is meant to be at the top of the sudebar in our layout.
 */
?>
<div class="well">
    <form method="post" action="/login/submit" id="login">
        {login_id}
        {login_password}
        {login_hidden}
        {login_button}
    </form>
</div>
