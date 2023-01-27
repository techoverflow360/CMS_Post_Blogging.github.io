<?php session_start(); ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">CMS Front</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <!-- we will make the listing of categories dynamic in which when we add new categories, 
                it will automatically show on the navigation channel -->
                <!-- run a query that fetch all categories, save it in a variable, in a while loop fetch only the title 
                part,and show it in the webpage using li tag as links  -->
                <?php 

                    $query = "select * from categories";
                    $select_all_categories = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_categories)){
                        $title = $row['cat_title'];
                        echo "<li><a href = '#'>{$title}</a></li>";
                    }
                    echo "<li><a href='./admin/index.php'>Admin</a></li>";
                    echo "<li><a href='registration.php'>Registration</a></li>";



                ?>

                
                <?php 
                    // below will do two things 
                    // 1. if the user is not logged in then it will not get edit user link 
                    // 2. if no get request which is only when we click to any specific post, then only we get edit post link
                    if(isset($_SESSION['user_role'])){
                        if(isset($_GET['p_id'])){
                            $post_id = $_GET['p_id'];
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
                        }
                    }


                ?>



            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>