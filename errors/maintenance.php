<?php
/*
  File Name: maintenance.php
  Original Location: /errors/maintenance.php
  Description: The details for maintenance.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if ($maintenanceMode == "off") {
	header ("location: /index.php");
}
?>

<html>
	<head>
		<title>Under Maintenance</title>

		<!-- Particle.js -->
		<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

		<!-- Styles and Font Awesome. -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/style.css">
		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/space.css">
		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/sidebar.css">
		<script src="<?php echo $STORAGE_URL; ?>/assets/js/fontawesome.js"></script>
		<!------------------------------>
	</head>
	<body>
		<!-- New container fluid -->
		<div class="container-fluid">
			<!-- New row -->
			<div class="row">
				<!-- Particles.js and main content -->
				<main class="col-md-9" id="particles-js">
					<!-- Center everything in this DIV-->
					<div class="center text-center align-items-center text-white">
						<div>
							<h1>We are making things awesome!</h1>
						</div>

						<p>We are currently down for maintenance, but when we come back a new feature will be likely to come!</p>
					</div>
				</div>
			</main>
		</div>

		<!-- Scripts required for Bootstrap 5 -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
		<script src="<?php echo $STORAGE_URL; ?>/assets/js/space.js"></script>
		<!-------------------------------------->
	</body>
</html>