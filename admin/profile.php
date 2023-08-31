<?php include "includes/admin_header.php"; ?>

<?php

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // DISPLAY USER PROFILE (ALMOST SIMILAR TO UPDATE_USER)
    $query = "SELECT * FROM users WHERE username='$username'";
    $select_user_profile_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user_profile_query)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    }
}

?>

<?php

// UPDATE PROFILE
if (isset($_POST['update_profile'])) {
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
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
    $query .= "user_email = '$user_email' ";
    $query .= "WHERE user_id = $user_id";

    $update_user_query = mysqli_query($connection, $query);
    confirm_query($update_user_query);

    $message = "
        <svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
        <symbol id='check-circle-fill' fill='currentColor' viewBox='0 0 16 16'>
            <path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
        </symbol>
        </svg>
        <div class='alert alert-success d-flex align-items-center' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
            &nbsp;&nbsp;&nbsp;
                <div>
                    Your profile has been updated successfully.
                </div>
        </div>
    ";
} else {
    $message = '';
}

?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include "includes/admin_navigation.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h4 mb-4 text-gray-800">Your Profile</h1>

                <div class="row">

                    <div class="col-lg-12">

                        <?php echo $message; ?>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Profile Details</h6>
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
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" name="username" id="username" value="<?php if (isset($username)) {echo $username; } ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="user_email">Email</label>
                                        <input class="form-control" type="email" name="user_email" id="user_email" value="<?php if (isset($user_email)) {echo $user_email; } ?>" required>
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
                                        <input class="btn btn-primary" type="submit" name="update_profile" value="Update Profile">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include "includes/admin_footer.php"; ?>