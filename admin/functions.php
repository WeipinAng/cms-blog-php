<?php

function escape($string) {
    global $connection;

    return mysqli_real_escape_string($connection, $string);
}


function users_online()
{
    if (isset($_GET['onlineusers'])) {

        global $connection; // this is only available in admin_header.php only
        if (!$connection) {
            session_start();
            include("../includes/db.php");

            // it doesn't hold anything, it just returns session_id, each session has a unique id
            $session = session_id();
            // return current timestamp that has passed up to this point, representing current time in milliseconds
            $time = time();
            // if user is logged out or offline for 30 seconds, save them so online user count can decrease
            $time_out_in_seconds = 05;
            // check for users that were logged in last 30 seconds
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            $count = mysqli_num_rows($send_query);

            // if the user is not tracked up until now, then we should track it in order to determine current number of online users (track based on current session_id)
            if ($count == NULL) {
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");
            } else {
            // user has been there before
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");
            }

            // display the user count the user's online based on how many minutes they've been on our site
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);
        }

    } // get request isset
}

users_online();


function confirm_query($result)
{
    global $connection;

    if (! $result) {
        die('QUERY FAILED' . mysqli_error($connection));
    }
}


function create_categories()
{
    global $connection;

    // ADD NEW CATEGORY
    if (isset($_POST['submit'])) {
        $cat_title = escape($_POST['cat_title']);

        if ($cat_title == '' || empty($cat_title)) {
            echo 'This field should not be empty';
        } else {
            $query = "INSERT INTO categories (cat_title) VALUES ('$cat_title')";
            $create_category_query = mysqli_query($connection, $query);

            if (! $create_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}


function read_categories()
{
    global $connection;

    // READ ALL CATEGORIES
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?update=$cat_id'>Update</a></td>";
        echo "<td><a href='categories.php?delete=$cat_id' onClick=\"javascript: return confirm('Are you sure you want to delete this category, $cat_title?')\">Delete</a></td>";
        echo "</tr>";
    }
}


function update_categories()
{
    global $connection;
    global $cat_id;

    // UPDATE CATEGORY
    if(isset($_POST['update_category'])) {
        $cat_title = escape($_POST['cat_title']);

        $query = "UPDATE categories SET cat_title='$cat_title' WHERE cat_id='$cat_id'";
        $update_query = mysqli_query($connection, $query);

        if (! $update_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }
    }
}


function delete_categories()
{
    global $connection;

    // DELETE CATEGORY
    if(isset($_GET['delete'])) {
        if (isset($_SESSION['user_role'])) {
            if ($_SESSION['user_role'] == 'admin') {
                $cat_id = escape($_GET['delete']);

                $query = "DELETE FROM categories WHERE cat_id='$cat_id'";
                $delete_query = mysqli_query($connection, $query);

                header('Location: categories.php');
            }
        }
    }
}


function redirect($location)
{
    // remove previously set headers
    // the header name to be removed
    // this parameter is case-insensitive
    // @return void
    return header("Location:" . $location);
}

?>