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

	else if ($_POST['action'] == "currencyChange") {
		// Prepare an insert statement
		$sql = "UPDATE users SET currency = '" . $_POST["amount"] . "' WHERE id = '" . $_POST['id'] . "'";
	}

	else if ($_POST['action'] == "updateSiteSettings") {
		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '". $_POST["site_name"]. "' WHERE name = 'site_name'";
		$result = mysqli_query($link, $sql);

		if (isset($_POST['registration'])) {
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'on' WHERE name = 'registration'";
			$result = mysqli_query($link, $sql);
		}
		else
		{
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'off' WHERE name = 'registration'";
			$result = mysqli_query($link, $sql);
		}

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '". $_POST["currency"]. "' WHERE name = 'currency'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '". $_POST["premiumIcon"]. "' WHERE name = 'premiumIcon'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '". $_POST["verifiedIcon"]. "' WHERE name = 'verifiedIcon'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '". $_POST["appealEmail"]. "' WHERE name = 'appealEmail'";
		$result = mysqli_query($link, $sql);

		if (isset($_POST['maintenance'])) {
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'on' WHERE name = 'maintenanceMode'";
			$result = mysqli_query($link, $sql);
		}
		else
		{
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'off' WHERE name = 'maintenanceMode'";
			$result = mysqli_query($link, $sql);
		}

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '". $_POST["admin_site_name"]. "' WHERE name = 'admin_site_name'";
		$result = mysqli_query($link, $sql);
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