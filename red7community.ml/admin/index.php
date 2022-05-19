<?php

	if (!isset($_SESSION)) {
		// Initialize the session
		session_start();
	}

	// Check if the user is logged in, if not then redirect him to login page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: /login.php");
		exit;
	}

	include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config.php';

	$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $_SESSION['id']);

	// Decode the json response.
	if (!str_contains($data, "This user doesn't exist or has been deleted")) {
		$json_a = json_decode($data, true);

		$isAdmin = $json_a[0]['data'][0]['isAdmin'];
	}

	if ($isAdmin != 1) {
		header("HTTP/1.1 403 Forbidden");
		exit;
	}
?>



<html>
<head>
</head>
<body>
</body>
</html>