<?php

/* AN ISSUE WITH VSC PHP Intellisense Plugin [most of the times VSC can't properly parse more complex PHP code, so will result in false notifications of errors, though it actually works fine]
--- It's advisable to use code editor that is more PHP oriented, such as Netbeans (free IDE) or PHPStorm

// more secure way: make the variables to be constant (little trick using array instead of converting them one by one)
$db['db_host'] = 'localhost';
$db['db_user'] = 'root';
$db['db_pass'] = '';
$db['db_name'] = 'cmsproject';

// a function to loop through array and convert key to constant and uppercase
foreach ($db as $key => $value) {
    // function to make constant
    define(strtoupper($key), $value);
}

// we are not required to use quotes when passing the constant, quotes are only used for strings
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// $connection = mysqli_connect('localhost', 'root', '', 'cmsproject');
*/

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cmsproject');

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// if ($connection) {
//    echo 'We are connected';
// }