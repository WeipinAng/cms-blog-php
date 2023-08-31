<?php include "admin/functions.php"; ?>

<?php ob_start(); ?>
<?php session_start(); ?>
<!-- make sure not to have any output or inclusion of the file that outputs something, before using session_start() because that can cause the issue that you're having [so we cannot start session in index.php]; so it's better to store it inside header file -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>CMS System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/blog-home.css" rel="stylesheet" />
    <!-- Custom styles for pagination -->
    <link href="css/styles.css" rel="stylesheet" />
  </head>
  <body>