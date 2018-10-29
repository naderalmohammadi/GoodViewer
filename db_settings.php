<?php


$db_host = "localhost"; 
$db_name = "goodviewer"; 
$db_user = "root"; 
$db_pass = "1411"; 



GLOBAL $errors;
GLOBAL $successes;

$errors = array();
$successes = array();


$mysqli = new mysqli($db_host, $db_user, $db_pass, $db_name);
GLOBAL $mysqli;

if (mysqli_connect_errno()) {

    echo "Connection Failed: " . mysqli_connect_errno();
    exit();
}

?>