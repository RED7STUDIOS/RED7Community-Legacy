<?php
/*
	File Name: currency.php
	Original Location: /currency.php
	Description: The main currency page.
	Author: Mitchell (Creaous)
	Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if(!isset($_SESSION)){
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("location: login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Currency - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/style.css">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/sidebar.css">

		<script src="<?php echo $STORAGE_URL; ?>/assets/js/fontawesome.js"></script>
	</head>
	<body>
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>

		<?php
		if (isset($your_isBanned))
		{
			if ($your_isBanned == 1)
			{
				echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
			}
		}
		
		if (isset($maintenanceMode))
		{
			if ($maintenanceMode == "on")
			{
				echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
			}
		}
		?>

		<div class="page-content-wrapper">
			<?php
				if ($your_membership == "Premium450")
				{
					$membership = "Premium B$450";
				}
				else if ($your_membership == "Premium1000")
				{
					$membership = "Premium B$1000";
				}
				else if ($your_membership == "Premium2200")
				{
					$membership = "Premium B$2200";
				}
				else if ($your_membership == "PremiumDaily450")
				{
					$membership = "Premium Daily B$450";
				}
				else if ($your_membership == "PremiumDaily1000")
				{
					$membership = "Premium Daily B$1000";
				}
				else if ($your_membership == "PremiumDaily2200")
				{
					$membership = "Premium Daily B$2200";
				}
				?>

				<p><b>Your <?php echo $currency_name; ?>:</b> <?php echo number_format_short($your_currency); ?> (<?php echo number_format_comma($your_currency); ?>)</p>

				<p><b>Your Membership:</b> <?php echo $membership; ?></p>

				<small>*Purchasing Currency and Membership are one-time, no need to pay monthly for your membership.</small>

				<div class="d-flex justify-content flex-wrap flex-md align-items-center border-bottom">
					<h2>Currency</h2>
				</div>
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">B$400</h5>
								<a href="/purchase/?nam=400&num=prod_JNruQutGDJcq4j&pri=699&oid=SKA987654321" class="btn btn-primary">Purchase for $6.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">B$800</h5>
								<a href="/purchase/?nam=800&num=prod_JNt5G8d6rvaVuq&pri=1399&oid=SKA987654321" class="btn btn-primary">Purchase for $13.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">B$1,700</h5>
								<a href="/purchase/?nam=1700&num=prod_JNt8h9cj8J3Pbj&pri=2899&oid=SKA987654321" class="btn btn-primary">Purchase for $28.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">B$4,500</h5>
								<a href="/purchase/?nam=4500&num=prod_JNt8Ji9bAjyNQ7&pri=7199&oid=SKA987654321" class="btn btn-primary">Purchase for $71.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">B$10,000</h5>
								<a href="/purchase/?nam=10000&num=prod_JNt9EUxOOVJQfX&pri=14499&oid=SKA987654321" class="btn btn-primary">Purchase for $144.99 AUD</a>
							</div>
						</div>
					</div>
				</div>

				<div class="d-flex align-items-center border-bottom">
					<h2>Membership</h2>
				</div>
				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Premium B$450</h5>
								<p class="card-text">Buy this package and receive B$450 every week.</p>
								<a href="/purchase/?nam=Premium450&num=prod_JNruQutGDJcq4j&pri=699&oid=SKA987654321" class="btn btn-primary">Purchase for $6.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Premium B$1000</h5>
								<p class="card-text">Buy this package and receive B$1000 every week.</p>
								<a href="/purchase/?nam=Premium1000&num=prod_JNruQutGDJcq4j&pri=1399&oid=SKA987654321" class="btn btn-primary">Purchase for $13.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Premium B$2200</h5>
								<p class="card-text">Buy this package and receive B$2200 every week.</p>
								<a href="/purchase/?nam=Premium2200&num=prod_JNruQutGDJcq4j&pri=2899&oid=SKA987654321" class="btn btn-primary">Purchase for $28.99 AUD</a>
							</div>
						</div>
					</div>
				</div>

				<br/>

				<div class="row">
					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Premium Daily B$450</h5>
								<p class="card-text">Buy this package and receive B$450 every day.</p>
								<a href="/purchase/?nam=PremiumDaily450&num=prod_JNruQutGDJcq4j&pri=1099&oid=SKA987654321" class="btn btn-primary">Purchase for $10.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Premium Daily B$1000</h5>
								<p class="card-text">Buy this package and receive B$1000 every day.</p>
								<a href="/purchase/?nam=PremiumDaily1000&num=prod_JNruQutGDJcq4j&pri=1799&oid=SKA987654321" class="btn btn-primary">Purchase for $17.99 AUD</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Premium Daily B$2200</h5>
								<p class="card-text">Buy this package and receive B$2200 every day.</p>
								<a href="/purchase/?nam=PremiumDaily2200&num=prod_JNruQutGDJcq4j&pri=3899&oid=SKA987654321" class="btn btn-primary">Purchase for $38.99 AUD</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>