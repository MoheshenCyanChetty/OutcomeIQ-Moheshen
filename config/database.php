<?php
require_once('constants.php');
//
// connect to database
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_errno($connection)){
    die(mysqli_error($connection));
} //else echo "hello " . DB_NAME . " has been connected";
