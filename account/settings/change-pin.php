<?php
/*
  File Name: change-pin.php
  Original Location: /account/settings/change-pin.php
  Description: Changing PIN file.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: /login.php");
	exit;
}
 
// Include config file
include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
$pin = "";
$pin_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

	if(empty(trim($_POST["pin"]))){
		$pin_err = "Please enter the new PIN.";     
	} elseif(strlen(trim($_POST["pin"])) < 4){
		$pin_err = "PIN must have 4 characters and only numbers.";
	} else{
		$pin = trim($_POST["pin"]);
	}
 
	// Validate new password
	if(empty(trim($_POST["new_password"]))){
		$new_password_err = "Please enter the new PIN.";     
	} elseif(strlen(trim($_POST["new_password"])) < 4){
		$new_password_err = "PIN must have 4 characters and only numbers.";
	} else{
		$new_password = trim($_POST["new_password"]);
	}
	
	// Validate confirm password
	if(empty(trim($_POST["confirm_password"]))){
		$confirm_password_err = "Please confirm the PIN.";
	} else{
		$confirm_password = trim($_POST["confirm_password"]);
		if(empty($new_password_err) && ($new_password != $confirm_password)){
			$confirm_password_err = "PIN did not match.";
		}
	}

	// Check input errors before updating the database
	if(empty($pin_err) && empty($new_password_err) && empty($confirm_password_err)){
		// Prepare an update statement
		$sql = "UPDATE users SET pin = ? WHERE id = ?";
		
		if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
			
			// Set parameters
			$param_password = password_hash($new_password, PASSWORD_DEFAULT);
			$param_id = $_SESSION["id"];
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				header($new_password_err = $confirm_password_err = "";);
				exit();
			} else{
				echo "Oops! Something went wrong. Please try again later. ". mysqli_error($link);
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
		<title>Change PIN - Account Settings</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/style.css">

		<link rel="stylesheet" href="<?php echo $STORAGE_URL; ?>/assets/css/sidebar.css">

		<script src="<?php echo $STORAGE_URL; ?>/assets/js/fontawesome.js"></script>
	</head>
</html>

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
				<main class="col-lg-10">
					<h2>Change PIN</h2>
					<p>Please fill out this form to change your PIN.</p>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
						<div class="form-group <?php echo (!empty($pin_err)) ? 'has-error' : ''; ?>">
							<label>Old PIN</label>
							<input type="number" name="pin" class="form-control" maxlength="4">
							<span class="help-block"><?php echo $pin_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
							<label>New PIN</label>
							<input type="number" name="new_password" class="form-control" maxlength="4" value="<?php echo $new_password; ?>">
							<span class="help-block"><?php echo $new_password_err; ?></span>
						</div>
						<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
							<label>Confirm PIN</label>
							<input type="number" name="confirm_password" class="form-control" maxlength="4">
							<span class="help-block"><?php echo $confirm_password_err; ?></span>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-primary" value="Submit">
							<a class="btn btn-link" href="/account/settings">Cancel</a>
						</div>
					</form>
				</main>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>