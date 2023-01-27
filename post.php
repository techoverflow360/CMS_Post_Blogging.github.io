<?php include "includes/db.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog Post - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-post.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <?php 

                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                        $query = "select * from posts where post_id = {$post_id}";
                        $fetch_post = mysqli_query($connection,$query);
                        if(!$fetch_post){
                            die("fetch data failed !!");
                        }

                        $row = mysqli_fetch_assoc($fetch_post);
                        $title = $row['post_title'];
                        $author = $row['post_author'];
                        $date = $row['post_date'];
                        $image = $row['post_image'];
                        $content = $row['post_content'];
                        
                    }


                ?>

                <div>
                <!-- Title -->
                <h1><?php echo $title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $author; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on  <?php echo $date; ?></p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src='images/{$image}' alt="image not available" width="600">

                <hr>

                <!-- Post Content -->
                <div>
                    <p><?php echo $content; ?></p>
                </div>
                <hr>
                </div>
                <!-- Blog Comments -->
                
                <?php 

                    if(isset($_POST['create_comment'])){
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];
                        $comment_status = 'Unapprove';
                        $comment_date = date('d-m-y');

                        $qw = "update posts set post_comment_count = post_comment_count+1 where post_id = {$post_id}";
                        $update_comment_count = mysqli_query($connection,$qw);
                        $query = "insert into comments(comment_post_id,comment_author,comment_email,comment_content,comment_status,comment_date)
                                values ({$post_id},'{$comment_author}','{$comment_email}','{$comment_content}','{$comment_status}',now())";
                        $insert_data = mysqli_query($connection,$query);
                        if(!$insert_data){
                            die("query failed !!");
                        }

                    }

                ?>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="Comment">Your Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                
                
                <?php 

                    $query = "select * from comments where comment_post_id = {$post_id}";
                    $fetch_selected_comment = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($fetch_selected_comment)){
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];
                        $comment_status = $row['comment_status'];
                        if($comment_status == 'approve'){
                            echo "<div class='media-body'>";
                            echo "<h4 class='media-heading'><b>{$comment_author}</b><small> Posted on {$comment_date}</small></h4>";
                            echo "<p>{$comment_content}</p>";
                            echo "</div>" . "<br>";
                        }
                    }

                ?>




                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->

<?php include "includes/footer.php" ?>