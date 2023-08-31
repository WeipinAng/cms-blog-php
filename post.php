<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Responsive navbar-->
    <?php include "includes/navigation.php"; ?>

    <?php

    if (isset($_GET['post_id'])) {
      $post_id = escape($_GET['post_id']);

      $view_query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $post_id";
      $send_view_query = mysqli_query($connection, $view_query);
      confirm_query($send_view_query);

    ?>

    <?php

    $query = "SELECT * FROM posts WHERE post_id = '$post_id'";
    $select_all_posts_query = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts_query)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
    }

    ?>

    <!-- Page content-->
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-8">
          <!-- Post content-->
          <article>
            <!-- Post header-->
            <header class="mb-4">
              <!-- Post title-->
              <h1 class="fw-bolder mb-1"><?php echo $post_title ?></h1>
              <!-- Post meta content-->
              <div class="text-muted fst-italic mb-2">
                Posted on <?php echo $post_date ?> by <?php echo $post_author ?>
              </div>
              <!-- Post tags-->
              <?php
              $tags_array = explode(',', $post_tags);

              foreach ($tags_array as $tags) {
                echo "<a class='badge bg-secondary text-decoration-none link-light' href='#'>
                $tags</a>&nbsp;";
              }
              ?>
            </header>

            <!-- Preview image figure-->
            <figure class="mb-4">
              <img
                class="img-fluid rounded"
                src="images/<?php echo $post_image; ?>"
                alt="image"
              />
            </figure>
            <!-- Post content-->
            <section class="mb-5">
              <p class="fs-5 mb-4">
                <?php echo $post_content ?>
              </p>
            </section>
          </article>
    
    <?php
    } else {
      header("Location: index.php");
    }
    ?>

          <!-- Comments section-->
          <?php

          // $_SERVER['REQUEST_METHOD'] === 'POST'  ->  isset check (safer and avoid complications compared to $_POST super global, because this only checks for the request type; $_POST will check for certain key which represents one of the names from the fields of the form, resulting in failure if fellow coder/programmer changes accidentally the name of the field)
          // Add additional check using && isset($_POST['create_comment']) if we have multiple queries ($_POST) as the REQUEST_METHOD only checks for the method POST, rather than name attributes
          // CRUD 1: ADD NEW COMMENT
          if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_comment'])) {
            $comment_post_id = escape($_GET['post_id']);

            $comment_author = escape($_POST['comment_author']);
            $comment_email = $_POST['comment_email'];
            $comment_content = escape($_POST['comment_content']);

            
            if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
              $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) VALUES ($comment_post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";

              $create_comment_query = mysqli_query($connection, $query);
              confirm_query($create_comment_query);

              // INCREMENT TO POST COMMENT COUNT WHEN A COMMENT IS ADDED
              // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = '$comment_post_id'";
              // $update_comment_count = mysqli_query($connection, $query);
              // confirm_query($update_comment_count);

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
                            Your comment has been submitted and is pending for approval.
                        </div>
                </div>
              ";
            } else {
              // L193: Everything done in html is basically cosmetic and based on the clientside. If you rely on the required tags, you will get a big surprise. I could easily remove the required tags with the console from your form, if you then don't have a check in php I will be able to sneak in empty fields into your database and go around your attributes. Those attributes are purely used to show the users in a nice way that they need to file out an input, but as said they are not meant by any means to do a security check.
              // PHP checks things based on the serverside, that means that there is no easy way to go around your requirements a normal user can't dable around with the console and reach into your php. This is why you always should verify your forms with PHP, even when you use javascript or html to create a nice optic feedback for the users.
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

            // redirect("post.php?post_id=$post_id");

          } else {
            $message = "";
          }

          ?>

          <section class="mb-5">
              <div class="card bg-light">
                  <div class="card-body">
                  <!-- Comment form-->
                  <form class="mb-4" action="" method="post" autocomplete="off">
                      <?php echo $message; ?>
                      <div class="form-group">
                          <label for="comment_author">Comment Author</label>
                          <input class="form-control" type="text" name="comment_author" id="comment_author" required>
                      </div>

                      <div class="form-group">
                          <label for="comment_email">Email</label>
                          <input class="form-control" type="email" name="comment_email" id="comment_email" required>
                      </div>

                      </br>

                      <div class="form-group">
                          <textarea class="form-control" name="comment_content" rows="3" placeholder="Join the discussion and leave a comment!" required></textarea>
                      </div>
                      
                      </br>

                      <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="create_comment" value="Submit">
                      </div>
                  </form>

                  <?php

                  // DISPLAY COMMENTS OF A SPECIFIC POST
                  $query = "SELECT * FROM comments WHERE comment_post_id = '$post_id' AND comment_status = 'approved' ORDER BY comment_id DESC";
                  $select_comments_query = mysqli_query($connection, $query);

                  confirm_query($select_comments_query);

                  while ($row = mysqli_fetch_assoc($select_comments_query)) {
                    $comment_author = $row['comment_author'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];

                  ?>

                  <div class="d-flex">
                      <div class="flex-shrink-0">
                      <img
                          class="img-profile rounded-circle"
                          src="admin/img/undraw_profilepic.png"
                          style="width: 40px"
                      />
                      </div>
                      <div class="ms-3">
                      <div class="fw-bold"><?php echo $comment_author; ?>&nbsp; <small class="text-muted fst-italic">Posted on <?php echo $comment_date ?></small>
                      </div>
                      <?php echo $comment_content; ?>
                      </div>
                  </div>
                  </br>

                  <?php } ?>

                  </div>
              </div>
          </section>
          
        </div>

        <!-- Side widgets-->
        <?php include "includes/sidebar.php"; ?>
      </div>
    </div>

<?php include "includes/footer.php"; ?>