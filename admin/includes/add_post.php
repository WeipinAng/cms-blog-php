<div class="row">

    <div class="col-lg-12">
        <?php

        // CRUD 1: ADD NEW POST
        if (isset($_POST['create_post'])) {
            $post_title = escape($_POST['post_title']);
            $post_category_id = $_POST['post_category_id'];
            $post_author = escape($_POST['post_author']);
            $post_status = $_POST['post_status'];

            $post_image = $_FILES['post_image']['name'];
            $post_image_temp = $_FILES['post_image']['tmp_name'];

            $post_tags = escape($_POST['post_tags']);
            $post_content = escape($_POST['post_content']);
            $post_date = date('d-m-y');

            move_uploaded_file($post_image_temp, "../images/$post_image");

            
            $query = "INSERT INTO posts (post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) VALUES ($post_category_id, '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', '$post_status')";

            $create_post_query = mysqli_query($connection, $query);

            confirm_query($create_post_query);

            // built-in PHP native function - pull out the last created ID (auto-generated id of the last inserted record will be returned // last query on the whole database) in this table
            $post_id = mysqli_insert_id($connection);

            echo "
                <svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
                <symbol id='check-circle-fill' fill='currentColor' viewBox='0 0 16 16'>
                    <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
                </symbol>
                </svg>
                <div class='alert alert-success d-flex align-items-center' role='alert'>
                    <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
                    &nbsp;&nbsp;&nbsp;
                        <div>
                            Post has been updated successfully. &nbsp; <a href='../post.php?post_id=$post_id' class='alert-link'>View This Post</a> | <a href='posts.php' class='alert-link'>View All Posts</a>
                        </div>
                </div>
            ";
        }

        ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Post</h6>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <label for="post_title">New Post Title</label>
                        <input class="form-control" type="text" name="post_title" id="post_title" required>
                    </div>

                    <div class="form-group">
                        <label for="post_category_id">Post Category</label></br>
                        <select class="form-control" name="post_category_id" id="post_category_id" required>
                            <option value="" disabled hidden selected>Select category</option>
                            <?php

                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $query);

                            confirm_query($select_categories);

                            while ($row = mysqli_fetch_assoc($select_categories)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                echo "<option value='$cat_id'>$cat_title</option>";
                            }

                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_author">Post Author</label>
                        <input class="form-control" type="text" name="post_author" id="post_author" required>

                        <!-- <select class="form-control" name="post_author" id="post_author" required>
                            <option value="" disabled hidden selected>Select author</option>
                            <?php

                            $query = "SELECT * FROM users";
                            $select_users = mysqli_query($connection, $query);

                            confirm_query($select_users);

                            while ($row = mysqli_fetch_assoc($select_users)) {
                                $user_id = $row['user_id'];
                                $username = $row['username'];

                                echo "<option value='$user_id'>$username</option>";
                            }

                            ?>
                        </select> -->
                    </div>

                    <div class="form-group">
                        <label for="post_status">Post Status</label>
                        <select class="form-control" name="post_status" id="post_status" required>
                            <option value="draft" disabled hidden selected>Select status</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_image">Post Image</label></br>
                        <input type="file" name="post_image" id="post_image" required>
                    </div>

                    <div class="form-group">
                        <label for="post_tags">Post Tags</label>
                        <input class="form-control" type="text" name="post_tags" id="post_tags" required>
                    </div>

                    <div class="form-group">
                        <label for="summernote">Post Content</label>
                        <textarea class="form-control" name="post_content" id="summernote" rows="10" required></textarea>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>