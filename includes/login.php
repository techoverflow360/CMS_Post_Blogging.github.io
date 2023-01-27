<?php include "db.php"; ?>
<?php session_start(); ?>

<?php

    if(isset($_POST['submit'])){
        $login_username = $_POST['username'];
        $login_password = $_POST['password'];
        
        $login_username = mysqli_real_escape_string($connection,$login_username);
        $login_password = mysqli_real_escape_string($connection,$login_password);
        
        $query = "select * from users where username='{$login_username}'";
        $fetch = mysqli_query($connection,$query);
        
        while($row = mysqli_fetch_assoc($fetch)){
            $db_id = $row['user_id'];
            $db_username = $row['username'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_role = $row['user_role'];
        }
        
        if($db_username === $login_username && $db_user_password === $login_password){
            $_SESSION['username'] = $db_username;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;

            header("Location: ../admin");
        }else{
            header("Location: ../index.php");
        }

    }



?>