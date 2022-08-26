<?php
/*
  File Name: maintenance.php
  Original Location: /errors/maintenance.php
  Description: The details for maintenance.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
if (!isset($_SESSION)) {
    session_start();
}

$role = 0;

if (isset($_SESSION['id'])) {
	$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . htmlspecialchars($_SESSION['id']));

	// Decode the json response.
	if (!str_contains($data, "This user doesn't exist or has been deleted")) {
		$json = json_decode($data, true);
	$role = $json[0]['data'][0]['role'];
	}
}

if ($maintenanceMode == "off" || $role >= 2) {
	header("location: /index.php");
}
?>

<html>

<head>
	<title>Under Maintenance - <?php echo htmlspecialchars($site_name); ?></title>

	<!-- Particle.js -->
	<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

	<!-- Styles and Font Awesome. -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/space.css">
	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
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
				<h2><a href="/login.php?maintenanceBypass"><?php echo htmlspecialchars($site_name); ?></a></h2>
					<div>
						<h3>We are making things awesome!</h3>
					</div>

					<p>We are currently down for maintenance, but when we come back a new feature will be likely to come!</p>
				</div>
		</div>
		</main>
	</div>

	<!-- Scripts required for Bootstrap 5 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script defer src="/assets/js/space.js"></script>
	<!-------------------------------------->
</body>

</html>