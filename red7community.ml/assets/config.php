<?php
/*
  File Name: config.php
  Original Location: /assets/config.php
  Description: Config file for the Database and APIs.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

// The Domain URL.
$ROOT_URL = "http://localhost";
// The API URL.
$API_URL = "http://localhost:81";
// The Admin Panel URL.
$ADMIN_URL = "https://admin4390.cldm.ml"; // TODO : REMAKE ADMIN PANEL
// The Storage URL.
$STORAGE_URL = "https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main";

// Other Options.
$CUSTOM_SESSION_LOCATION = false;
$CSL_PATH = "D:\OneDrive - redsevenstudios.com\Users\Mitchell\Desktop\CommunitySite\Sessions\Main";

/* Database credentials. */
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'red7community');
define('DB_PASSWORD', 'red7community');
define('DB_NAME', 'red7community');
 
/* Attempt to connect to MySQL database with the credentials. */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
	// Kill it, if it cannot connect.
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>