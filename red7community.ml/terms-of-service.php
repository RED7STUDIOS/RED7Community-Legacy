<?php
/*
  File Name: terms-of-service.php
  Original Location: /terms-of-service.php
  Description: The terms of service stuff.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
if (!isset($_SESSION)) {
	session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Terms of Service</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script src="/assets/js/fontawesome.js"></script>
	<script src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
	<div class="page-content-wrapper">
		<?php
		if (isset($your_isBanned)) {
			if ($your_isBanned == 1) {
				echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
			}
		}

		if (isset($maintenanceMode)) {
			if ($maintenanceMode == "on") {
				echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
			}
		}
		?>
		<main class="col-md-9">
			<?php echo $termsOfService; ?>
		</main>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>