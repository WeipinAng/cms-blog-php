    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="index.php">CMS</a>

        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php

            $query = "SELECT * FROM categories";
            $select_all_categories_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                
                echo "<li class='nav-item'><a class='nav-link' href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
            }

            ?>

            <li class="nav-item"><a class="nav-link" href="admin/registration.php">| &nbsp; Registration</a></li>
            <li class="nav-item"><a class="nav-link" href="admin/contact.php">Contact</a></li>
            <li class="nav-item"><a class="nav-link" href="admin">Admin</a></li>

            <?php

            // if (session_status() == PHP_SESSION_NONE) session_start();
            // another alternative is to add session_start in header.php [inside root/includes], so that you can start session in index.php of cms home site
            // first use session_start(); before attempting to work with $_SESSION. PHP will automatically decide, whether to start the new session or continue the previous one

            if (isset($_SESSION['user_role']) == 'admin') {
              if (isset($_GET['post_id'])) {
                $post_id = escape($_GET['post_id']);

                echo "<li class='nav-item'><a class='nav-link' href='admin/posts.php?source=update_post&update=$post_id'>Edit Post</a></li>";
              }
            }

            ?>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page header with logo and tagline-->
    <header class="py-5 bg-light border-bottom mb-4">
      <div class="container">
        <div class="text-center my-5">
          <h1 class="fw-bolder">Welcome to Home Page of Blogging System!</h1>
          <p class="lead mb-0">
            Be well prepared to be lured by our beguiling blog content!
          </p>
        </div>
      </div>
    </header>