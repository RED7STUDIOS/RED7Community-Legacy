<?php
/*
  File Name: change-password.php
  Original Location: /account/settings/change-password.php
  Description: Changing Password file.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}

// Include config file
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";

// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Validate new password
	if (empty(trim($_POST["new_password"]))) {
		$new_password_err = "Please enter the new password.";
	} elseif (strlen(trim($_POST["new_password"])) < 4) {
		$new_password_err = "Password must have atleast 4 characters.";
	} else {
		$new_password = trim($_POST["new_password"]);
	}

	// Validate confirm password
	if (empty(trim($_POST["confirm_password"]))) {
		$confirm_password_err = "Please confirm the password.";
	} else {
		$confirm_password = trim($_POST["confirm_password"]);
		if (empty($new_password_err) && ($new_password != $confirm_password)) {
			$confirm_password_err = "Password did not match.";
		}
	}

	// Check input errors before updating the database
	if (empty($new_password_err) && empty($confirm_password_err)) {
		// Prepare an update statement
		$sql = "UPDATE users SET password = ? WHERE id = ?";

		if ($stmt = mysqli_prepare($link, $sql)) {
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);

			// Set parameters
			$param_password = password_hash($new_password, PASSWORD_DEFAULT);
			$param_id = $_SESSION["id"];

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				$token = md5($email) . rand(10, 9999);
				$expFormat = mktime(
					date("H"),
					date("i"),
					date("s"),
					date("m"),
					date("d") + 1,
					date("Y")
				);
				$expDate = date("Y-m-d H:i:s", $expFormat);
				$update = mysqli_query($link, "UPDATE users SET reset_link_token='" . $token . "', reset_link_exp='" . $expDate . "' WHERE email='" . $your_email . "'");
				$url = "http://" . $_SERVER["HTTP_HOST"] . "/reset-password.php?key=" . $your_email . "&token=" . $token;

				$sendEmail($param_id, $url, "changed-password");
				header("location: /account/settings");
				exit();
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}
	}

	// Close connection
	mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password - Account Settings</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script src="/assets/js/fontawesome.js"></script>
	<script src="/assets/js/site.js"></script>
</head>

</html>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
	<div class="page-content-wrapper">
		<?php
		if (isset($your_isBanned)) {
			if ($your_isBanned == 1) {
				echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
			}
		}

		if (isset($maintenanceMode)) {
			if ($maintenanceMode == "on") {
				echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
			}
		}

		?>
		<main class="col-lg-10">
			<h2>Change Password</h2>
			<p>Please fill out this form to change your password.</p>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
					<label>New Password</label>
					<input type="password" name="new_password" class="form-control" value="<?php echo $new_password; ?>">
					<span class="help-block"><?php echo $new_password_err; ?></span>
				</div>
				<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
					<label>Confirm Password</label>
					<input type="password" name="confirm_password" class="form-control">
					<span class="help-block"><?php echo $confirm_password_err; ?></span>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary" value="Submit" onclick="spin();"></button>
					<a class="btn btn-link" href="/account/settings">Cancel</a>
				</div>
			</form>
		</main>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
	</script>
</body>

</html>