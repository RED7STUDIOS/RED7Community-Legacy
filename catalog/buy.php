<?php
/*
  File Name: buy.php
  Original Location: /catalog/buy.php
  Description: Buy a item on the catalog.
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
header("location: ../login.php");
exit;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/style.css">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/sidebar.css">

		<script src="<?php echo $STORAGE_URL; ?>/assets/js/fontawesome.js"></script>
	</head>
	<body>
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>
		<div class="page-content-wrapper">
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
				<main class="col-md-9">
					<h2>Purchase Item</h2>
					<?php
						$data = file_get_contents($API_URL. '/catalog.php?key='. $API_KEY. '&api=getitembyid&id='. $_GET['id']);

						$json_a = json_decode($data, true);

						$name = $json_a[0]['data'][0]['name'];
						$displayname = $json_a[0]['data'][0]['displayname'];
						$price = $json_a[0]['data'][0]['price'];
						$owners = $json_a[0]['data'][0]['owners'];
						$membershipRequired = $json_a[0]['data'][0]['membershipRequired'];

						if ($your_currency >= $price)
						{
							$items_before = json_decode($your_items, true);
							$owners_before = json_decode($owners, true);

							array_push($items_before, intval($_GET['id']));
							array_push($owners_before, $your_id);

							$items_final = json_encode($items_before);
							$owners_final = json_encode($owners_before);

							$sql = "UPDATE users SET items = '". $items_final . "' WHERE id = '". $your_id . "'";

							if (mysqli_query($link, $sql)) {
							  echo "<p>You have now been assigned the item: <strong><i>". $displayname. "</i></strong></p>";
							} else {
							  echo "Error: " . $sql . "<br>" . mysqli_error($link);
							}

							$sql = "UPDATE users SET currency = '". ($your_currency - $price) . "' WHERE id = '". $your_id . "'";

							if (mysqli_query($link, $sql)) {
							  echo "<p>You have now been charged: <strong><i>". $price. " ". $currency_name. "</i></strong> for the item: <strong><i>". $displayname. "</i></strong></p>";
							} else {
							  echo "Error: " . $sql . "<br>" . mysqli_error($link);
							}

							$sql = "UPDATE catalog SET owners = '". $owners_final . "' WHERE id = '". $_GET['id'] . "'";

							if (mysqli_query($link, $sql)) {
							  echo "<p>You have now been assigned as an owner of the item: <strong><i>". $displayname. "</i></strong></p>";
							} else {
							  echo "Error: " . $sql . "<br>" . mysqli_error($link);
							}

							echo '<p>Your balance is: <strong><i>'. $your_currency . ' '. $currency_name . '</i></strong>&nbsp;<small>(may take a minute to update)</small></p>';

							mysqli_close($link);
						}
						else
						{
							echo '<p>You do not have enough money to buy this item.</p>';
						}
					?>
					<a href="item.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary">Go Back to the Item</a>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>