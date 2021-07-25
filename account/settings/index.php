<?php
/*
  File Name: index.php
  Original Location: /account/settings/index.php
  Description: The main settings file for everything.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

// Initialize the session
if(!isset($_SESSION)){
	session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("location: ../../login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Account Settings</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/style.css">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/sidebar.css">

		<script src="<?php echo $STORAGE_URL; ?>/assets/js/fontawesome.js"></script>

		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
					<div class="d-flex align-items-center border-bottom">
						<h2><?php echo htmlspecialchars($_SESSION["username"]); ?>'s Settings</h2>
					</div>

					<p>Display Name: <b><?php if ( $your_displayname == null || $your_displayname == "") { echo htmlspecialchars($your_username); } else { echo htmlspecialchars($your_displayname); } ?></b></p>
					<p>Account created at: <b><?php echo htmlspecialchars($your_created_at); ?></b></p>
					<p>Last login at: <b><?php echo htmlspecialchars($your_lastLogin); ?></b></p>

					<a href="/account/settings/change-password.php" class="btn btn-dark" role="button"><i class="fas fa-key"></i> Change Password</a>
					<a href="/account/settings/get-image-from-gravatar.php?icon=<?php echo get_gravatar($your_email, 180) ?>" class="btn btn-primary" role="button"><i class="fas fa-image"></i> Get Image From Gravatar</a>
					<a href="/account/logout.php" class="btn btn-danger" role="button"><i class="fas fa-sign-out-alt"></i> Logout</a>

					<hr/>

					<fieldset>
						<legend>Change Display Name:</legend>
						<input style="width: 500px;" id="changeDisplayNameText"></input>
						<a onclick="changeDisplayName();" class="btn btn-success" role="button"><i class="fas fa-tv"></i> Change Display Name</a>
					</fieldset>

					<br/>

					<fieldset>
						<legend>Change Description: <small>(only 1 line)</small></legend>
						<textarea id="changeDescriptionText" style="width: 100%; border: 0 none white; overflow: hidden; padding: 0; outline: none; background-color: #D0D0D0;"><?php $sql = "SELECT description FROM users WHERE id=". $_SESSION['id']; $result = mysqli_query($link, $sql); if (mysqli_num_rows($result) > 0) { while($row = mysqli_fetch_assoc($result)) { echo $row['description']; }}?>
						</textarea>
						<a onclick="changeDescription();" class="btn btn-success" role="button"><i class="fas fa-comment"></i> Change Description</a>
					</fieldset>
					
					<br/>

					<fieldset>
						<legend>Change Email:</legend>
						<input style="width: 500px;" id="changeEmailText"></input>
						<a onclick="changeEmail();" class="btn btn-success" role="button"><i class="fas fa-envelope"></i> Change Email</a>
					</fieldset>
				</main>
			</div>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

	<script>
		function changeDisplayName() {
			location.href = "/account/settings/change-displayname.php?displayname=" + document.getElementById("changeDisplayNameText").value;
		}

		function changeDescription() {
			location.href = "/account/settings/change-description.php?description=" + document.getElementById("changeDescriptionText").value;
		}

		function changeEmail() {
			location.href = "/account/settings/change-email.php?email=" + document.getElementById("changeEmailText").value;
		}
	</script>
	</body>
</html>