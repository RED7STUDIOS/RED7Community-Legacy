<?php
/*
  File Name: logout.php
  Original Location: /account/logout.php
  Description: Logout account file.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The logout page for CommunitySite.">
	<title>Logging out...</title>

	<!-- Bootstrap core CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this page -->
	<link href="/assets/css/style.css" rel="stylesheet">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
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
if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

if (isset($_SESSION)) {
	// Unset all of the session variables
	$_SESSION = array();

	// Destroy the session.
	session_destroy();
}

$url_components = parse_url($_SERVER["REQUEST_URI"]);
if (isset($url_components['query'])) {
	parse_str($url_components['query'], $params);

	if (!isset($params['u'])) {
		$u = "/home.php";
	} else {
		$u = $params['u'];
		if ($u == "/") {
			$u = "/home.php";
		}
	}
}

// Redirect user to welcome page
if (isset($params['u'])) {
	header("Location: /login.php?u=" . $params['u']);
} else {
	header("location: /login.php?u=/home.php");
}

exit;
?>