<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Responsive navbar-->
    <?php include "includes/navigation.php"; ?>

    <!-- Page content-->
    <div class="container">
      <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header">Search Result</div>
            <div class="card-body">
                <?php
                if (isset($_POST['submit'])) {
                    $search = escape($_POST['search']);

                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%'";
                    $search_query = mysqli_query($connection, $query);
                    if (! $search_query) {
                        die('QUERY FAILED' . mysqli_error($connection));
                    }

                    $count = mysqli_num_rows($search_query);
                    if ($count == 0) {
                        echo '<h1>NO RESULT</h1>';
                    } else {
                      while ($row = mysqli_fetch_assoc($search_query)) {
                          $post_title = $row['post_title'];
                          $post_author = $row['post_author'];
                          $post_date = $row['post_date'];
                          $post_image = $row['post_image'];
                          $post_content = $row['post_content'];

                ?>

                      <!-- Blog post-->
                      <div class="card mb-4">
                        <a href="#"
                          ><img
                            class="card-img-top"
                            src="images/<?php echo $post_image; ?>"
                            alt="..."
                        /></a>

                        <div class="card-body">
                          <div class="small text-muted"><?php echo $post_date; ?> by <?php echo $post_author; ?></div>
                          <h2 class="card-title"><?php echo $post_title; ?></h2>
                          <p class="card-text">
                            <?php echo $post_content; ?>
                          </p>
                          <a class="btn btn-primary" href="#">Read more →</a>
                        </div>
                      </div>

                <?php
                      }
                    }
                }
                ?>

            </div>
          </div>
        </div>

        <!-- Side widgets-->
        <?php include "includes/sidebar.php"; ?>
      </div>
    </div>

<?php include "includes/footer.php"; ?>