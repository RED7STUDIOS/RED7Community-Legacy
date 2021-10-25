<?php
/*
  File Name: profile.php
  Original Location: /users/profile.php
  Description: The profile for a user.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if(!isset($_SESSION)){
	// Initialize the session
	session_start();
}

$data = file_get_contents($API_URL. '/game.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $_GET['id']);

// Decode the json response.
if (!str_contains($data, "This game doesn't exist or has been deleted"))
{
	$json_a = json_decode($data, true);

	$id = $_GET['id'];
	$name = filterwords($json_a[0]['data'][0]['name']);
	$displayname = filterwords($json_a[0]['data'][0]['displayname']);
	$description = filterwords($json_a[0]['data'][0]['description']);

	if ($description == "") {
		$description = "This user has not set a description.";
	}

	$created_at = $json_a[0]['data'][0]['created_at'];
	$isBanned = $json_a[0]['data'][0]['isBanned'];
	$banReason = $json_a[0]['data'][0]['bannedReason'];
	$banDate = $json_a[0]['data'][0]['bannedDate'];
	$icon = $json_a[0]['data'][0]['icon'];
	$creator = $json_a[0]['data'][0]['ownerid'];

	$data_u = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $creator);

	$json_a = json_decode($data_u, true);

	$creator_name = $json_a[0]['data'][0]['username'];
}
else
{
	$name = "Not Found";
}

if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="The profile page for <?php echo $name ?>.">
		<title><?php echo $name ?> - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/sidebar.css">

		<script src="/assets/js/fontawesome.js"></script>

		<script src="/assets/js/relation.js"></script>

	</head>
	<body onload="init();">
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>
		<div class="page-content-wrapper">

				<script>
					
					var observe;
					if (window.attachEvent) {
						observe = function (element, event, handler) {
							element.attachEvent('on'+event, handler);
						};
					}
					else {
						observe = function (element, event, handler) {
							element.addEventListener(event, handler, false);
						};
					}

					function init () {
						var text = document.getElementById('text');
						function resize () {
							text.style.height = 'auto';
							text.style.height = text.scrollHeight+'px';
						}
						/* 0-timeout to get the already changed text */
						function delayedResize () {
							window.setTimeout(resize, 0);
						}
						observe(text, 'change',  resize);
						observe(text, 'cut',     delayedResize);
						observe(text, 'paste',   delayedResize);
						observe(text, 'drop',    delayedResize);
						observe(text, 'keydown', delayedResize);

						text.focus();
						text.select();
						resize();
					}

				</script>

				<main class="col-md-9">
					<div class="d-flex align-items-center border-bottom">
						<?php
							if ($name == "Not Found")
							{
								echo "<h2>This game could not be found!</h2></div><p>This game could possibly not be found due to a bug/glitch or has been removed (not banned).";
								exit;
							}
						?>
						<img src="<?php echo $icon ?>" style="height: 128px; width: 128px;"></img>
						&nbsp;
						<div class="wrapper">
							<h2><?php echo $displayname ?></h2>
							<span>
								<h6>By <a href="/users/profile.php?id=<?php echo $creator; ?>">@<?php echo $creator_name; ?></a></h6>
							</span>
						</div>
					</div>
					<div>
						<?php
						if ($isBanned == 1) {
							if ($banDate == "" && $banReason == "") {
								echo '<h3>Ban Information:</h3><p>This game was banned on: <strong>Unknown</strong> with the following reason: <strong>Unknown</strong></p><hr/>';
							}
							else if ($banDate != "") {
								if ($banReason != "") {
									echo '<h3>Ban Information:</h3><p>This game was banned on: <strong>'. $banDate. '</strong> with the following reason: <strong>'. $banReason. '</strong></p><hr/>';
								}
								else
								{
									echo '<h3>Ban Information:</h3><p>This game was banned on: <strong>'. $banDate. '</strong> with the following reason: <strong>Unknown</strong></p><hr/>';
								}
							}
							else
							{
								echo '<h3>Ban Information:</h3><p>This game was banned on: <strong>Unknown</strong> with the following reason: <strong>'. $banReason . '</strong></p><hr/>';
							}
						}
						?>

						<h3>About:</h3>
						<textarea style="width: 100%; border: 0 none white; overflow: hidden; padding: 0; outline: none; background-color: #D0D0D0;" id="text" disabled><?php echo htmlspecialchars($description) ?></textarea>

						<a class="btn btn-primary<?php if($isBanned == 1) { echo ' disabled'; } ?>" href="/games/play.php?id=<?php echo $_GET['id']; ?>" <?php if($isBanned == 1) { echo 'disabled'; } ?>>Play</a>
						<hr/>
					</div>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>