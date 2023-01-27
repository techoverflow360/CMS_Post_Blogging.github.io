<?php include "includes/admin_header.php" ?>

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


                    <!-- form that take new categories as input and add into the categories table  -->

                    <div class="col-xs-6">


                        <?php

                        if (isset($_POST['submit'])) {
                            $category = $_POST['cat_title'];
                            if ($category == "" || empty($category)) {
                                echo "This field should not be empty";
                            } else {
                                $query = "insert into categories(cat_title) values ('$category')";
                                $insert = mysqli_query($connection, $query);
                                if (!$insert) {
                                    die('query failed');
                                }
                            }
                        }

                        ?>


                        <form action="" method="post">
                            <label for="cat-title"> Add Category </label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" name="submit" value="Add category">
                            </div>
                        </form>

                        
                        <form action="" method="post">
                            

                            <?php 

                                if(isset($_GET['edit'])){
                                    $get_id = $_GET['edit'];
                                    $query = "select * from categories where cat_id = {$get_id}";
                                    $run_query = mysqli_query($connection,$query);
                                    $row = mysqli_fetch_assoc($run_query);
                                    $cat_title = $row['cat_title'];
                                    ?>
                                    
                                    <label for="cat-title"> Edit Category </label>
                                    <div class="form-group">
                                        <input value = "<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" name="Update" value="Update">
                                    </div>

                                    <?php


                                }

                            ?>

                            <?php 

                            // here we receive the post request from the form that gives the new cat_title and we update it 
                            if(isset($_POST['Update'])){
                                $cat_title = $_POST['cat_title'];
                                if($cat_title == "" || empty($cat_title)){
                                    echo "This field cannot be empty !!";
                                }else{
                                    $query = "update categories set cat_title = '{$cat_title}' where cat_id = {$get_id}";
                                    $update = mysqli_query($connection,$query);
                                    if(!$update){
                                        die("update Query Failed !");
                                    }
                                }
                            }



                            ?>
                            
                        
                        </form>


                    </div>

                    <div class="col-xs-6">


                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                $query = "select * from categories";
                                $fetch_all_categories = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($fetch_all_categories)) {
                                    $cat_id = $row['cat_id'];
                                    $cat_title = $row['cat_title'];
                                    // delete generates a get super global request 
                                    echo "<tr><td>{$cat_id}</td><td>{$cat_title}</td>
                                    <td><a href='categories.php?edit={$cat_id}'>Edit</a></td>
                                    <td><a href='categories.php?delete={$cat_id}'>Delete</a></td></tr>";
        
                                }

                                ?>

                                <?php 
                                    // when we press delete, get takes the request along with id and delete from table 
                                    if(isset($_GET['delete'])){
                                        $the_cat_id = $_GET['delete'];
                                        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                        $delete_category = mysqli_query($connection,$query);
                                        if(!$delete_category){
                                            die("query failed");
                                        }
                                        header("Location: categories.php");
                                    }

                                ?>
                                
                                <?php 

                                    // editing the categories
                                    


                                ?>

                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>