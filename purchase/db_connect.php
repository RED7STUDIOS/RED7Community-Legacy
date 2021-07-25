<?php
/* Database connection start */
$servername = "localhost";
$username = "communitysite_purchases";
$password = "8tjW0l2#";
$dbname = "communitysite_purchases";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>