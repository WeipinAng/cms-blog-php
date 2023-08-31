<div class="row">

    <div class="col-lg-12">
        <?php

        // CRUD 1: ADD NEW USER
        if (isset($_POST['create_user'])) {
            $user_firstname = escape($_POST['user_firstname']);
            $user_lastname = escape($_POST['user_lastname']);
            $user_role = $_POST['user_role'];
            $username = escape($_POST['username']);
            $user_email = escape($_POST['user_email']);
            $user_password = escape($_POST['user_password']);

            // $user_image = $_FILES['user_image']['name'];
            // $user_image_temp = $_FILES['user_image']['tmp_name'];
            // move_uploaded_file($post_image_temp, "../images/$post_image");

            $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));

            $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) VALUES ('$username', '$user_password', '$user_firstname', '$user_lastname', '$user_email', '$user_role')";

            $create_user_query = mysqli_query($connection, $query);
            confirm_query($create_user_query);

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
                            User has been created successfully. &nbsp; <a href='users.php' class='alert-link'>View All Users</a>
                        </div>
                </div>
            ";
        }

        ?>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New User</h6>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" autocomplete="off">                  
                    <div class="form-group">
                        <label for="user_firstname">First name</label></br>
                        <input class="form-control" type="text" name="user_firstname" id="user_firstname" required>
                    </div>

                    <div class="form-group">
                        <label for="user_lastname">Last name</label>
                        <input class="form-control" type="text" name="user_lastname" id="user_lastname" required>
                    </div>

                    <div class="form-group">
                        <label for="user_role">Role</label></br>
                        <select class="form-control" name="user_role" id="user_role" required>
                            <option value="subscriber" disabled hidden selected>Select roles</option>
                            <option value="admin">Admin</option>
                            <option value="subscriber">Subscriber</option>
                        </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username" required>
                    </div>

                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input class="form-control" type="email" name="user_email" id="user_email" required>
                    </div>

                    <div class="form-group">
                        <label for="user_password">Password</label>
                        <input class="form-control" type="password" name="user_password" id="user_password" required>
                    </div>

                    <!-- <div class="form-group">
                        <label for="user_image">Profile Image</label></br>
                        <input type="file" name="user_image" id="user_image" required>
                    </div> -->

                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>