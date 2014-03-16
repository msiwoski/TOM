<?php
if (!defined('APPPATH'))
    exit('No direct script access allowed');
/**
 * views/useredit.php
 *
 * Manage member settings
 *
 * @author		JLP
 * ------------------------------------------------------------------------
 * 
 */
?>
<div class="body">
    <form action="/usermaintenance/submit/{id}" method="post" class="forms forms-columnar">
        <p>{user_name}</p>
        <p>{user_display}</p>
        <p>{user_password}</p>
        <p>{user_role}</p>
        <p>{user_email}</p>
        <p>{user_status}</p>

        <p><button type="submit">Submit</button></p>
    </form>
</div>
