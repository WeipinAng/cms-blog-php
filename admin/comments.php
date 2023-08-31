<?php include "includes/admin_header.php"; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include "includes/admin_navigation.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h4 mb-4 text-gray-800">Comments</h1>

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
                    case 'update_comment':
                        include "includes/update_comment.php";
                        break;

                    default:
                        include "includes/view_all_comments.php";
                        break;
                }

                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include "includes/admin_footer.php"; ?>