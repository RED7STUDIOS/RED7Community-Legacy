<?php

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
require $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

$email = "";
$email_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$email = htmlspecialchars($_POST['email']);
	if ($email === null) {
		$email_err = "You didn't input an email!";
	} else {
		$result = mysqli_query($link, "SELECT * FROM users WHERE email='" . $email . "'");
		$row = mysqli_fetch_array($result);
		if ($row) {
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
			$update = mysqli_query($link, "UPDATE users SET reset_link_token='" . $token . "', reset_link_exp='" . $expDate . "' WHERE email='" . $email . "'");
			$url = "http://" . $_SERVER["HTTP_HOST"] . "/reset-password.php?key=" . $email . "&token=" . $token;
			$sendEmail($getIdFromEmail($email), $url, "reset-password");
			$email_err = "Sent email!";
		} else {
			$email_err = "Invalid Email Address. Go back";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The login page for <?php echo htmlspecialchars($site_name); ?>.">
	<title>Forgot Password - <?php echo htmlspecialchars($site_name); ?></title>

	<!-- Styles and Font Awesome -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/style.css" rel="stylesheet">
	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
	<!----------------------------->
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
	<div class="page-content-wrapper">
		<main class="form-signin">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<h3 class="fw-normal">Forgot Password</h3>

				<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
					<label><i class="fas fa-user"></i> Email</label>
					<input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
					<span class="help-block"><?php echo $email_err; ?></span>
				</div>

				<button class="w-100 btn btn-lg btn-primary" type="submit">Reset Password</button>

				<p class="mt-5 mb-3 text-muted">&copy; <?php echo htmlspecialchars($site_name) . " " . date("Y") ?></p>
			</form>
		</main>
	</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>