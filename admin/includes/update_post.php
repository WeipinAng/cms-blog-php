<?php

// fetch from view_all_posts.php
if (isset($_GET['update'])) {
    $post_id = escape($_GET['update']);
}

?>

<?php

// CRUD 3: UPDATE POST
if (isset($_POST['update_post'])) {
    $post_title = escape($_POST['post_title']);
    $post_category_id = $_POST['post_category_id'];
    $post_author = escape($_POST['post_author']);
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $post_tags = escape($_POST['post_tags']);
    $post_content = escape($_POST['post_content']);

    move_uploaded_file($post_image_temp, "../images/$post_image");
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
        $select_image = mysqli_query($connection, $query);
        
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }
    // if (empty($post_image)) {
    //     $post_image = $post_image;
    // }

    
    $query = "UPDATE posts SET ";
    $query .= "post_category_id = '$post_category_id', ";
    $query .= "post_title = '$post_title', ";
    $query .= "post_author = '$post_author', ";
    $query .= "post_date = now(), ";
    $query .= "post_image = '$post_image', ";
    $query .= "post_content = '$post_content', ";
    $query .= "post_tags = '$post_tags', ";
    $query .= "post_status = '$post_status' ";
    $query .= "WHERE post_id = '$post_id'";

    $update_post_query = mysqli_query($connection, $query);

    confirm_query($update_post_query);

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

<div class="row">

    <div class="col-lg-12">

        <?php

        // DISPLAY EXISTING POST DETAILS TO BE UPDATED LATER
        $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
        $select_posts_id = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_posts_id)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_date = $row['post_date'];

        ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Existing Post</h6>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <label for="post_title">New Post Title</label>
                        <input class="form-control" type="text" name="post_title" id="post_title" value="<?php if (isset($post_title)) {echo $post_title; } ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="post_category_id">Post Category</label></br>
                        <select class="form-control" name="post_category_id" id="post_category_id" required>
                            <?php

                            $query = "SELECT * FROM categories";
                            $select_categories = mysqli_query($connection, $query);

                            confirm_query($select_categories);

                            while ($row = mysqli_fetch_assoc($select_categories)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                // check if the $post_category_id foreign key matches the current category id in the loop and if it does, it will append selected attribute to the option tag in order to select it
                                if ($post_category_id == $cat_id) {
                                    echo "<option value='$cat_id' selected>$cat_title</option>";
                                } else {
                                    echo "<option value='$cat_id'>$cat_title</option>";
                                }
                            }

                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="post_author">Post Author</label>
                        <input class="form-control" type="text" name="post_author" id="post_author" value="<?php if (isset($post_author)) {echo $post_author; } ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="post_status">Post Status</label>
                        <select class="form-control" name="post_status" id="post_status" required>
                            <option value="<?php echo $post_status; ?>" selected><?php echo ucfirst($post_status); ?></option>
                            <?php

                            if ($post_status == 'published') {
                                echo "<option value='draft'>Draft</option>";
                            } else {
                                echo "<option value='published'>Published</option>";
                            }

                            ?>
                        </select>

                        <!-- <select class="form-control" name="post_status" id="post_status" required>
                            <option value="draft" <?php if ($post_status == 'draft') { echo 'selected'; } ?>>Draft</option>
                            <option value="published" <?php if ($post_status == 'published') { echo 'selected'; } ?>>Published</option>
                        </select> -->
                    </div>
                    </br>

                    <div class="form-group">
                        <p>Original Post Image</p>
                        <img src="../images/<?php echo $post_image; ?>" alt="original image" width="200">
                    </div>
                    <div class="form-group">
                        <label for="post_image">Update with New Post Image (this field is optional)</label></br>
                        <input type="file" name="post_image" id="post_image">
                    </div>
                    </br>

                    <div class="form-group">
                        <label for="post_tags">Post Tags</label>
                        <input class="form-control" type="text" name="post_tags" id="post_tags" value="<?php if (isset($post_tags)) {echo $post_tags; } ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="summernote">Post Content</label>
                        <textarea class="form-control" name="post_content" id="summernote" rows="10" required><?php if (isset($post_content)) {echo $post_content; } ?></textarea>
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
                    </div>
                </form>
            </div>
        </div>

        <?php
        }
        ?>

    </div>
</div>