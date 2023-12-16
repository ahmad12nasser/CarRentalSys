<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dBName = "carrental";
$con = mysqli_connect($serverName, $userName, $password, $dBName);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
