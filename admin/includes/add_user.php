
<?php 

if(isset($_POST['create_user'])){
    // $user_id = $_POST['user_id'];
    $user_role = $_POST['user_role'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];

    $image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    move_uploaded_file($post_image_temp,"../images/$image");

    $query = "insert into users(username,user_password,user_firstname,user_lastname,user_email,user_image,user_role,randSalt) 
            values ('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$image}','{$user_role}','null')"; 
    $insert_data = mysqli_query($connection,$query);
    if(!$insert_data){
        die("Query Failed ");
    }

    echo "User Added: " . " " . "<a href='users.php'>View Users</a>" . "<br>";
}



?>



<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="user_firstname">FirstName</label>
    <input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="user_lastname">LastName</label>
    <input type="text" class="form-control" name="user_lastname">
</div>

<div class="form-group">
    <label for="user_role"> User category </label><br>
    <select name="user_role" id="user_role">
        <option value="subscriber">Select option</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
    </select>
</div>


<div class="form-group">
    <label for="image">User Image</label>
    <input type="file" name="image">
</div>

<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username">
</div>

<div class="form-group">
    <label for="post_content">Email</label>
    <input type="email" name="user_email" class="form-control">
</div>

<div class="form-group">
    <label for="post_content">Password</label>
    <input type="password" name="user_password" class="form-control">
</div>

<div class="form-group">
    <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
</div>

</form>