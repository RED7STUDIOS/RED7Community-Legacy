<?php
// TODO: Make UI look alot nicer.

/*
  File Name: avatar-editor.php
  Original Location: /avatar-editor.php
  Description: The avatar editor.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}

$id = htmlspecialchars($_SESSION['id']);

$data_avatar = file_get_contents($API_URL . '/avatar.php?api=getbyid&id=' . $id);

$json_a_avatar = json_decode($data_avatar, true);

$hats = $json_a_avatar[0]['data'][0]['items'];
$shirt = $json_a_avatar[0]['data'][0]['shirt'];
$pants = $json_a_avatar[0]['data'][0]['pants'];
$face = $json_a_avatar[0]['data'][0]['face'];

if (isset($_GET["page"])) {
	$page = htmlspecialchars($_GET["page"]);
} else {
	$page = 1;
};
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The avatar editor.">
	<title>Avatar Editor - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">
	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
	<style>
		#c {
			width: 50%;
			height: 50%;
		}
	</style>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>

	<div class="page-content-wrapper">
		<h1>Avatar Editor</h1>

		<canvas id="c"></canvas>

		<div class="row row-cols-1 row-cols-md-3 g-4">
			<?php
			$total = 0;

			$datatable = "items"; // MySQL table name
			$results_per_page = 21; // number of results per page

			$start_from = ($page - 1) * $results_per_page;
			$sql = "SELECT id, displayname, type, icon FROM items WHERE isEquippable=1";
			$result = mysqli_query($link, $sql);

			while ($row = mysqli_fetch_assoc($result)) {

				$your_inventory = json_decode($your_items, true);

				if (in_array($row['id'], $your_inventory)) {
					$total = +1;

					if (strtolower($row['type']) != "shirt" && strtolower($row['type']) != "pants" && strtolower($row['type']) != "face") {
						$thingy = "";
						$thingy2 = "";

						if (!in_array($row['id'], json_decode($hats, true))) {
							$thingy = "";
							$thingy2 = "/equip-item.php?api=equip&id=" . $row['id'];
						} else {
							$thingy = " border-success";
							$thingy2 = "/equip-item.php?api=unequip&id=" . $row['id'];
						}

						echo '<div class="col" style="height:180px; width:180px"><a href="' . $thingy2 . '" style="text-decoration: none;"><div class="align-items-center card text-center' . $thingy . '"><img class="card-img-top" src="' . $row['icon'] . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['displayname'] . '</h6><p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['type'] . '</div></div></a></div>';
					} else {
						$total = +1;

						$thingy = "";
						$type = "1";

						if (strtolower($row['type']) === "shirt") {
							$type = $shirt;
						} else if (strtolower($row['type']) === "pants") {
							$type = $pants;
						} else if (strtolower($row['type']) === "face") {
							$type = $face;
						}

						if ($type != $row['id']) {
							$thingy = "";
						} else {
							$thingy = " border-success";
						}

						echo '<div class="col" style="height:180px; width:180px"><a href="/equip-item.php?api=change' . strtolower($row['type']) . '&id=' . $row['id'] . '" style="text-decoration: none;"><div class="align-items-center card text-center' . $thingy . '"><img class="card-img-top" src="' . $row['icon'] . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['displayname'] . '</h6><p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['type'] . '</div></div></a></div>';
					}
				}
			};
			?>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/js/avatar.js.php"; ?>
</body>

</html>