<?php
/*
  File Name: register.php
  Original Location: /register.php
  Description: The main register form.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

// Include config file
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
require $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
if (!isset($_SESSION)) {
	session_start();
}

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// Validate username
	if (empty(trim($_POST["username"]))) {
		$username_err = "Please enter a username.";
	} else {
		if (!preg_match("/([%\$#\*]+)/", $_POST["username"])) {
			// Prepare a select statement
			$sql = "SELECT id FROM users WHERE username = ?";

			if ($stmt = mysqli_prepare($link, $sql)) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				// Set parameters
				$param_username = trim($_POST["username"]);

				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt)) {
					/* store result */
					mysqli_stmt_store_result($stmt);

					if (mysqli_stmt_num_rows($stmt) === 1) {
						$username_err = "This username is already taken.";
					} else {
						$username = trim($_POST["username"]);
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			} else {
				$username_err = "You are not allowed to use ~`!@#$%^&*()-+=[]{}\|;:',./?";
			}
		}
	}

	// Validate password
	if (empty(trim($_POST["password"]))) {
		$password_err = "Please enter a password.";
	} elseif (strlen(trim($_POST["password"])) < 4) {
		$password_err = "Password must have atleast 4 characters.";
	} else {
		$password = trim($_POST["password"]);
	}

	// Validate confirm password
	if (empty(trim($_POST["confirm_password"]))) {
		$confirm_password_err = "Please confirm password.";
	} else {
		$confirm_password = trim($_POST["confirm_password"]);
		if (empty($password_err) && ($password != $confirm_password)) {
			$confirm_password_err = "Password did not match.";
		}
	}

	// Check input errors before inserting in database
	if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
		// Prepare an insert statement
		$sql = 'INSERT INTO users (username, password) VALUES (?, ?)';

		if ($stmt = mysqli_prepare($link, $sql)) {
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

			// Set params
			$param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				$id = $getIdFromName($username);

				// Prepare an insert statement
				$sql = 'INSERT INTO avatars (ownerid, items, shirt, pants, face) VALUES (' . $id . ', "[]", 9, 8, 5)';

				if ($stmt = mysqli_prepare($link, $sql)) {
					// Attempt to execute the prepared statement
					if (mysqli_stmt_execute($stmt)) {
						// Redirect to login page
						header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
					} else {
						echo "Something went wrong. Please try again later.";
					}
				}
			} else {
				echo "Something went wrong. Please try again later.";
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
	<meta name="description" content="The register page for <?php echo htmlspecialchars($site_name); ?>.">
	<title>Register - <?php echo htmlspecialchars($site_name); ?></title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/style.css" rel="stylesheet">
	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
	<div class="page-content-wrapper">
		<main class="col-md-9 form-signin">
			<?php
			if ($registration === "on") {
				echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
				echo '<h1 class="h3 mb-3 fw-normal">Register on ' . $site_name . '</h1>';
				echo '<div class="form-group ';
				echo (!empty($username_err)) ? 'has-error' : '' . '">';
				echo '<label><i class="fas fa-user"></i> Username</label>';
				echo '<input type="text" name="username" class="form-control" value="' . $username . '">';
				echo '<span class="help-block">' . $username_err . '</span>';
				echo '</div>';
				echo '<div class="form-group ';
				echo (!empty($password_err)) ? 'has-error' : '' . '">';
				echo '<label><i class="fas fa-key"></i> Password</label>';
				echo '<input type="password" name="password" class="form-control" value="' . $password . '">';
				echo '<span class="help-block">' . $password_err . '</span>';
				echo '</div>';
				echo '<div class="form-group ';
				echo (!empty($confirm_password_err)) ? 'has-error' : '' . '">';
				echo '<label><i class="fas fa-check"></i> Confirm Password</label>';
				echo '<input type="password" name="confirm_password" class="form-control" value="' . $confirm_password . '">';
				echo '<span class="help-block">' . $confirm_password_err . '</span>';
				echo '</div>';
				echo '<button class="w-100 btn btn-lg btn-primary" type="submit"><i class="fas fa-user-plus"></i> Register</button>';
				echo '<p>Already have an account? <a href="login.php">Login here</a>.</p>';
				echo '<p>By creating an account you agree to our <a href="/terms-of-service.php">Terms of Service</a>.';
				echo '<p class="mt-5 mb-3 text-muted">&copy; ' . $site_name . " " . date("Y") . '</p>';
				echo '</form>';
			} else {
				echo '<h4>Registration is currently disabled.</h4>';
			}
			?>
		</main>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>