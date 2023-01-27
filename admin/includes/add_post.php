
<?php 

    if(isset($_POST['create_post'])){
        $title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $author = $_POST['author'];
        $post_status = $_POST['post_status'];

        $image = $_FILES['image']['name'];
        // below is the temporary location where the image is temporarily stored
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        // $post_comment_count = 0;

        move_uploaded_file($post_image_temp,"../images/$image");

        $query = "insert into posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,
                post_status) values ({$post_category_id},'{$title}',
                '{$author}',now(),'{$image}','{$post_content}','{$post_tags}','{$post_status}')";
        $insert_data = mysqli_query($connection,$query);
        if(!$insert_data){
            die("Query Failed ");
        }
    }



?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">
        <label for="post_category"> Post Category </label><br>
        <select name="post_category" id="post_category">
            <?php 
                $query = "select * from categories";
                $fetch_all_categories = mysqli_query($connection,$query);
                if(!$fetch_all_categories){
                    die("select Query Failed !!");
                }

                while($row = mysqli_fetch_assoc($fetch_all_categories)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="summernote" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>

</form>