<?php
/*
  File Name: privacy.php
  Original Location: /privacy.php
  Description: The privacy policy stuff.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

require $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
if (!isset($_SESSION)) {
	session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Privacy Policy - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body onload="init();">
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
	<div class="page-content-wrapper">
		<script>
			var observe;
			if (window.attachEvent) {
				observe = function(element, event, handler) {
					element.attachEvent('on' + event, handler);
				};
			} else {
				observe = function(element, event, handler) {
					element.addEventListener(event, handler, false);
				};
			}

			function init() {
				var text = document.getElementById('text');

				function resize() {
					text.style.height = 'auto';
					text.style.height = text.scrollHeight + 'px';
				}
				/* 0-timeout to get the already changed text */
				function delayedResize() {
					window.setTimeout(resize, 0);
				}
				observe(text, 'change', resize);
				observe(text, 'cut', delayedResize);
				observe(text, 'paste', delayedResize);
				observe(text, 'drop', delayedResize);
				observe(text, 'keydown', delayedResize);

				text.focus();
				text.select();
				resize();
			}
		</script>

		
		<main class="col-md-9">
			<?php echo $privacyPolicy; ?>
		</main>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>