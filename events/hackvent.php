<?php
/*
  File Name: hackvent.php
  Original Location: /events/hackvent.php
  Description: The main hackvent event page.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if(!isset($_SESSION)){
	// Initialize the session
	session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>THE HACKVENT - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/style.css">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/events/assets/css/style.css">

		<script src="<?php echo $STORAGE_URL; ?>/assets/js/fontawesome.js"></script>
	</head>
	<body style="background-color: #000;">
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>
		<div class="page-content-wrapper">

				<main class="text-center title-matrix-lr">
					<h1>THE FIRST HACKVENT</h1>
					<h3>Welcome Challenger!</h3>
					<h4 class="heading-normal">Your mission is to attempt to crack the security of the <a href="/users/profile.php?id=6">O_O</a> account. Parts of the password are hidden around the website, you must find all of them and decrypt them.</h4>
					<h4 class="heading-normal">The account contains exclusive items, that will never be available on the catalog.</h4>
					<small>*these items can be transferred to your account, please put your account in the description of the O_O account.</small>

					<h1 style="margin-top: 40px;">ITEMS:</h1>
				</main>
				<div class="row row-cols-1 row-cols-md-3 justify-content-center">
					<div class="col" style="height:180px; width:180px;">
						<a href="/catalog/item.php?id=" style="text-decoration: none;">
							<div class="align-items-center card text-center"><img class="card-img-top" src="" style="height:90px;width:90px;margin-top:15px">
								<div class="card-body">
									<h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">Test</h6>
									<p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">Test Again</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>