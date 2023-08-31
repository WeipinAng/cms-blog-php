<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Responsive navbar-->
    <?php include "includes/navigation.php"; ?>

    <!-- Page content-->
    <div class="container">
      <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
          <?php

          if (isset($_GET['cat_id'])) {
            $post_category_id = escape($_GET['cat_id']);
          }

          $query = "SELECT * FROM posts WHERE post_category_id = '$post_category_id' AND post_status = 'published' ORDER BY post_date DESC";
          $select_all_posts_query = mysqli_query($connection, $query);

          if (mysqli_num_rows($select_all_posts_query) == 0) {
            echo "<h4 class='text-center'>Sorry, there are no posts under this category at the moment.</h4> . </br>";
          }

          while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
              $post_id = $row['post_id'];
              $post_title = $row['post_title'];
              $post_author = $row['post_author'];
              $post_date = $row['post_date'];
              $post_image = $row['post_image'];

              $post_content = $row['post_content'];
              // $post_content = implode(' ', array_slice(str_word_count($post_content,1), 0, 20));
              $post_content = implode(' ', array_slice(explode(' ', $post_content), 0, 30)) . ' ......';
              // $post_content = substr($post_content, 0, 200);
              // if (strlen($post_content) >= 200) {
              //   $post_content = substr($post_content, 0, strrpos($post_content, ' ')) . ' ......';
              // } else {
              //   $post_content = $post_content;
              // }


          ?>

          <!-- Blog post-->
          <div class="card mb-4">
            <a href="post.php?post_id=<?php echo $post_id; ?>"
              ><img
                class="card-img-top"
                src="images/<?php echo $post_image; ?>"
                alt="image"
            /></a>

            <div class="card-body">
              <div class="small text-muted"><?php echo $post_date; ?> by <a href="author_posts.php?post_author=<?php echo $post_author; ?>" class="text-decoration-none"><?php echo $post_author; ?></a></div>
              <h3 class="card-title"><a class="text-decoration-none" href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h3>
              <p class="card-text">
                <?php echo $post_content; ?>
              </p>
              <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read more →</a>
            </div>
          </div>

          <?php } ?>

        </div>

        <!-- Side widgets-->
        <?php include "includes/sidebar.php"; ?>
      </div>
    </div>

<?php include "includes/footer.php"; ?>