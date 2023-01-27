<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Comments_Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

        <?php

        $query = "select * from comments";
        $fetch_data = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($fetch_data)) {
            $comment_id = $row['comment_id'];
            $comment_post_id = $row['comment_post_id'];
            $comment_author = $row['comment_author'];
            $comment_email = $row['comment_email'];
            $content = $row['comment_content'];
            $status = $row['comment_status'];
            $date = $row['comment_date'];

            $q = "select * from posts where post_id = {$comment_post_id}";
            $fetch_post = mysqli_query($connection,$q);
            $row_post = mysqli_fetch_assoc($fetch_post);
            $post_title = $row_post['post_title'];

            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            // echo "<td>{$comment_post_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$status}</td>";
            echo "<td><a href='../post.php?p_id={$comment_post_id}'>{$post_title}</a></td>";
            echo "<td>{$date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
            echo "<td><a href='comments.php?comment_id={$comment_id}'>Delete</a></td>";
            echo "</tr>";
        }

        ?>

    </tbody>
</table>


<?php 

    if(isset($_GET['approve'])){
        $comment_id = $_GET['approve'];
        $approve_query = "update comments set comment_status = 'approve' where comment_id = {$comment_id}";
        $q = mysqli_query($connection,$approve_query);
        if(!$q){
            die("query failed !");
        }
        header("Location: comments.php");
    }

    if(isset($_GET['unapprove'])){
        $comment_id = $_GET['unapprove'];
        $unapprove_query = "update comments set comment_status = 'unapprove' where comment_id = {$comment_id}";
        $qw = mysqli_query($connection,$unapprove_query);
        if(!$qw){
            die("query failed !");
        }
        header("Location: comments.php");

    }





        if(isset($_GET['comment_id'])){
            $comment_id = $_GET['comment_id'];
            $query = "delete from comments where comment_id = {$comment_id}";
            $delete_comment = mysqli_query($connection,$query);
            if(!$delete_comment){
                die("query failed !!");
            }

            header("Location: comments.php");
        }




?>