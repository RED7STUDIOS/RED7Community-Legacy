<?php 
/*
  File Name: index.php
  Original Location: /purchase/index.php
  Description: Payment purchasing form.
  Author: Mitchell (BlxckSky_959)
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

if ($_GET['pri'] == "699")
{
	$pri = "6.99";
}
else if ($_GET['pri'] == "1399")
{
	$pri = "13.99";
}
else if ($_GET['pri'] == "2899")
{
	$pri = "28.99";
}
else if ($_GET['pri'] == "7199")
{
	$pri = "71.99";
}
else if ($_GET['pri'] == "14499")
{
	$pri = "144.99";
}
else if ($_GET['pri'] == "1099")
{
	$pri = "10.99";
}
else if ($_GET['pri'] == "2899")
{
	$pri = "28.99";
}
else if ($_GET['pri'] == "3899")
{
	$pri = "38.99";
}
else if ($_GET['pri'] == "1799")
{
	$pri = "17.99";
}

if ($_GET['nam'] == "400")
{
	$nam = "B$400";
}
else if ($_GET['nam'] == "800")
{
	$nam = "B$800";
}
else if ($_GET['nam'] == "1700")
{
	$nam = "B$1700";
}
else if ($_GET['nam'] == "4500")
{
	$nam = "B$4500";
}
else if ($_GET['nam'] == "10000")
{
	$nam = "B$10000";
}
else if ($_GET['nam'] == "Premium450")
{
	$nam = "Premium B$450";
}
else if ($_GET['nam'] == "Premium1000")
{
	$nam = "Premium B$1000";
}
else if ($_GET['nam'] == "Premium2200")
{
	$nam = "Premium B$2200";
}
else if ($_GET['nam'] == "PremiumDaily450")
{
	$nam = "Premium Daily B$450";
}
else if ($_GET['nam'] == "PremiumDaily1000")
{
	$nam = "Premium Daily B$1000";
}
else if ($_GET['nam'] == "PremiumDaily2200")
{
	$nam = "Premium Daily B$2200";
}
?>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Make Purchase - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/style.css">

		<script src="/assets/js/fontawesome.js"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
		<script type="text/javascript" src="payment.js"></script>
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/purchase/navbar.php" ?>

				<?php
				if (isset($maintenanceMode))
				{
					if ($maintenanceMode == "on")
					{
						echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
					}
				}
				?>

				<main class="col-md-9">
					<small>(this is using test data, don't enter real credentials)</small>
					<p><b>You are logged in as:</b> <?php echo $_SESSION["username"]; ?></p>
					<h2>You are purchasing <?php echo $nam; ?></h2>	
					<p><b>Paying: </b>$<?php echo $pri; ?> AUD</p>
					<div class="col-xs-12 col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								<form action="process.php?nam=<?php echo $_GET['nam']; ?>&num=<?php echo $_GET['num']; ?>&pri=<?php echo $_GET['pri']; ?>&oid=<?php echo $_GET['oid']; ?>" method="POST" id="paymentForm">				
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" name="custName" class="form-control">
									</div>
									<div class="form-group">
										<label for="email">Email</label>
										<input type="email" name="custEmail" class="form-control">
									</div>
									<div class="form-group">
										<label>Card Number</label>
										<input type="text" name="cardNumber" size="20" autocomplete="off" id="cardNumber" class="form-control" />
									</div>	
									<div class="row">
									<div class="col-xs-4">
									<div class="form-group">
										<label>CVC</label>
										<input type="text" name="cardCVC" size="4" autocomplete="off" id="cardCVC" class="form-control" />
									</div>	
									</div>	
									</div>
									<div class="row">
									<div class="col-xs-10">
									<div class="form-group">
										<label>Expiration (MM/YYYY)</label>
										<div class="col-xs-6">
											<input type="text" name="cardExpMonth" placeholder="MM" size="2" id="cardExpMonth" class="form-control" /> 
										</div>
										<div class="col-xs-6">
											<input type="text" name="cardExpYear" placeholder="YYYY" size="4" id="cardExpYear" class="form-control" />
										</div>
									</div>	
									</div>
									</div>
									<div class="form-group">
										<label for="name">Username to Gift (leave blank to buy for yourself)</label>
										<input type="text" name="giftUser" class="form-control">
									</div>
									<br>	
									<div class="form-group">
										<input type="submit" id="makePayment" class="btn btn-success" value="Make Payment">
									</div>
									<span class="paymentErrors"></span>	
									<small>*no card details are stored | the only data stored is name and email. we use a third party service called Stripe.</small>	
								</form>	
							</div>
						</div>
					</div>
					<h4>Test Credit Cards:</h4>
					<h6>VISA:</h6>
					<p>4242424242424242 | ANY CVC | ANY FUTURE DATE</p>
					<a class="btn btn-primary" href="https://stripe.com/docs/testing#cards">Click Here for More</a>
				</main>
			</div>
		</div>
	</body>
</html>