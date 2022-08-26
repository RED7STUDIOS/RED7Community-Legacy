<?php
/*
  File Name: banned.php
  Original Location: /errors/banned.php
  Description: The details for a user's ban.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: ../login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Banned - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>

	<div class="page-content-wrapper">
		<main class="col-md-9">
			<div class="d-flex align-items-center border-bottom">
				<h2>You have been banned!</h2>
			</div>

			<p><b>You were banned on:</b> <?php echo $your_banDate ?></p>
			<p><b>Reason:</b> <?php echo $your_banReason ?></p>

			<p>If you wish to appeal, please email us at <b><a href="mailto:<?php echo $appealEmail ?>"><?php echo $appealEmail ?></a></b>.</p>
	</div>
	</main>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>