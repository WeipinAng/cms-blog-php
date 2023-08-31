<?php

// fetch from view_all_users.php
if (isset($_GET['update'])) {
    $user_id = escape($_GET['update']);

?>

<?php

// CRUD 3: UPDATE USER
if (isset($_POST['update_user'])) {
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_role = $_POST['user_role'];
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);

    // $user_image = $_FILES['user_image']['name'];
    // $user_image_temp = $_FILES['user_image']['tmp_name'];
    // move_uploaded_file($post_image_temp, "../images/$post_image");
    // if (empty($user_image)) {
    //     $query = "SELECT * FROM users WHERE user_id = '$user_id'";
    //     $select_image = mysqli_query($connection, $query);
        
    //     while ($row = mysqli_fetch_assoc($select_image)) {
    //         $user_image = $row['user_image'];
    //     }
    // }

    $query = "UPDATE users SET ";
    $query .= "username = '$username', ";

    if (!empty($user_password)) {
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
        $query .= "user_password = '$hashed_password', ";
    }

    $query .= "user_firstname = '$user_firstname', ";
    $query .= "user_lastname = '$user_lastname', ";
    $query .= "user_email = '$user_email', ";
    $query .= "user_role = '$user_role' ";
    $query .= "WHERE user_id = '$user_id'";

    $update_user_query = mysqli_query($connection, $query);
    confirm_query($update_user_query);

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
                    User has been updated successfully. &nbsp; <a href='users.php' class='alert-link'>View All Users</a>
                </div>
        </div>
    ";
}

?>

<?php

} else {
    header("Location: index.php");
}

?>

<div class="row">

    <div class="col-lg-12">

        <?php

        // DISPLAY EXISTING USER DETAILS TO BE UPDATED LATER
        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $select_users = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_users)) {
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];

        ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Existing User</h6>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <label for="user_firstname">First name</label></br>
                        <input class="form-control" type="text" name="user_firstname" id="user_firstname" value="<?php if (isset($user_firstname)) {echo $user_firstname; } ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="user_lastname">Last name</label>
                        <input class="form-control" type="text" name="user_lastname" id="user_lastname" value="<?php if (isset($user_lastname)) {echo $user_lastname; } ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="user_role">Role</label></br>
                        <select class="form-control" name="user_role" id="user_role" required>
                            <option value='<?php echo $user_role; ?>' selected><?php echo ucfirst($user_role); ?></option>
                            <?php

                            if ($user_role == 'admin') {
                                echo "<option value='subscriber'>Subscriber</option>";
                            } else {
                                echo "<option value='admin'>Admin</option>";
                            }

                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input class="form-control" type="email" name="user_email" id="user_email" value="<?php if (isset($user_email)) {echo $user_email; } ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" value="<?php if (isset($username)) {echo $username; } ?>" required>
                    </div>

                    <!-- <div class="form-group">
                        <p>Original Post Image</p>
                        <img src="../images/<?php echo $post_image; ?>" alt="original image" width="200">
                    </div>
                    <div class="form-group">
                        <label for="post_image">Update with New Post Image (this field is optional)</label></br>
                        <input type="file" name="post_image" id="post_image">
                    </div>
                    </br> -->

                    <div class="form-group">
                        <label for="user_password">Password (leave it empty if no change is needed)</label>
                        <input class="form-control" type="password" name="user_password" id="user_password" value="">
                    </div>

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="update_user" value="Update User">
                    </div>
                </form>
            </div>
        </div>

        <?php
        }
        ?>

    </div>
</div>