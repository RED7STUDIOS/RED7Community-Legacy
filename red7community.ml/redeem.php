<?php
/*
	  File Name: home.php
	  Original Location: /home.php
	  Description: The main home page.
	  Author: Mitchell (Creaous)
	  Copyright (C) RED7 STUDIOS 2022
	*/

require $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Redeem - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>

	<div class="page-content-wrapper">
		<script type="text/javascript">
			var ajaxSubmit = function(formEl) {
				// fetch the data for the form
				var data = $(formEl).serializeArray();
				var url = $(formEl).attr('action');

				// setup the ajax request
				$.ajax({
					type: 'POST',
					url: url,
					data: data,
					dataType: 'json',
					error: function(d) {
						console.log(d.success);
						if (d.success) {
							alert('Redeemed code successfully!');
							document.location = document.location;
						} else {
							alert("An error occurred while redeeming or the code is invalid, please try again later.")
							document.location = document.location;
						}
					},
					success: function(d) {
						console.log(d.success);
						if (d.success) {
							alert('Redeemed code successfully!');
							document.location = document.location;
						} else {
							alert("An error occurred while redeeming or the code is invalid, please try again later.")
							document.location = document.location;
						}
					}
				});

				// return false so the form does not actually
				// submit to the page
				return false;
			}
		</script>

		<div class="center redeem-form">
			<legend>Redeem Code:</legend>
			<form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
				<input maxlength="6969" type="text" name="value" style="width: 100%;" />
				<input hidden type="text" name="action" value="redeemCode" />
				<button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="far fa-clipboard-check"></i> Redeem Code</button>
			</form>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>