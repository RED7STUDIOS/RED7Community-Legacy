<?php
/*
  File Name: actions.php
  Original Location: /users/actions.php
  Description: The following and unfollowing of a user.
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
		<title>User Actions - <?php echo $site_name; ?></title>
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
					<h2>Follow User</h2>
					<?php
						if ($your_following == null) {
							$sql = "UPDATE users SET following = '[]' WHERE id = '". $your_id . "'";

							if (mysqli_query($link, $sql)) {
							}
						}

						$data = file_get_contents($API_URL. '/user.php?key='. $API_KEY. '&api=getbyid&id='. $_GET['id']);

						$json_a = json_decode($data, true);

						$recipient_name = $json_a[0]['data'][0]['username'];
						$recipient_displayname = $json_a[0]['data'][0]['displayname'];
						$recipient_followers = $json_a[0]['data'][0]['followers'];

						if ($recipient_followers == null) {
							$sql = "UPDATE users SET followers = '[]' WHERE id = '". $_GET['id'] . "'";

							if (mysqli_query($link, $sql)) {
							}
						}

						if ($_GET['action'] == "follow") {
							$data = file_get_contents($API_URL. '/user.php?key='. $API_KEY. '&api=getbyid&id='. $_GET['id']);

							$json_a = json_decode($data, true);

							$recipient_name = $json_a[0]['data'][0]['username'];
							$recipient_displayname = $json_a[0]['data'][0]['displayname'];
							$recipient_followers = $json_a[0]['data'][0]['followers'];

							$following_before = json_decode($your_following, true);
							$followers_before = json_decode($recipient_followers, true);

							if (!in_array($_GET['id'], $following_before))
							{
								array_push($following_before, $_GET['id']);
								array_push($followers_before, $your_id);

								$following_final = json_encode($following_before);
								$followers_final = json_encode($followers_before);

								$sql = "UPDATE users SET following = '". $following_final . "' WHERE id = '". $your_id . "'";

								if (mysqli_query($link, $sql)) {
								  echo "<p>You are now following <strong>". $recipient_name. "</strong>!</p>";
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}

								$sql = "UPDATE users SET followers = '". $followers_final . "' WHERE id = '". $_GET['id'] . "'";

								if (mysqli_query($link, $sql)) {
								  echo "<p>Success!</p>";
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}
							}
						}
						else if ($_GET['action'] == "unfollow") {
							$data = file_get_contents($API_URL. '/user.php?key='. $API_KEY. '&api=getbyid&id='. $_GET['id']);

							$json_a = json_decode($data, true);

							$recipient_name = $json_a[0]['data'][0]['username'];
							$recipient_displayname = $json_a[0]['data'][0]['displayname'];
							$recipient_followers = $json_a[0]['data'][0]['followers'];

							$following_before = json_decode($your_following, true);
							$followers_before = json_decode($recipient_followers, true);

							if (in_array($_GET['id'], $following_before))
							{
								unset($following_before[array_search($_GET['id'], $following_before)]);
								unset($followers_before[array_search($your_id, $followers_before)]);

								$following_final = json_encode($following_before);
								$followers_final = json_encode($followers_before);

								$sql = "UPDATE users SET following = '". $following_final . "' WHERE id = '". $your_id . "'";

								if (mysqli_query($link, $sql)) {
								  echo "<p>You are now not following <strong>". $recipient_name. "</strong>!</p>";
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}

								$sql = "UPDATE users SET followers = '". $followers_final . "' WHERE id = '". $_GET['id'] . "'";

								if (mysqli_query($link, $sql)) {
								  echo "<p>Success!</p>";
								} else {
								  echo "Error: " . $sql . "<br>" . mysqli_error($link);
								}
							}
							else
							{
								echo '<p>You are not following this user.</p>';
							}
						}						
					?>
					<a href="profile.php?id=<?php echo $_GET['id'] ?>" class="btn btn-primary">Go Back to the User</a>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>