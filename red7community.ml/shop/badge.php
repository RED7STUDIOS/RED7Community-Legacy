<?php
/*
  File Name: badge.php
  Original Location: /shop/badge.php
  Description: The details for a badge.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

session_start();

$data = file_get_contents($API_URL . '/badge.php?api=getbyid&id=' . htmlspecialchars($_GET['id']));

// Decode the json response.
if (!str_contains($data, "This item doesn't exist or has been deleted")) {
	$json = json_decode($data, true);

	$id = htmlspecialchars($_GET['id']);
	$name = $json[0]['data'][0]['displayname'];

	$description = $json[0]['data'][0]['description'];

	if ($description === "") {
		$description = "This items item does not have a description.";
	}
	$icon = $json[0]['data'][0]['icon'];
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
	<div class="page-content-wrapper">		<main class="col-md-9">
			<div class="d-flex align-items-center border-bottom">
				<?php
				if ($name === "Not Found") {
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

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>