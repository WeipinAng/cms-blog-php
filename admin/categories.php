<?php include "includes/admin_header.php"; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include "includes/admin_navigation.php"; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h4 mb-4 text-gray-800">Categories</h1>

                <div class="row">

                    <div class="col-lg-6">
                        <?php

                        // CRUD 1: ADD NEW CATEGORY
                        create_categories();

                        ?>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Add Category</h6>
                            </div>
                            <div class="card-body">
                                <form action="" method="post" autocomplete="off">
                                    <div class="form-group">
                                        <label for="cat_title">New Category Title</label>
                                        <input class="form-control" type="text" name="cat_title" id="cat_title" required>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                    </div>
                                </form>
                            </div>
                        </div>



                        <?php

                        // DISPLAY CATEGORY_TITLE TO BE UPDATED LATER
                        if (isset($_GET['update'])) {
                            $cat_id = escape($_GET['update']);

                            $query = "SELECT * FROM categories WHERE cat_id = '$cat_id'";
                            $select_categories_id = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                        ?>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Update Category</h6>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="cat_title" value="<?php if (isset($cat_title)) {echo $cat_title; } ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                            }
                        }
                        ?>

                        <?php

                        // CRUD 3: UPDATE CATEGORY
                        update_categories();

                        ?>
                    </div>



                    <div class="col-lg-6">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Existing Categories</h6>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="categoryTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Category Title</th>
                                            <th colspan="2">Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php

                                    // CRUD 2: READ ALL CATEGORIES
                                    read_categories();

                                    ?>

                                    <?php

                                    // CRUD 4: DELETE CATEGORY
                                    delete_categories();

                                    ?>

                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php include "includes/admin_footer.php"; ?>