<?php
/*
  File Name: login.php
  Original Location: /login.php
  Description: The main login form.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

// Include config file
include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";
include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

// Initialize the session
if(!isset($_SESSION)){
    session_start();
}
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: home.php");
	exit;
}

 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
	// Check if username is empty
	if(empty(trim($_POST["username"]))){
		$username_err = "Please enter username.";
	} else{
		$username = trim($_POST["username"]);
	}
	
	// Check if password is empty
	if(empty(trim($_POST["password"]))){
		$password_err = "Please enter your password.";
	} else{
		$password = trim($_POST["password"]);
	}
	
	// Validate credentials
	if(empty($username_err) && empty($password_err)){
		// Prepare a select statement
		$sql = "SELECT id, username, password, created_at, lastlogin, lastloginDate, membership, currency, badges, items, followers, following FROM users WHERE username = ?";
		
		if($stmt = mysqli_prepare($link, $sql)){
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "s", $param_username);
			
			// Set parameters
			$param_username = $username;
			
			// Attempt to execute the prepared statement
			if(mysqli_stmt_execute($stmt)){
				// Store result
				mysqli_stmt_store_result($stmt);
				
				// Check if username exists, if yes then verify password
				if(mysqli_stmt_num_rows($stmt) == 1){                    
					// Bind result variables
					mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $created_at, $lastlogin, $lastloginDate, $membershipTemp, $currencyTemp, $badges, $items, $followers, $following);
					if(mysqli_stmt_fetch($stmt)){
						if(password_verify($password, $hashed_password)){
							session_destroy();

							// Password is correct, so start a new session
							session_start();
							
							// Store data in session variables
							$_SESSION["loggedin"] = true;
							$_SESSION["id"] = $id;
							$_SESSION["username"] = $username;
							$_SESSION["created_at"] = $created_at;
							$_SESSION["lastlogin"] = $lastlogin;
							
							if ($badges == null || $badges == "") {
								$sql = "UPDATE users SET badges='[1]' WHERE id=". $id;
								mysqli_query($link, $sql);
							}

							if ($items == null || $items == "") {
								$sql = "UPDATE users SET items='[]' WHERE id=". $id;
								mysqli_query($link, $sql);
							}

							if ($followers == null || $followers == "") {
								$sql = "UPDATE users SET followers='[]' WHERE id=". $id;
								mysqli_query($link, $sql);
							}

							if ($following == null || $following == "") {
								$sql = "UPDATE users SET following='[]' WHERE id=". $id;
								mysqli_query($link, $sql);
							}

							if ($membershipTemp == null || $membershipTemp == "") {
								$sql = "UPDATE users SET membership='None' WHERE id=". $id;
								mysqli_query($link, $sql);
							}

							date_default_timezone_set('Australia/Adelaide');

							$todayDate = date("Y-m-d");

							$expire = date($lastloginDate);

							$today_dt = strtotime($todayDate);
							$expire_dt = strtotime($expire);

							if ($membershipTemp == "" || $membershipTemp == null) {
								$membershipTemp = "None";
							}

							if ($expire_dt < $today_dt)
							{
								if (str_contains($membershipTemp, "PremiumDaily2200"))
								{
									$sql = "UPDATE users SET currency='". ($currencyTemp + 2200) . "' WHERE id=". $id;

									mysqli_query($link, $sql);
								}
								else if (str_contains($membershipTemp, "PremiumDaily1000"))
								{
									$sql = "UPDATE users SET currency='". ($currencyTemp + 1000) . "' WHERE id=". $id;

									mysqli_query($link, $sql);
								}
								else if (str_contains($membershipTemp, "PremiumDaily450"))
								{
									$sql = "UPDATE users SET currency='". ($currencyTemp + 450) . "' WHERE id=". $id;

									mysqli_query($link, $sql);
								}
								else
								{
									$sql = "UPDATE users SET currency='". ($currencyTemp + 10) . "' WHERE id=". $id;

									mysqli_query($link, $sql);
								}
							}

							$today_dt2 = strtotime($todayDate. ' - 1 week');

							if ($today_dt2 >= $expire_dt)
							{
								if (str_contains($membershipTemp, "Premium2200"))
								{
									$sql = "UPDATE users SET currency='". ($currencyTemp + 2200) . "' WHERE id=". $id;

									mysqli_query($link, $sql);
								}
								else if (str_contains($membershipTemp, "Premium1000"))
								{
									$sql = "UPDATE users SET currency='". ($currencyTemp + 1000) . "' WHERE id=". $id;

									mysqli_query($link, $sql);
								}
								else if (str_contains($membershipTemp, "Premium450"))
								{
									$sql = "UPDATE users SET currency='". ($currencyTemp + 450) . "' WHERE id=". $id;

									mysqli_query($link, $sql);
								}
							}

							$todayTime = date("Y-m-d H:i:s");

							$sql = "UPDATE users SET lastloginDate='". $todayDate . "' WHERE id=". $id;

							mysqli_query($link, $sql);

							$sql = "UPDATE users SET lastlogin='". $todayTime . "' WHERE id=". $id;

							mysqli_query($link, $sql);

							// Redirect user to welcome page
							header("location: home.php");
						} else{
							// Display an error message if password is not valid
							$password_err = "The password you entered was not valid.";
						}
					}
				} else{
					// Display an error message if username doesn't exist
					$username_err = "No account found with that username.";
				}
			} else{
				echo "Oops! Something went wrong. Please try again later.";
			}

			// Close statement
			mysqli_stmt_close($stmt);
		}
	}
}
?>
 
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="The login page for <?php echo $site_name; ?>.">
		<title>Login - <?php echo $site_name; ?></title>

		<!-- Styles and Font Awesome -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-Items@main/assets/css/style.css" rel="stylesheet">		<script src="/assets/js/fontawesome.js"></script>
		<!----------------------------->
	</head>
	<body>
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>
		<div class="page-content-wrapper">

				<?php
				if (isset($maintenanceMode))
				{
					if ($maintenanceMode == "on")
					{
						echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
					}
				}
				?>

				<main class="form-signin">
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<h3 class="fw-normal">Login to <?php echo $site_name; ?></h3>

						<div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
							<label><i class="fas fa-user"></i> Username</label>
							<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
							<span class="help-block"><?php echo $username_err; ?></span>
						</div>  

						<div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
							<label><i class="fas fa-key"></i> Password</label>
							<input type="password" name="password" class="form-control">
							<span class="help-block"><?php echo $password_err; ?></span>
						</div>

						<button class="w-100 btn btn-lg btn-primary" type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>

						<p>Don't have an account? <a href="register.php">Register here</a>.</p>

						<p class="mt-5 mb-3 text-muted">&copy; <?php echo $site_name. " ". date("Y") ?></p>
					</form>
				</main>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>