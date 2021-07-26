<?php
/*
  File Name: logout.php
  Original Location: /account/logout.php
  Description: Logout account file.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="The logout page for CommunitySite.">
		<title>Logging out...</title>

		<!-- Bootstrap core CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<!-- Include FontAwesome :) -->
		<script src="<?php echo $STORAGE_URL; ?>/assets/fontawesome/js.js"></script>

		<!-- Custom styles for this page -->
		<link href="<?php echo $STORAGE_URL; ?>/assets/user/css/login.css" rel="stylesheet">

		<script src="<?php echo $STORAGE_URL; ?>/assets/fontawesome/js.js"></script>
	</head>

	<body class="text-center">
		<main class="form-signin">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<h1 class="h3 mb-3 fw-normal">Logging out of account...</h1>
			</form>
		</main>
	</body>
</html>

<?php
// Detect if the session isn't set.
if(!isset($_SESSION)){
	// Initialize the session
	session_start();
}

// If the loggedin variable is not true.
if ($_SESSION['loggedin'] != true) {
	// Redirect to login page
	header("location: ../login.php");
}

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();

// Redirect to login page
header("location: ../login.php");
exit;
?>