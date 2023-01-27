<?php include "includes/admin_header.php" ?>
<!-- <?php include "./includes/db.php"; ?> -->


<?php
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "select * from users where username = '{$username}'";
    $fetch_data = mysqli_query($connection, $query);
    if (!$fetch_data) {
        die("query failed !!");
    }

    $row = mysqli_fetch_assoc($fetch_data);
    $user_id = $row['user_id'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];
    $username = $row['username'];
    $user_email = $row['user_email'];
    $user_password = $row['user_password'];
}



?>

<?php

if (isset($_POST['update_profile'])) {
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];

    $image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    move_uploaded_file($post_image_temp, "../images/$image");

    $query = "update users set username='{$username}', user_firstname='{$user_firstname}',user_password='{$user_password}',
                    user_lastname='{$user_lastname}', user_role='{$user_role}', user_image='{$image}', user_email='{$user_email}' where
                    username='{$username}'";
    $update_data = mysqli_query($connection, $query);
    if (!$update_data) {
        die("Query Failed ");
    }
}

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome to Admin
                        <small>Author</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="user_firstname">FirstName</label>
                            <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="user_lastname">LastName</label>
                            <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
                        </div>

                        <div class="form-group">
                            <label for="post_category"> Post Category </label><br>
                            <select name="user_role" id="user_role">
                                <?php
                                $query = "select * from users";
                                $fetch_all_users = mysqli_query($connection, $query);
                                if (!$fetch_all_users) {
                                    die("select Query Failed !!");
                                }

                                while ($row = mysqli_fetch_assoc($fetch_all_users)) {
                                    $user_id = $row['user_id'];
                                    $user_role = $row['user_role'];
                                    echo "<option value='{$user_role}'>{$user_role}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <img src="../images/<?php echo  $user_image; ?>" alt="image not available" width="100">
                            <input type="file" name="image">
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Email</label>
                            <input type="email" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input type="password" name="user_password" class="form-control" value="<?php echo $user_password; ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile">
                        </div>
                    </form>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>