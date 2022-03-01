<?php

ini_set('display_errors', 1);
error_reporting(~0);

$serverName = "localhost";
$userName = "root";
$userPassword = "";
$dbName = "helpdeskdb";

$dbcon = mysqli_connect($serverName, $userName, $userPassword, $dbName);

if (mysqli_connect_errno()) {
        echo "Database Connect Failed : " . mysqli_connect_error();
        exit;
}
?>