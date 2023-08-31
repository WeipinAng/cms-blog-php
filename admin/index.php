<?php include "includes/admin_header.php"; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

    <?php include "includes/admin_navigation.php"; ?>
    
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h4 mb-0 text-gray-800">Dashboard</h1>
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
            </div>

            <!-- Content Row -->
            <div class="row">
              <!-- POSTS Card -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body text-primary">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                          Posts Published / Total
                        </div>
                        <?php

                        $query = "SELECT * FROM posts";
                        $select_all_post = mysqli_query($connection, $query);
                        $post_counts = mysqli_num_rows($select_all_post);

                        $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                        $select_all_draft_post = mysqli_query($connection, $query);
                        $post_draft_counts = mysqli_num_rows($select_all_draft_post);

                        $query = "SELECT * FROM posts WHERE post_status = 'published'";
                        $select_all_published_post = mysqli_query($connection, $query);
                        $post_published_counts = mysqli_num_rows($select_all_published_post);

                        ?>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                              <?php echo $post_published_counts; ?> / <?php echo $post_counts; ?>
                            </div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                class="progress-bar bg-primary"
                                role="progressbar"
                                style="width:<?php echo ($post_published_counts*100/$post_counts)?>%"
                                aria-valuenow="<?php echo $post_published_counts; ?>"
                                aria-valuemin="0"
                                aria-valuemax="<?php echo $post_counts; ?>"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>

                    <hr class="sidebar-divider" />

                    <a href="posts.php" class="text-reset">
                      <span>View Details</span>
                      <span class="col ml-2"><i class="fa fa-arrow-circle-right"></i></span>
                    </a>
                  </div>
                </div>
              </div>

              <!-- CATEGORIES Card -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body text-success">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                          Categories
                        </div>
                        <?php

                        $query = "SELECT * FROM categories";
                        $select_all_category = mysqli_query($connection, $query);
                        $category_counts = mysqli_num_rows($select_all_category);

                        ?>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                          <?php echo $category_counts; ?>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-list fa-2x text-gray-300"></i>
                      </div>
                    </div>

                    <hr class="sidebar-divider" />

                    <a href="categories.php" class="text-reset">
                      <span>View Details</span>
                      <span class="col ml-2"><i class="fa fa-arrow-circle-right"></i></span>
                    </a>
                  </div>
                </div>
              </div>

              <!-- COMMENTS Card -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body text-warning">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                          Comments Approved / Total
                        </div>
                        <?php

                        $query = "SELECT * FROM comments";
                        $select_all_comment = mysqli_query($connection, $query);
                        $comment_counts = mysqli_num_rows($select_all_comment);

                        $query = "SELECT * FROM comments WHERE comment_status = 'approved'";
                        $select_all_approved_comment = mysqli_query($connection, $query);
                        $comment_approved_counts = mysqli_num_rows($select_all_approved_comment);

                        $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                        $select_all_unapproved_comment = mysqli_query($connection, $query);
                        $comment_unapproved_counts = mysqli_num_rows($select_all_unapproved_comment);

                        ?>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                              <?php echo $comment_approved_counts; ?> / <?php echo $comment_counts; ?>
                            </div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                class="progress-bar bg-warning"
                                role="progressbar"
                                style="width:<?php echo ($comment_approved_counts*100/$comment_counts)?>%"
                                aria-valuenow="<?php echo $comment_approved_counts; ?>"
                                aria-valuemin="0"
                                aria-valuemax="<?php echo $comment_counts; ?>"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>

                    <hr class="sidebar-divider" />

                    <a href="comments.php" class="text-reset">
                      <span>View Details</span>
                      <span class="col ml-2"><i class="fa fa-arrow-circle-right"></i></span>
                    </a>
                  </div>
                </div>
              </div>

              <!-- NEW USERS Card -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body text-info">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                          Admin / Total users
                        </div>
                        <?php

                        $query = "SELECT * FROM users";
                        $select_all_user = mysqli_query($connection, $query);
                        $user_counts = mysqli_num_rows($select_all_user);

                        $query = "SELECT * FROM users WHERE user_role = 'admin'";
                        $select_all_admin = mysqli_query($connection, $query);
                        $admin_counts = mysqli_num_rows($select_all_admin);

                        $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                        $select_all_subscriber = mysqli_query($connection, $query);
                        $subscriber_counts = mysqli_num_rows($select_all_subscriber);

                        ?>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                              <?php echo $admin_counts; ?> / <?php echo $user_counts; ?>
                            </div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div
                                class="progress-bar bg-info"
                                role="progressbar"
                                style="width:<?php echo ($admin_counts*100/$user_counts)?>%"
                                aria-valuenow="<?php echo $admin_counts; ?>"
                                aria-valuemin="0"
                                aria-valuemax="<?php echo $user_counts; ?>"
                              ></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                      </div>
                    </div>

                    <hr class="sidebar-divider" />

                    <a href="users.php" class="text-reset">
                      <span>View Details</span>
                      <span class="col ml-2"><i class="fa fa-arrow-circle-right"></i></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Bar Chart -->
              <div class="col-xl-12 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                      CMS Overview
                    </h6>
                  </div>
                  <?php

                  ?>
                  <!-- Card Body -->
                  <div class="card-body">
                    <!-- Chart Plugin JS -->
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                          ['', ''],

                          <?php

                          $element_text = ['Total posts', 'Published posts', 'Draft posts', 'Categories', 'Total Comments', 'Approved comments', 'Admin', 'Subscribers'];
                          $element_count = [$post_counts, $post_published_counts, $post_draft_counts, $category_counts, $comment_counts, $comment_approved_counts, $admin_counts, $subscriber_counts];

                          for ($i = 0; $i < 8; $i++) {
                            echo "['$element_text[$i]', $element_count[$i]],";
                          }

                          ?>
                        ]);

                        var options = {
                          chart: {
                            title: '',
                            subtitle: '',
                          },
                          vAxis: {format: 'decimal'},
                          colors: ['#4e73df']
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 400px;"></div>
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