<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Comments</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover w-auto small" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Author & Email</th>
                        <th>In response to</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Approval</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>

                <?php

                // CRUD 2: READ ALL COMMENTS
                $query = "SELECT * FROM comments ORDER BY comment_id DESC";
                $select_comments = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_comments)) {
                    $comment_id = $row['comment_id'];
                    $comment_post_id = $row['comment_post_id'];
                    $comment_author = $row['comment_author'];
                    $comment_email = $row['comment_email'];
                    $comment_content = $row['comment_content'];
                    $comment_status = $row['comment_status'];
                    $comment_date = $row['comment_date'];

                    echo "<tr>";
                    echo "<td>{$comment_id}</td>";
                    echo "<td>{$comment_author} </br></br> {$comment_email} </td>";
                    // echo "<td>{$comment_email}</td>";

                    $query = "SELECT * FROM posts WHERE post_id = '$comment_post_id'";
                    $select_posts_id = mysqli_query($connection, $query);
                    while ($row = mysqli_fetch_assoc($select_posts_id)) {
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                    
                    echo "<td><a href='../post.php?post_id=$post_id'>{$post_title}</a></td>";
                    }

                    echo "<td>{$comment_content}</td>";
                    echo "<td>{$comment_status}</td>";
                    echo "<td>{$comment_date}</td>";
                    echo "<td><a href='comments.php?approve=$comment_id'>Approve</a>
                    </br></br>
                              <a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
                    echo "<td><a href='comments.php?delete=$comment_id' onClick=\"javascript: return confirm('Are you sure you want to delete this comment by $comment_author?')\">Delete</a></td>";
                    echo "</tr>";
                }

                ?>


                <?php

                // APPROVE OR UNAPPROVE
                if(isset($_GET['approve'])) {
                    $comment_id = escape($_GET['approve']);

                    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$comment_id'";
                    $approve_comment_query = mysqli_query($connection, $query);

                    confirm_query($approve_comment_query);
                    header('Location: comments.php');
                }

                if(isset($_GET['unapprove'])) {
                    $comment_id = escape($_GET['unapprove']);

                    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$comment_id'";
                    $unapprove_comment_query = mysqli_query($connection, $query);

                    confirm_query($unapprove_comment_query);
                    header('Location: comments.php');
                }


                // CRUD 4: DELETE COMMENT
                if(isset($_GET['delete'])) {
                    if (isset($_SESSION['user_role'])) {
                        if ($_SESSION['user_role'] == 'admin') {
                            $comment_id = escape($_GET['delete']);

                            $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
                            $delete_query = mysqli_query($connection, $query);

                            // $query = "UPDATE posts SET post_comment_count = post_comment_count-1 WHERE post_id = $post_id";
                            // $decrease_comment_count_query = mysqli_query($connection, $query);

                            confirm_query($delete_query);
                            // confirm_query($decrease_comment_count_query);
                            header('Location: comments.php');
                        }
                    }
                }

                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>