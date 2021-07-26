<?php
/*
  File Name: config.php
  Original Location: /assets/config.php
  Description: Config file for the Database and APIs.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

/* Database credentials. */
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'communitysite_main');
define('DB_PASSWORD', 'c0mmun1tys1te');
define('DB_NAME', 'red7community');
 
/* Attempt to connect to MySQL database with the credentials. */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
	// Kill it, if it cannot connect.
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>