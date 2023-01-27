
<h2>
<u>Edit Post Here</u> 
</h2>
<hr>






<form action="" method="post" enctype="multipart/form-data">




    <?php 

        if(isset($_GET['p_id'])){
            $post_id = $_GET['p_id'];

            $query = "select * from posts where post_id = {$post_id}";
            $fetch_specific_post = mysqli_query($connection,$query);
            $row = mysqli_fetch_assoc($fetch_specific_post);
            $title = $row['post_title'];
            $category = $row['post_category_id'];
            $author = $row['post_author' ];
            $status = $row['post_status'];
            $image = $row['post_image'];
            $tags = $row['post_tags'];
            $post_content = $row['post_content'];

            
        }



    ?>





    <?php 

        if(isset($_POST['edit_post'])){
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
            $post_comment_count = 4;

            move_uploaded_file($post_image_temp,"../images/$image");

            $query = "update posts set post_category_id={$post_category_id}, post_title='{$title}', post_author='{$author}',
                    post_image='{$image}', post_content='{$post_content}', post_tags='{$post_tags}', post_status='{$post_status}' where
                    post_id={$post_id}";

            $update_data = mysqli_query($connection,$query);
            if(!$update_data){
                die("Query Failed ");
            }

            echo "<p class='bg-success'>Post Updated: " . " " . "<a href='../post.php?p_id={$post_id}'>View Posts</a> 
                    <a href='posts.php'>Edit Other Post</a></p>" . "<br>";
        }

    ?>





    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
    </div>

    <div class="form-group">
        <label for="post_category"> Post Category </label>
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
        <input type="text" class="form-control" name="author" value="<?php echo $author; ?>">
    </div>

    <div class="form-group">
        <select name="post_status" id="">
            <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
            <?php 
                if($status == 'published'){
                    echo "<option value='draft'>Draft</option>";
                }else{
                    echo "<option value='published'>Publish</option>";
                }


            ?>

        </select>
    </div>

    
    <div class="form-group">
        <img src="../images/<?php echo  $image; ?>" alt="image not available" width="100">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $tags; ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" id="summernote" cols="30" rows="10" class="form-control" ><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_post" value="Publish Edited Post">
    </div>

</form>