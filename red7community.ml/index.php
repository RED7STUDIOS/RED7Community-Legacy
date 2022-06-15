<?php
if (file_exists("assets/config.php")) {
	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
		header("location: home.php");
		exit;
	} else {
		header("location: /login.php?u=/home.php");
		exit;
	}
} else {
	header("location: install/start.php");
	exit;
}
