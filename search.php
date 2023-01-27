<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">   

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <?php 

                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];
                        $query = "select * from posts where post_tags like '%$search%'";
                        $search_query = mysqli_query($connection,$query);
                        //if query fails then it shows below 
                        if(!$search_query){
                            die('Query fail' . mysqli_error($connection));
                        }
                        
                        // it counts number of rows found 
                        $count = mysqli_num_rows($search_query);
                        if(!$count){
                            echo "<h1> NO RESULT </h1>";
                        }else{
                            // printing all the data which get selected from the entered word 
                            while($row = mysqli_fetch_assoc($search_query)){
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                                echo "<h2><a href='#'>{$post_title}</a></h2>";
                                echo "<p class='lead'> by <a href='index.php'>{$post_author}</a></p>";
                                echo "<p><span class='glyphicon glyphicon-time'></span> Posted on {$post_date}</p>" . "<hr>";
                                echo "<img class='img-responsive' src='images/{$post_image}' alt='image not available' width='600'>". "<hr>";
                                echo "<p>{$post_content}</p>";
                                echo "<a class='btn btn-primary' href='#'> Read More <span class='glyphicon glyphicon-chevron-right'></span></a>";
                                echo "<hr>";
        
                            }
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
