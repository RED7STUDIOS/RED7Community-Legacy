<?php
/*
	  File Name: navbar-logged-in.php
	  Original Location: /account/navbar-logged-in.php
	  Description: Navbar for being logged in.
	  Author: Mitchell (Creaous)
  	  Copyright (C) RED7 STUDIOS 2022
	*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
require $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Users.php";
require $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php";

// Detect if the session isn't set.
if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// START OF SETTING DATA FOR LATER USE LIKE THE HOME PAGE

$your_id = htmlspecialchars($_SESSION['id']);
$your_username = $getUsername($your_id);
$your_displayname = $getDisplayName($your_id);
$your_email = $getEmail($your_id);
$your_description = $getDescription($your_id);
$your_created_at = $getCreatedAt($your_id);
$your_lastLogin = $getLastLogin($your_id);
$your_lastLoginDate = $getLastLoginDate($your_id);
$your_currency = $getCurrencyFromId($_SESSION['id']);
$your_badges = $getBadges($your_id);
$your_membership = $getMembership($your_id);
$your_hasInfraction = $hasInfraction($your_id);
$your_role = $getRole($your_id);
$your_isVerified = $isVerified($your_id);
$your_clans = $getClans($your_id);
$your_items = $getItems($your_id);
$your_icon = $getIcon($your_id);

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



if ($_SERVER["REQUEST_URI"] === "/errors/infraction.php")
{
	if ($your_hasInfraction !== 1) {
		echo "<script type='text/javascript'>location.href = '/';</script>";
	}
}
else {
	if ($your_hasInfraction === 1) {
		$_id = $getActiveInfraction($_SESSION['id']);
		$_start = $getInfractionStart($_id);
		$_end = date($getInfractionEnd($_id));
	
		if ($_end < $todayTime)
		{
			$sql = "UPDATE infractions SET active=0 WHERE id=" . $_id;
			mysqli_query($link, $sql);
		}
		else
		{
			echo "<script type='text/javascript'>location.href = '/errors/infraction.php';</script>";
		}
	}
}

?>

<li class="nav-item dropdown pull-left">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		<img class="profile-picture" style="width: 20px; height: 20px;" src="<?php echo $your_icon; ?>" /> <?php echo $_SESSION["username"] ?>
	</a>
	<ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
		<li><a class="dropdown-item" href="/users/profile.php?id=<?php echo htmlspecialchars($_SESSION['id']) ?>"><i class="far fa-user"></i> Profile</a></li>
		<li><a class="dropdown-item" href="/users/profile.php?id=<?php echo htmlspecialchars($_SESSION['id']) ?>#friends"><i class="far fa-users"></i> Friends</a></li>
		<li><a class="dropdown-item" href="/users/profile.php?id=<?php echo htmlspecialchars($_SESSION['id']) ?>#inventory"><i class="far fa-backpack"></i> Inventory</a></li>
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