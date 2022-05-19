<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/common.php';

	if (!isset($_SESSION)) {
		// Initialize the session
		session_start();
	}

	// Check if the user is logged in, if not then redirect him to login page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: /login.php?u=". $_SERVER["REQUEST_URI"]);
		exit;
	}

	$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $_SESSION['id']);

	// Decode the json response.
	if (!str_contains($data, "This user doesn't exist or has been deleted")) {
		$json_a = json_decode($data, true);

		$isAdmin = $json_a[0]['data'][0]['isAdmin'];
	}

	if ($isAdmin != 1) {
		header("HTTP/1.1 403 Forbidden");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Panel - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/style.css">

		<script src="/assets/js/fontawesome.js"></script>
	</head>
	<body>
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>

		<?php
			if (isset($your_isBanned))
			{
				if ($your_isBanned == 1)
				{
					echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
				}
			}
		?>

        <div class="page-content-wrapper">
            <div class="d-flex align-items-center border-bottom" style="display: inline;">
                <h2>Welcome&nbsp;
                    <h2><?php echo $getAdminName($your_id); ?></h2>&nbsp; <small><b>(@<?php echo htmlspecialchars($your_username); ?>)</b></small><?php if ($your_isBanned == 1) {
						echo '<p><strong style="color: red;">*BANNED*</strong></p>';
					} ?>!
                </h2>
            </div>

            <br/>

            <h3>Site Settings:</h3>
            <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
				
            </div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>