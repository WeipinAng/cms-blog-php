<?php include "../includes/db.php"; ?>
<?php include "functions.php"; ?>

<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>CMS System | Registration</title>

    <!-- Custom fonts for this template-->
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet"
    />

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />

    <!-- Custom styles for dataTables -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Bar Chart from Google Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Summernote WYSIWYG Editor -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/summernote.css">
    
  </head>

  <body id="page-top">

<?php

if (isset($_POST['submit'])) {
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $user_email = escape($_POST['user_email']);
    $username = escape($_POST['username']);
    $user_password = escape($_POST['user_password']);

    if (!empty($user_firstname) && !empty($user_lastname) && !empty($user_email) && !empty($username) && !empty($user_password)) {

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

        // $user_image = $_FILES['user_image']['name'];
        // $user_image_temp = $_FILES['user_image']['tmp_name'];
        // move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) VALUES ('$username', '$user_password', '$user_firstname', '$user_lastname', '$user_email', 'subscriber')";

        $register_user_query = mysqli_query($connection, $query);
        confirm_query($register_user_query);

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
                        Your registration has been submitted. &nbsp; <a href='../index.php' class='alert-link'>Login</a>
                    </div>
            </div>
        ";

        } else {

        $message = "
        <svg xmlns='http://www.w3.org/2000/svg' style='display: none;'>
        <symbol id='exclamation-triangle-fill' fill='currentColor' viewBox='0 0 16 16'>
            <path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
        </symbol>
        </svg>
        <div class='alert alert-danger d-flex align-items-center' role='alert'>
            <svg class='bi flex-shrink-0 me-2' width='24' height='24' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
            &nbsp;&nbsp;&nbsp;
                <div>
                    Fields cannot be empty
                </div>
        </div>
        ";

        }
} else {
    $message = "";
}

?>

    <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-image"
                    style="background-image: url(img/registration.jpg); 
	                height: auto; background-repeat: no-repeat; background-size:cover;">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <?php echo $message; ?>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="" method="post" enctype="multipart/form-data" autocomplete="off">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="user_firstname" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="user_lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="username" class="form-control form-control-user" name="username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="user_email" placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="user_password" placeholder="Password" onChange="onChange()">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="repeat_password" placeholder="Repeat Password" onChange="onChange()">
                                    </div>
                                    <script>
                                        function onChange() {
                                            const password = document.querySelector('input[name=user_password]');
                                            const confirm = document.querySelector('input[name=repeat_password]');
                                            if (confirm.value === password.value) {
                                                confirm.setCustomValidity('');
                                            } else {
                                                confirm.setCustomValidity('Passwords do not match');
                                            }
                                        }
                                    </script>
                                </div>
                                
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Register Account">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="../index.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php include "includes/admin_footer.php"; ?>