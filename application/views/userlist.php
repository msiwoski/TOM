<?php
/*
 * User management - the list
 */
?>
<div class="body">
    <h1>User Maintenance</h1>
    <div>
        <table class="table user_maintenance table-hovered">
            <tr>
                <th>User Name</th>
                <th>Display Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Email</th>
                <th>Last Visit</th>
            </tr>
            {users}
            <tr>
                <td>{user_name}</td>
                <td>{display_name}</td>
                <td>{role}</td>
                <td>{status}</td>
                <td>{email}</td>
                <td>{last_visit}</td>
                <td><a class="btn btn-mini" href="/usermaintenance/edit/{user_name}">Edit</a></td>
                <td><a class="btn btn-mini" href="/usermaintenance/delete/{user_name}">Delete</a></td>
            </tr>
            {/users}
        </table>
    </div>
    <div>
        <a href="/usermaintenance/add">Add a new user</a>
    </div>
</div>