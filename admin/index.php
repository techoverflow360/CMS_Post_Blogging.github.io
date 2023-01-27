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
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->


            <!-- row -->


            <?php
            $post = "select count(*) from posts";
            $comment = "select count(*) from comments";
            $user = "select count(*) from users";
            $category = "select count(*) from categories";

            $count_posts = mysqli_query($connection, $post);
            $count_comments = mysqli_query($connection, $comment);
            $count_users = mysqli_query($connection, $user);
            $count_categorys = mysqli_query($connection, $category);


            $_post = mysqli_fetch_assoc($count_posts);
            $_comment = mysqli_fetch_assoc($count_comments);
            $_user = mysqli_fetch_assoc($count_users);
            $_category = mysqli_fetch_assoc($count_categorys);

            $count_post = $_post['count(*)'];
            $count_comment = $_comment['count(*)'];
            $count_user = $_user['count(*)'];
            $count_category = $_category['count(*)'];

            ?>


            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_post; ?></div>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_comment; ?></div>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_user; ?></div>
                                    <div>Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $count_category; ?></div>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->


            <?php
                $post = "select count(*) from posts where post_status = 'draft'";
                $count = mysqli_query($connection, $post);
                $d_post = mysqli_fetch_assoc($count);
                $count_draft_post = $_post['count(*)'];

                $p_post = "select count(*) from posts where post_status = 'published'";
                $count = mysqli_query($connection, $p_post);
                $p_post = mysqli_fetch_assoc($count);
                $count_published_post = $p_post['count(*)'];

                $comments = "select count(*) from comments where comment_status = 'unapprove'";
                $count = mysqli_query($connection, $comments);
                $d_comment = mysqli_fetch_assoc($count);
                $count_unapprove_comments = $d_comment['count(*)'];

                $users = "select count(*) from users where user_role = 'subscriber'";
                $count = mysqli_query($connection, $users);
                $d_users = mysqli_fetch_assoc($count);
                $count_subscriber = $d_users['count(*)'];




            ?>



            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Date', 'count'],

                            <?php
                                
                            $elements_text = ['All Posts','Active Posts', 'Draft Posts','Categories', 'Users','Subscriber', 'Comments', 'Unapproved Comments'];
                            $elements_count = [$count_post,$count_published_post, $count_draft_post,$count_category, $count_user,$count_subscriber, $count_comment,$count_unapprove_comments];
                            for ($i = 0; $i < 8; $i++) {
                                echo "['{$elements_text[$i]}'" . "," . "{$elements_count[$i]}],";
                            }

                            ?>

                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>

            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include "includes/admin_footer.php" ?>