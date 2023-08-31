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

          // PAGINATION
          $posts_per_page = 5;
          
          if (isset($_GET['page'])) {
            $page = escape($_GET['page']);
          } else {
            $page = "";
          }

          if ($page == "" || $page == 1) {
            $offset = 0;
          } else {
            $offset = ($page * $posts_per_page) - $posts_per_page;
          }

          $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
          $find_count = mysqli_query($connection, $post_query_count);
          $count = mysqli_num_rows($find_count);

          $count = ceil($count / $posts_per_page);


          $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_date DESC LIMIT $offset, $posts_per_page";
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
              <div class="small text-muted"><?php echo $post_date; ?> by <a href="author_posts.php?post_author=<?php echo $post_author; ?>" class="text-decoration-none"><?php echo $post_author; ?></a></div>
              <h3 class="card-title"><a class="text-decoration-none" href="post.php?post_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a></h3>
              <p class="card-text">
                <?php echo $post_content; ?>
              </p>
              <a class="btn btn-primary" href="post.php?post_id=<?php echo $post_id; ?>">Read more &rarr;</a>
            </div>
          </div>

          <?php
          }
          ?>

        </div>

        <!-- Side widgets-->
        <?php include "includes/sidebar.php"; ?>
      </div>
    </div>

    </br>

    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <?php

        if ($page == '') {
          // make Next button appears even if users first land on the index.php without "page"
          $page = 1;
        }

        if ($page != 1 && $page != '') {
          $prev_page = $page - 1;
          echo "<a class='page-link link-dark' href='index.php?page=$prev_page' tabindex='-1'>Previous</a>";
        }

        for ($i = 1; $i <= $count; $i++) {
          if ($i == $page || ($i == 1 && $page == "")) {
            echo "<li class='page-item'><a class='active_link page-link' href='index.php?page=$i'>$i</a></li>";
          } else {
            echo "<li class='page-item'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
          }
        }

        if ($page != $count && $page != '') {
          $next_page = $page + 1;
          echo "<a class='page-link link-dark' href='index.php?page=$next_page' tabindex='-1'>Next</a>";
        }

        ?>
      </ul>
    </nav>

    </br>

<?php include "includes/footer.php"; ?>