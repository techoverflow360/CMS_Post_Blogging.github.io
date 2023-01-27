<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
        </tr>
    </thead>

    <tbody>

        <?php

        $query = "select * from users";
        $fetch_data = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($fetch_data)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];


            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo "<td>{$user_lastname}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><img src='../images/{$user_image}' alt='image not available' width=70></td>";
            echo "<td><a href='users.php?source=edit_user&user_id={$user_id}'>edit user</a></td>";
            echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
            echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
            echo "<td><a href='users.php?user_id={$user_id}'>Delete</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php 

    if(isset($_GET['change_to_admin'])){
        $user_id = $_GET['change_to_admin'];
        $make_admin_query = "update users set user_role = 'admin' where user_id = {$user_id}";
        $q = mysqli_query($connection,$make_admin_query);
        if(!$q){
            die("query failed !");
        }
        header("Location: users.php");
    }

    if(isset($_GET['change_to_sub'])){
        $user_id = $_GET['change_to_sub'];
        $make_sub_query = "update users set user_role='subscriber' where user_id = {$user_id}";
        $qw = mysqli_query($connection,$make_sub_query);
        if(!$qw){
            die("query failed !");
        }
        header("Location: users.php");

    }



        if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];
            $query = "delete from users where user_id = {$user_id}";
            $delete_comment = mysqli_query($connection,$query);
            if(!$delete_comment){
                die("query failed !!");
            }

            header("Location: users.php");
        }




?>