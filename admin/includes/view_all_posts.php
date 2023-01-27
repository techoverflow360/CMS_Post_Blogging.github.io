<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>

        <?php

            $query = "select * from posts";
            $fetch_data = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($fetch_data)) {
                $id = $row['post_id'];
                $author = $row['post_author'];
                $title = $row['post_title'];
                $category = $row['post_category_id'];

                $query = "select * from categories where cat_id={$category}";
                $fetch_data = mysqli_query($connection,$query);
                $data = mysqli_fetch_assoc($fetch_data);
                $cat_title = $data['cat_title'];

                $status = $row['post_status'];
                $image = $row['post_image'];
                $tags = $row['post_tags'];
                $comments = $row['post_comment_count'];
                $date = $row['post_date'];


                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$author}</td>";
                echo "<td>{$title}</td>";
                echo "<td>{$cat_title}</td>";
                echo "<td>{$status}</td>";
                echo "<td><img width=70 src='../images/$image' alt='not available'></td>";
                echo "<td>{$tags}</td>";
                echo "<td>{$comments}</td>";
                echo "<td>{$date}</td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$id}'>edit post</a></td>";
                echo "<td><a href='posts.php?delete={$id}'>delete</a></td>";
                echo "</tr>";
            }

        ?>

    </tbody>
</table>

<?php 

    if(isset($_GET['delete'])){
        $get_id = $_GET['delete'];

        $query = "delete from posts where post_id = {$get_id}";
        $delete_post = mysqli_query($connection,$query);
        if(!$delete_post){
            die("delete query failed !!");
        }
        header("Location: posts.php");
    }



?>