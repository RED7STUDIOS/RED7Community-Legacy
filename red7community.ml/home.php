<?php
/*
  File Name: home.php
  Original Location: /home.php
  Description: The main home page.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}

$premium = "";
$adminCSS = "";
$verified = "";
$shownName = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>

	<?php
	if (str_contains($your_membership, "Premium")) {
		$premium = ' <img src="' . $premiumIcon . '" class="premium-icon"></img>';
	}

	if ($your_role >= 2) {
		$adminCSS = 'class="title-rainbow-lr"';
	}

	if ($your_displayname != "" && $your_displayname != "[]" && !empty($your_displayname)) {
		$shownName = htmlspecialchars($your_displayname);
	} else {
		$shownName = $your_username;
	}

	if ($your_isVerified == 1) {
		$verified = '<img src="' . $verifiedIcon . '" class="verified-icon"></img>';
	}

	$usernameText = $premium . "<span " . $adminCSS . ">" . $shownName . "</span>" . $verified;
	?>

	<div class="page-content-wrapper">
		<div class="d-flex align-items-center border-bottom" style="display: inline;">
			<img src="<?php echo $your_icon; ?>" class="profile-picture" />
			&nbsp;
			<h2>Welcome <?php echo $usernameText; ?>!</h2>
		</div>

		<br />

		<h3>Friends:</h3>
		<div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
			<?php
			require $_SERVER['DOCUMENT_ROOT'] . "/assets/classes/Relations.php";

			$users = $REL->getUsers();
			$friends = $REL->getFriends(htmlspecialchars($_SESSION['id']));
			$friends_amt = 0;

			if ($friends != "" && $friends != "[]" && !empty($friends)) {
				foreach ($users as $id => $name) {
					if (isset($friends['f'][$id])) {
						$friends_amt = $friends_amt + 1;
						$data = file_get_contents($API_URL . '/user.php?api=getbyname&name=' . $name);

						$json = json_decode($data, true);

						$friend_id = $json[0]['data'][0]['id'];
						$friend_name = $json[0]['data'][0]['username'];
						$friend_icon = $json[0]['data'][0]['icon'];
						$friend_dsp = $json[0]['data'][0]['displayname'];

						if ($friend_dsp == null || $friend_dsp == "") {
							$friend_f = htmlspecialchars($name);
						} else {
							$friend_f = htmlspecialchars($friend_dsp);
						}

						echo '<div class="col profile-list-card"><a href="/users/profile.php?id=' . $friend_id . '" class="profile-list"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="' . $friend_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">' . $friend_f . '</h6> <small><b>(@<small class="profile-list-title">' . htmlspecialchars($name) . '</small>)</b></small></div></div></a></div>';
					}
				}
			}
			if ($friends_amt == 0) {
				echo '<p>You do not have any friends yet.</p>';
			}
			?>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>