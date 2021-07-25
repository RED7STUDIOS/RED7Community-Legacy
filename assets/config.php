<?php
/*
  File Name: config.php
  Original Location: /assets/config.php
  Description: Config file for the Database and APIs.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

// The Domain URL.
$ROOT_URL = "http://localhost";
// The API URL.
$API_URL = $ROOT_URL. "/API";
// The Admin Panel URL.
$ADMIN_URL = "";
// The Storage URL.
$STORAGE_URL = "https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community@main/CDN";
// The CDN URL for assets.
$CDN_URL = "https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community@main"

// Other Options.
$CUSTOM_SESSION_LOCATION = false;
$CSL_PATH = "";
$API_KEY = "CvHKAVEBzGveKVUpLaUZZWgHt";

/* Database credentials. */
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'communitysite_main');
define('DB_PASSWORD', 'c0mmun1tys1te');
define('DB_NAME', 'communitysite_main');
 
/* Attempt to connect to MySQL database with the credentials. */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
	// Kill it, if it cannot connect.
  die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>