<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Responsive navbar-->
    <?php include "includes/navigation.php"; ?>

    <?php

    if (isset($_GET['post_author'])) {
      $post_author = escape($_GET['post_author']);
    }

    ?>

    <!-- Page content-->
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-8">
        <h3>All posts written by <?php echo $post_author; ?></h3>
        </br>

        <?php

        $query = "SELECT * FROM posts WHERE post_author = '$post_author' ORDER BY post_date DESC";
        $select_all_posts_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
          $post_id = $row['post_id'];
          $post_title = $row['post_title'];
          $post_author = $row['post_author'];
          $post_date = $row['post_date'];
          $post_image = $row['post_image'];
          
          $post_content = $row['post_content'];
          $post_content = implode(' ', array_slice(explode(' ', $post_content), 0, 30)) . ' ......';

        ?>

          <!-- Blog post-->
          <div class="card mb-4">
            <a href="post.php?post_id=<?php echo $post_id; ?>">
              <img
                  class="card-img-top"
                  src="images/<?php echo $post_image; ?>"
                  alt="image"
              />
            </a>

            <div class="card-body">
              <div class="small text-muted"><?php echo $post_date; ?> by <a href="author_posts.php?post_author=<?php echo $post_author; ?>&post_id=<?php echo $post_id; ?>" class="text-decoration-none"><?php echo $post_author; ?></a></div>
              <h3 class="card-title"><a class="text-decoration-none" href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h3>
              <p class="card-text">
                <?php echo $post_content; ?>
              </p>
              <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read more &rarr;</a>
            </div>
          </div>

        <?php } ?>

        </div>

        <!-- Side widgets-->
        <?php include "includes/sidebar.php"; ?>
      </div>
    </div>

<?php include "includes/footer.php"; ?>