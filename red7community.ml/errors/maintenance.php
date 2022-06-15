<?php
/*
  File Name: maintenance.php
  Original Location: /errors/maintenance.php
  Description: The details for maintenance.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if ($maintenanceMode == "off") {
	header("location: /index.php");
}
?>

<html>

<head>
	<title>Under Maintenance</title>

	<!-- Particle.js -->
	<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

	<!-- Styles and Font Awesome. -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/space.css">
	<script src="/assets/js/fontawesome.js"></script>
	<script src="/assets/js/site.js"></script>
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

					<a class="btn btn-primary" href="#R">R</a>
					<a class="btn btn-primary" href="#RE">E</a>
					<a class="btn btn-primary" href="#RED">D</a>
					<a class="btn btn-primary" href="#RED7">7</a>
					<a class="btn btn-primary" href="#RED7C">C</a>
					<a class="btn btn-primary" href="#RED7CO">O</a>
					<a class="btn btn-primary" href="#RED7COM">M</a>
					<a class="btn btn-primary" href="#RED7COMM">M</a>
					<a class="btn btn-primary" href="#RED7COMMU">U</a>
					<a class="btn btn-primary" href="#RED7COMMUN">N</a>
					<a class="btn btn-primary" href="#RED7COMMUNI">I</a>
					<a class="btn btn-primary" href="#RED7COMMUNIT">T</a>
					<a class="btn btn-primary" href="#RED7COMMUNITY">Y</a>
				</div>
		</div>
		</main>
	</div>

	<!-- Scripts required for Bootstrap 5 -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="/assets/js/space.js"></script>
	<!-------------------------------------->
</body>

</html>