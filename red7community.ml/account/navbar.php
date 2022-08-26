<?php
/*
	  File Name: navbar.php
	  Original Location: /account/navbar.php
	  Description: Navbar file in general.
	  Author: Mitchell (BlxckSky_959)
	  Copyright (C) RED7 STUDIOS 2022
	*/

$selected_page = $_SERVER['REQUEST_URI'];
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
					<a class="nav-link" aria-current="page" href="/catalog"><i class="fa-solid fa-shop"></i> Catalog</a>
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
					// Check if the user is logged in, if not then redirect him to login page
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
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
} else {
	if (!str_contains($selected_page, "/events")) {
		include_once "navbar-logged-in.php";
	}
}
?>

<?php
$role = 0;

if (isset($_SESSION['id'])) {
	$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . htmlspecialchars($_SESSION['id']));

	// Decode the json response.
	if (!str_contains($data, "This user doesn't exist or has been deleted")) {
		$json = json_decode($data, true);
	$role = $json[0]['data'][0]['role'];
	}
}

if ($_SERVER["REQUEST_URI"] != "/errors/banned.php") {
            if (isset($maintenanceMode)) {
                if ($maintenanceMode == "on") {
					
                    if (!$role >= 2)
                    {
                        echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
                    }
                }
            }

}
else if ($_SERVER["REQUEST_URI"] == "/errors/banned.php")
{
	if (isset($your_isBanned)) {
		if ($your_isBanned != 1) {
			echo "<script type='text/javascript'>location.href = '/';</script>";
		}
	}
}
?>