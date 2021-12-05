<?php
/*
  File Name: item.php
  Original Location: /catalog/item.php
  Description: The details for a item.
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
header("location: ../login.php");
exit;
}

$data = file_get_contents($API_URL. '/game.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $_GET['id']);

// Decode the json response.
if (!str_contains($data, "This game doesn't exist or has been deleted"))
{
	$json_a = json_decode($data, true);
	$js = $json_a[0]['data'][0]['js'];
}
else
{
	$js = "";
}
?>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Test Game - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/games/style.css">

		<script src="/assets/js/fontawesome.js"></script>
	</head>
	<body>
		<?php
			if ($js == "")
			{
				echo "<div><h2>This game could not be found!</h2><p>This game could possibly not be found due to a bug/glitch or has been removed (not banned).</div></div>";
				exit;
			}
		?>

		<div id="game"><canvas width="1366" height="100"></canvas></div>

		<script src="/assets/js/games/libs/detector.js"></script>
		<script src="/assets/js/games/libs/three.js"></script>
		<script src="/assets/js/games/libs/cannon.js"></script>

		<script src="/assets/js/games/game/game.static.js"></script>
		<script src="/assets/js/games/game/game.three.js"></script>
		<script src="/assets/js/games/game/game.cannon.js"></script>
		<script src="/assets/js/games/game/game.events.js"></script>
		<script src="/assets/js/games/game/game.helpers.js"></script>
		<script src="/assets/js/games/game/game.ui.js"></script>

		<script>
			<?php echo $js; ?>
		</script>

		<script src="/assets/js/games/game/game.models.js"></script>

		<script>
			if (!Detector.webgl) {
				Detector.addGetWebGLMessage();
			} else {
				window.gameInstance = window.game.core();
				window.gameInstance.init({
					domContainer: document.querySelector("#game"),
					rendererClearColor: window.game.static.white
				});
			}
		</script>
	</body>
</html>