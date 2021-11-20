<?php

	if(!isset($_SESSION)){
		// Initialize the session
		session_start();
	}

	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}

	function post($key)
	{
		if (isset($_POST[$key]))
			return $_POST[$key];
		return false;
	}

	include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config.php';

	if ($_POST['action'] == "banningUser") {
		if (isset($_POST['isBanned'])) {
			// Prepare an insert statement
			$sql = "UPDATE users SET isBanned = 1 WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE users SET bannedReason = '" . $_POST["banReason"] . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$todayTime = date("Y-m-d H:i:s");
			$sql = "UPDATE users SET bannedDate = '" . $todayTime . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);
		} else {
			// Prepare an insert statement
			$sql = "UPDATE users SET isBanned = 0 WHERE id = '" . $_POST['id'] . "'";
		}
	}

// lets run our query
	$result = mysqli_query($link, $sql);

// setup our response "object"
	$resp = new stdClass();
	$resp->success = false;
	if ($result) {
		$resp->success = true;
	}

//echo($link -> error);

	print json_encode($resp);
?>