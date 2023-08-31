<?php include "includes/admin_header.php"; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include "includes/admin_navigation.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h4 mb-4 text-gray-800">Posts</h1>

                <!-- Notification for deleting user successfully -->
                <?php
                if (isset($_SESSION['delete_noti'])) {
                    $delete_noti = $_SESSION['delete_noti'];

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
                                    $delete_noti
                                </div>
                        </div>
                    ";
                    unset($_SESSION['delete_noti']); // we are unsetting it so that on the next page refresh, the message will get lost, no need to be there permanently.
                }
                ?>

                <!-- Switch Statement: Check for a condition -->
                <?php

                if(isset($_GET['source'])) {
                    $source = escape($_GET['source']);
                } else {
                    $source = '';
                }

                // $source = NULL;
                // if(isset($_GET['source'])) {
                //     $source = $_GET['source'];
                // }

                // $source = isset($_GET['source']) ? $_GET['source'] : null;

                switch ($source) {
                    case 'add_post':
                        include "includes/add_post.php";
                        break;
                    
                    case 'update_post':
                        include "includes/update_post.php";
                        break;

                    default:
                        include "includes/view_all_posts.php";
                        break;
                }

                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include "includes/admin_footer.php"; ?>