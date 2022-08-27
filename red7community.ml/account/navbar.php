<?php
/*
	  File Name: navbar.php
	  Original Location: /account/navbar.php
	  Description: Navbar file in general.
	  Author: Mitchell (Creaous)
	  Copyright (C) RED7 STUDIOS 2022
	*/

$selected_page = $_SERVER['REQUEST_URI'];
?>

<?php
if ($maintenanceMode === "on")
{
	echo '<div class="alert alert-warning text-center" role="alert">The site is currently in maintenance, you are viewing the site as an admin.</div>';
}
?>

<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/alert.php"; ?>

<nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="/index.php"><?php echo htmlspecialchars($site_name); ?></a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav me-auto mb-2 mb-md-0">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="/"><i class="fa-solid fa-house"></i> Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="/shop"><i class="fa-solid fa-shop"></i> Shop</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="/currency.php"><i class="fa-solid fa-wallet"></i> <?php echo $currency_name ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="/users/search.php"><i class="fa-solid fa-users"></i> Users</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="/clans/search.php"><i class="fa-solid fa-people-group"></i> Clans</a>
				</li>
			</ul>
			<form class="d-flex">
				<ul class="navbar-nav">
					<?php
					// Check if the user is logged in, if not then redirect them to login page
					if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
						echo '<div class="btn-group" role="group"><li class=nav-item><a aria-current=page class="btn btn-primary"href=/login.php?u=/home.php>Login</a><li class=nav-item>&nbsp;<a aria-current=page class="btn btn-primary"href=/register.php>Register</a></div>';
					} else {
						include_once "navbar-logged-in.php";
					}
					?>
				</ul>
			</form>
		</div>
	</div>
</nav>

<?php
// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
} else {
	include_once "navbar-logged-in.php";
}
?>

<?php
$__role = 0;

if (isset($_SESSION['id'])) {
	$__role = $getRole($_SESSION['id']);
}
else
{
	$__role = 0;
}

if (isset($maintenanceMode)) {
	if ($maintenanceMode === "on") {
		
		if (!$__role >= 2)
		{
			echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
		}
	}
}
?>