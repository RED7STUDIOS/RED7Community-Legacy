<?php
/*
	  File Name: navbar-logged-in.php
	  Original Location: /account/navbar-logged-in.php
	  Description: Navbar for being logged in.
	  Author: Mitchell (BlxckSky_959)
  	  Copyright (C) RED7 STUDIOS 2021
	*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";

// Detect if the session isn't set.
if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// START OF SETTING DATA FOR LATER USE LIKE THE HOME PAGE

$your_data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $_SESSION['id']);

$your_json = json_decode($your_data, true);

$your_id = $_SESSION['id'];
$your_username = $your_json[0]['data'][0]['username'];
$your_displayname = $your_json[0]['data'][0]['displayname'];

$your_email = "";

$sql = "SELECT email FROM users WHERE id=" . $_SESSION['id'];
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		$your_email = $row['email'];
	}
}

$your_description = $your_json[0]['data'][0]['description'];
$your_created_at = $your_json[0]['data'][0]['created_at'];
$your_lastLogin = $your_json[0]['data'][0]['lastLogin'];
$your_lastLoginDate = $your_json[0]['data'][0]['lastLoginDate'];
$your_currency = $your_json[0]['data'][0]['currency'];
$your_badges = $your_json[0]['data'][0]['badges'];
$your_membership = $your_json[0]['data'][0]['membership'];
$your_isBanned = $your_json[0]['data'][0]['isBanned'];
$your_banReason = $your_json[0]['data'][0]['bannedReason'];
$your_banDate = $your_json[0]['data'][0]['bannedDate'];
$your_role = $your_json[0]['data'][0]['role'];
$your_isVerified = $your_json[0]['data'][0]['isVerified'];
$your_followers = $your_json[0]['data'][0]['followers'];
$your_following = $your_json[0]['data'][0]['following'];
$your_clans = $your_json[0]['data'][0]['clans'];
$your_items = $your_json[0]['data'][0]['items'];
$your_icon = $your_json[0]['data'][0]['icon'];
$your_role = $your_json[0]['data'][0]['role'];

// END OF SETTING DATA FOR LATER USE LIKE THE HOME PAGE

// START OF COPY FROM login.php -------------------------- !!! UPDATE BOTH !!!

date_default_timezone_set('Australia/Adelaide');

$todayDate = date("Y-m-d");

$expire = date($your_lastLoginDate);

$today_dt = strtotime($todayDate);
$expire_dt = strtotime($expire);

if ($expire_dt < $today_dt) {
	if (str_contains($your_membership, "PremiumDaily2200")) {
		$sql = "UPDATE users SET currency='" . ($your_currency + 2200) . "' WHERE id=" . $your_id;

		mysqli_query($link, $sql);
	} else if (str_contains($your_membership, "PremiumDaily1000")) {
		$sql = "UPDATE users SET currency='" . ($your_currency + 1000) . "' WHERE id=" . $your_id;

		mysqli_query($link, $sql);
	} else if (str_contains($your_membership, "PremiumDaily450")) {
		$sql = "UPDATE users SET currency='" . ($your_currency + 450) . "' WHERE id=" . $your_id;

		mysqli_query($link, $sql);
	} else {
		$sql = "UPDATE users SET currency='" . ($your_currency + 10) . "' WHERE id=" . $your_id;

		mysqli_query($link, $sql);
	}
}

$today_dt2 = strtotime($todayDate . ' - 1 week');

if ($today_dt2 >= $expire_dt) {
	if (str_contains($your_membership, "Premium2200")) {
		$sql = "UPDATE users SET currency='" . ($your_currency + 2200) . "' WHERE id=" . $your_id;

		mysqli_query($link, $sql);
	} else if (str_contains($your_membership, "Premium1000")) {
		$sql = "UPDATE users SET currency='" . ($your_currency + 1000) . "' WHERE id=" . $your_id;

		mysqli_query($link, $sql);
	} else if (str_contains($your_membership, "Premium450")) {
		$sql = "UPDATE users SET currency='" . ($your_currency + 450) . "' WHERE id=" . $your_id;

		mysqli_query($link, $sql);
	}
}

$todayTime = date("Y-m-d H:i:s");

$sql = "UPDATE users SET lastloginDate='" . $todayDate . "' WHERE id=" . $your_id;

mysqli_query($link, $sql);
?>

<li class="nav-item dropdown pull-left">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		<img class="profile-picture" style="width: 20px; height: 20px;" src="<?php echo $your_icon; ?>" /> <?php echo $_SESSION["username"] ?>
	</a>
	<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
		<li><a class="dropdown-item" href="/users/profile.php?id=<?php echo $_SESSION['id'] ?>"><i class="far fa-user"></i> Profile</a></li>
		<li><a class="dropdown-item" href="/users/profile.php?id=<?php echo $_SESSION['id'] ?>#friends"><i class="far fa-users"></i> Friends</a></li>
		<li><a class="dropdown-item" href="/users/profile.php?id=<?php echo $_SESSION['id'] ?>#inventory"><i class="far fa-backpack"></i> Inventory</a></li>
		<li><a class="dropdown-item" href="/avatar-editor.php"><i class="far fa-user-tag"></i> Avatar Editor</a></li>
		<li><a class="dropdown-item" href="/redeem.php"><i class="far fa-clipboard-check"></i> Redeem Code</a></li>
		<li><a class="dropdown-item" href="/verify.php"><i class="far fa-badge-check"></i> Verification</a></li>
		<li>
			<hr class="dropdown-divider">
		</li>
		<li><a class="dropdown-item" href="/account/settings"><i class="far fa-cog"></i> Settings</a></li>
		<li><a class="dropdown-item" href="/account/logout.php"><i class="far fa-sign-out-alt"></i> Logout</a></li>
		<li>
			<hr class="dropdown-divider">
		</li>
		<li><a class="dropdown-item" href="/terms-of-service.php"><i class="far fa-user-check"></i> Terms of Service</a></li>
		<?php

		if ($your_role >= 2) {
			echo '<li><hr class="dropdown-divider"></li><li><a class="dropdown-item" href="/admin"><i class="far fa-screwdriver-wrench"></i> Admin Panel</a></li>';
		}

		?>
	</ul>
</li>

<li class="nav-item dropdown pull-left">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		<i class="fas fa-money-bill-wave"></i> <?php echo htmlspecialchars(number_format_short($your_currency)); ?>
	</a>
	<ul class="dropdown-menu dropdown-menu-dark dropdown-menu-left" aria-labelledby="navbarDarkDropdownMenuLink" style="left: -28%;">
		<li><a class="dropdown-item" href="/account/currency.php"><?php echo htmlspecialchars(number_format_comma($your_currency)) ?> <?php echo htmlspecialchars($currency_name) ?></a></li>
		<li><a class="dropdown-item" href="/currency.php">Buy <?php echo htmlspecialchars($currency_name) ?></a></li>
	</ul>
</li>