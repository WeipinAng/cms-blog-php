<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Change role</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>

                <?php

                // CRUD 2: READ ALL USERS
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($select_users)) {
                    $user_id = $row['user_id'];
                    $username = $row['username'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_image = $row['user_image'];
                    $user_role = $row['user_role'];

                    echo "<tr>";
                    echo "<td>{$user_id}</td>";
                    echo "<td>{$username}</td>";
                    echo "<td>{$user_firstname}</td>";
                    echo "<td>{$user_lastname}</td>";
                    echo "<td>{$user_email}</td>";
                    echo "<td>{$user_role}</td>";
                    echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a>
                    </br>
                              <a href='users.php?change_to_subscriber=$user_id'>Subscriber</a></td>";
                    echo "<td><a href='users.php?source=update_user&update=$user_id'>Update</a>
                    </br>
                              <a href='users.php?delete=$user_id' onClick=\"javascript: return confirm('Are you sure you want to delete this user, $user_firstname $user_lastname?')\">Delete</a></td>";
                    echo "</tr>";
                }

                ?>


                <?php

                // CHANGE ROLE
                if(isset($_GET['change_to_admin'])) {
                    $user_id = escape($_GET['change_to_admin']);

                    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = '$user_id'";
                    $change_to_user_query = mysqli_query($connection, $query);

                    confirm_query($change_to_user_query);
                    header('Location: users.php');
                }

                if(isset($_GET['change_to_subscriber'])) {
                    $user_id = escape($_GET['change_to_subscriber']);

                    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = '$user_id'";
                    $change_to_subs_query = mysqli_query($connection, $query);

                    confirm_query($change_to_subs_query);
                    header('Location: users.php');
                }


                // CRUD 4: DELETE USER
                if(isset($_GET['delete'])) {
                    if (isset($_SESSION['user_role'])) {
                        if ($_SESSION['user_role'] == 'admin') {
                            $user_id = escape($_GET['delete']);

                            $query = "DELETE FROM users WHERE user_id = '$user_id'";
                            $delete_query = mysqli_query($connection, $query);

                            confirm_query($delete_query);
                            $_SESSION['delete_noti'] = 'User has been deleted successfully.';
                            header('Location: users.php');
                        }
                    }
                }

                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>