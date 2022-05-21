<?php
/*
  File Name: equip-item.php
  Original Location: /equip-item.php
  Description: Do stuff with the avatar editor.
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
header("location: ../login.php?u=". $_SERVER["REQUEST_URI"]);
exit;
}

$data_main = file_get_contents($API_URL. '/avatar.php?api=getbyid&id='. $_SESSION['id']);

$json_a_main = json_decode($data_main, true);

$items = $json_a_main[0]['data'][0]['items'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home - <?php echo htmlspecialchars($site_name); ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/style.css">

		<script src="/assets/js/fontawesome.js"></script>
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
					<h2>Avatar Editor Action</h2>
					<?php
						
						$data = file_get_contents($API_URL. '/catalog.php?api=getitembyid&id='. $_GET['id']);

						$json_a = json_decode($data, true);

						$id = $json_a[0]['data'][0]['id'];

						$items_before = json_decode($items, true);

						if ($_GET['api'] == "equip")
						{
							if (!in_array($_GET['id'], $items_before))
							{
								if (in_array($_GET['id'], json_decode($your_items, true)))
								{
									array_push($items_before, intval($_GET['id']));
									$items_final = json_encode($items_before);

									$sql = "UPDATE avatars SET items = '". $items_final . "' WHERE ownerid = '". $your_id . "'";

									if (mysqli_query($link, $sql)) {
									  
									} else {
									  echo "Error: " . $sql . "<br>" . mysqli_error($link);
									}

									mysqli_close($link);

									echo '<p>Equipped item! Going back to avatar editor.</p>';
								}
								else
								{
									echo '<p>You dont own this item.</p>';
								}
							}
							else
							{
								echo '<p>You are already wearing this item.</p>';
							}
						}
						else if ($_GET['api'] == "unequip")
						{
							if (in_array($_GET['id'], $items_before))
							{
								unset($items_before[array_search($_GET['id'], $items_before)]);
								$items_final = json_encode($items_before);

								$sql = "UPDATE avatars SET items = '". $items_final . "' WHERE ownerid = '". $your_id . "'";

								if (mysqli_query($link, $sql)) {
								  
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}

								mysqli_close($link);

								echo '<p>Unequipped item! Going back to avatar editor.</p>';
							}
							else
							{
								echo '<p>You are not wearing this item.</p>';
							}
						}
						else if ($_GET['api'] == "changeshirt")
						{
							if (in_array($_GET['id'], json_decode($your_items, true)))
							{
								$sql = "UPDATE avatars SET shirt = '". $_GET['id'] . "' WHERE ownerid = '". $your_id . "'";

								if (mysqli_query($link, $sql)) {
								  
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}
							}
						}
						else if ($_GET['api'] == "changepants")
						{
							if (in_array($_GET['id'], json_decode($your_items, true)))
							{
								$sql = "UPDATE avatars SET pants = '". $_GET['id'] . "' WHERE ownerid = '". $your_id . "'";

								if (mysqli_query($link, $sql)) {
								  
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}
							}
						}
						else if ($_GET['api'] == "changeface")
						{
							if (in_array($_GET['id'], json_decode($your_items, true)))
							{
								$sql = "UPDATE avatars SET face = '". $_GET['id'] . "' WHERE ownerid = '". $your_id . "'";

								if (mysqli_query($link, $sql)) {
								  
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}
							}
						}
					?>

					<script>
						location.href = '/avatar-editor.php';
					</script>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>