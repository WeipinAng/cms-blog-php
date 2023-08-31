<?php

if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
        $bulk_options = $_POST['bulk_options'];

        switch ($bulk_options) {
            case 'published':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkBoxValue";
                $update_to_published_status = mysqli_query($connection, $query);
                confirm_query($update_to_published_status);
                break;
            
            case 'draft':
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkBoxValue";
                $update_to_draft_status = mysqli_query($connection, $query);
                confirm_query($update_to_draft_status);
                break;
            
            case 'delete':
                $query = "DELETE FROM posts WHERE post_id = $checkBoxValue";
                $update_to_delete_status = mysqli_query($connection, $query);
                confirm_query($update_to_delete_status);
                break;
            
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = $checkBoxValue";
                $select_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_posts_query)) {
                    // no $post_id and $post_comment_count
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                }

                $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";

                $copy_posts_query = mysqli_query($connection, $query);
                confirm_query($copy_posts_query);
                break;
            
            case 'reset':
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $checkBoxValue";
                $reset_views_count_query = mysqli_query($connection, $query);
                confirm_query($reset_views_count_query);
        }
    }
}

?>

<form action="" method="post">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">All Posts</h6>
            <div id="bulkOptionsContainer" class="d-flex flex-row">
                <select class="form-control mr-2" name="bulk_options">
                    <option value="" disabled hidden selected>Select Options</option>
                    <option value="published">Publish</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>
                    <option value="reset">Reset View Count</option>
                </select>

                <input type="submit" class="btn btn-success mr-4" name="submit" value="Apply">
                <a class="btn btn-primary text-nowrap" href="posts.php?source=add_post">Add New Post</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover w-auto small" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th><input type="checkbox" id="selectAllBoxes"></th>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Operation</th>
                            <th>Views</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                    // CRUD 2: READ ALL POSTS
                    $query = "SELECT * FROM posts ORDER BY post_id DESC";
                    $select_posts = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_posts)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_category_id = $row['post_category_id'];
                        $post_author = $row['post_author'];
                        $post_status = $row['post_status'];
                        $post_image = $row['post_image'];
                        $post_tags = $row['post_tags'];
                        // $post_comment_count = $row['post_comment_count'];
                        $post_date = $row['post_date'];
                        $post_views_count = $row['post_views_count'];

                        echo "<tr>";
                    ?>
                        <td><input type='checkbox' class='checkBoxes' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
                    <?php
                        echo "<td>{$post_id}</td>";
                        echo "<td><a href='../post.php?post_id=$post_id'>{$post_title}</a></td>";

                        $query = "SELECT * FROM categories WHERE cat_id = '$post_category_id'";
                        $select_categories_id = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($select_categories_id)) {
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                        
                        echo "<td>{$cat_title}</td>";
                        }

                        echo "<td>{$post_author}</td>";

                        echo "<td>{$post_status}</td>";
                        echo "<td><img width='90' src='../images/$post_image' alt='image'></td>";
                        echo "<td>{$post_tags}</td>";

                        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                        $send_comment_query = mysqli_query($connection, $query);

                        $post_comment_count = mysqli_num_rows($send_comment_query);

                        $row = mysqli_fetch_array($send_comment_query);
                        // Trying to access array offset on value of type null (we have to take into account posts that don't have any comments at all)
                        if ($post_comment_count > 0) {
                            $comment_id = $row['comment_id'];
                            echo "<td><a href='comments_of_a_post.php?post_id=$post_id'>{$post_comment_count}</a></td>";
                        } else {
                            echo "<td>{$post_comment_count}</td>";
                        }

                        echo "<td>{$post_date}</td>";
                        echo "<td><a href='posts.php?source=update_post&update=$post_id'>Update</a>
                        </br></br>
                                <a href='posts.php?delete=$post_id' onClick=\"javascript: return confirm('Are you sure you want to delete this post, $post_title?')\">Delete</a></td>";
                        echo "<td>{$post_views_count}</td>";
                        echo "</tr>";
                    }

                    ?>

                    <?php

                    // CRUD 4: DELETE POST
                    if(isset($_GET['delete'])) {
                        // URL and MySQL Injection Protection
                        if (isset($_SESSION['user_role'])) {
                            if ($_SESSION['user_role'] == 'admin') {
                                $post_id = escape($_GET['delete']);

                                $query = "DELETE FROM posts WHERE post_id = '$post_id'";
                                $delete_query = mysqli_query($connection, $query);

                                confirm_query($delete_query);
                                $_SESSION['delete_noti'] = 'Post has been deleted successfully.';
                                header('Location: posts.php');
                            }
                        }
                    }

                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>