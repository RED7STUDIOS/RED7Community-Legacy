<?php
/*
  File Name: badge.php
  Original Location: /catalog/badge.php
  Description: The details for a badge.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

session_start();

$data = file_get_contents($API_URL . '/badge.php?api=getbyid&id=' . htmlspecialchars($_GET['id']));

// Decode the json response.
if (!str_contains($data, "This item doesn't exist or has been deleted")) {
	$json_a = json_decode($data, true);

	$id = htmlspecialchars($_GET['id']);
	$name = $json_a[0]['data'][0]['displayname'];

	$description = $json_a[0]['data'][0]['description'];

	if ($description == "") {
		$description = "This catalog item does not have a description.";
	}
	$icon = $json_a[0]['data'][0]['icon'];
} else {
	$name = "Not Found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo htmlspecialchars($name); ?> - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script src="/assets/js/fontawesome.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
	<div class="page-content-wrapper">
		<?php
		if (isset($maintenanceMode)) {
			if ($maintenanceMode == "on") {
				echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
			}
		}
		?>
		<main class="col-md-9">
			<div class="d-flex align-items-center border-bottom">
				<?php
				if ($name == "Not Found") {
					echo "<h2>This item could not be found!</h2></div><p>This item could possibly not be found due to a bug/glitch or has been removed.";
					exit;
				}
				?>
				<img src="<?php echo $icon ?>" style="height: 128px; width: 128px;"></img>
				&nbsp;
				<h2><?php echo htmlspecialchars($name); ?></h2>
			</div>
			<div>
				<h3>About:</h3>
				<p><?php echo htmlspecialchars($description); ?></p>
			</div>
	</div>
	</main>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>