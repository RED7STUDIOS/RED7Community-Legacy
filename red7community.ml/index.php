<?php
/*
  File Name: index.php
  Original Location: /index.php
  Description: The main index file.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: home.php");
	exit;
}
else
{
	header("location: login.php");
	exit;
}
?>