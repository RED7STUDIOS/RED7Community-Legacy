<?php
/*
  File Name: config.php
  Original Location: /assets/config.php
  Description: Config file for the Database and APIs.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

// The domain URL.
$ROOT_URL = 'http://<URL>';
// The API URL.
$API_URL = $ROOT_URL. '/API';

// The Storage URL.
$STORAGE_URL = 'https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-CDN@main';

// Stripe keys for payment.
$STRIPE_SECRET_KEY = "";
$STRIPE_PUBLISHABLE_KEY = "";

// The status URL.
$STATUS_URL = 'https://status.red7community.ml';
$STATUS_GITHUB_URL = 'https://github.com/RED7STUDIOS/RED7Community-status';

// Other Options.
$CUSTOM_SESSION_LOCATION = false;
$CSL_PATH = 'D:\OneDrive - redsevenstudios.com\Users\Mitchell\Desktop\CommunitySite\Sessions\Main';

/* Database credentials. */
define('DB_SERVER', '<DB_HOST>');
define('DB_USERNAME', '<DB_USER>');
define('DB_PASSWORD', '<DB_PASSWORD>');
define('DB_NAME', '<DB_NAME>');

$SMTP_Debug  = 0;
$SMTP_Auth   = TRUE;
$SMTP_Secure = "ssl";
$SMTP_Port       = 465;
$SMTP_Host       = "smtp.gmail.com";
$SMTP_Username = 'USERNAME';
$SMTP_Password = 'APP_PASSWORD';
$SMTP_From = "USERNAME@gmail.com";

/* Attempt to connect to MySQL database with the credentials. */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){
// Kill it, if it cannot connect.
die('ERROR: Could not connect.' . mysqli_connect_error());
}
?>
