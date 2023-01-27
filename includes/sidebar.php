<div class="col-md-4">


    <!-- we are collecting the data written in the search bar, which is used to find content -->


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>

        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <a href="search.php"><span class="glyphicon glyphicon-search"></span></a>
                    </button>
                </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>

    <!-- login form for already admin -->
    <div class="well">
        <h4>Login</h4>

        <form action="includes/login.php" method="post">
            <?php 
                

            ?>
            <input type="text" name="username" placeholder="Enter Username" class="form-control"><br>
            <div class="input-group">
                <input name="password" type="password" class="form-control" placeholder="Enter password">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit" value="submit">
                        Submit
                    </button>
                </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>



    <!-- Blog Categories Well -->
    <div class="well">

        <?php

        $query = "select * from categories";
        $select_all_categories = mysqli_query($connection, $query);

        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">

                    <?php
                    while ($row = mysqli_fetch_assoc($select_all_categories)) {
                        $title = $row['cat_title'];
                        $cat_id = $row['cat_id'];
                        echo "<li><a href = 'category.php?category={$cat_id}'>{$title}</a></li>";
                    }
                    ?>

                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>

</div>