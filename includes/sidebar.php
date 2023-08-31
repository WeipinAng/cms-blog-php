<div class="col-lg-4">
    <!-- Search widget-->
    <div class="card mb-4">
    <div class="card-header">Blog Search</div>
    <div class="card-body">
        <form action="search.php" method="post" autocomplete="off">
            <div class="input-group">
                <input name="search" class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                <button name="submit" class="btn btn-primary" id="button-search" type="submit">Go!</button>
            </div>
        </form>
    </div>
    </div>

    <!-- Login widget-->
    <div class="card mb-4">
    <div class="card-header">Login</div>
    <div class="card-body">
        <form action="includes/login.php" method="post" autocomplete="off">
            <div class="form-group">
                <input name="username" class="form-control" type="text" placeholder="Enter username" onkeypress='return event.charCode==32 || event.charCode>=48 && event.charCode<=57 || event.charCode>=65 && event.charCode<=90 || event.charCode>=97 && event.charCode<=122'' required />
            </div>
            </br>
            <div class="input-group">
                <input name="password" class="form-control" type="password" placeholder="Enter password" required />
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </span>
            </div>
        </form>
    </div>
    </div>

    <!-- Categories widget-->
    <div class="card mb-4">
    <div class="card-header">Blog Categories</div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
            <ul class="list-unstyled mb-0">

        <?php

        $query = "SELECT * FROM categories";
        $select_categories_sidebar = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_categories_sidebar)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            
            echo "<li><a href='category.php?cat_id=$cat_id'>{$cat_title}</a></li>";
        }

        ?>

            </ul>
        </div>
        </div>
    </div>
    </div>

</div>