<?php
/*
  File Name: navbar.php
  Original Location: /account/navbar.php
  Description: Navbar file in general.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

$selected_page = $_SERVER['REQUEST_URI'];

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";

// Detect if the session isn't set.
if(!isset($_SESSION)){
    // Initialize the session
    session_start();
}

// START OF SETTING DATA FOR LATER USE LIKE THE HOME PAGE

$your_data = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $_SESSION['id']);

$your_json_a = json_decode($your_data, true);

$your_id = $_SESSION['id'];
$your_username = $your_json_a[0]['data'][0]['username'];
$your_displayname = $your_json_a[0]['data'][0]['displayname'];

$your_email = "";

	$sql = "SELECT email FROM users WHERE id=" . $_SESSION['id'];
	$result = mysqli_query($link, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$your_email = $row['email'];
		}
	}


	$sql = "SELECT * FROM admin_panel WHERE ownerid=" . $_SESSION['id'];
	$result = mysqli_query($link, $sql);

	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$admin_id = $row['id'];
			$admin_your_id = $row['ownerid'];
			$admin_full_name = $row['full_name'];
		}
	}

	$your_description = $your_json_a[0]['data'][0]['description'];
	$your_created_at = $your_json_a[0]['data'][0]['created_at'];
	$your_lastLogin = $your_json_a[0]['data'][0]['lastLogin'];
	$your_lastLoginDate = $your_json_a[0]['data'][0]['lastLoginDate'];
	$your_currency = $your_json_a[0]['data'][0]['currency'];
	$your_badges = $your_json_a[0]['data'][0]['badges'];
	$your_membership = $your_json_a[0]['data'][0]['membership'];
	$your_isBanned = $your_json_a[0]['data'][0]['isBanned'];
	$your_banReason = $your_json_a[0]['data'][0]['bannedReason'];
$your_banDate = $your_json_a[0]['data'][0]['bannedDate'];
$your_isAdmin = $your_json_a[0]['data'][0]['isAdmin'];
$your_isVerified = $your_json_a[0]['data'][0]['isVerified'];
$your_followers = $your_json_a[0]['data'][0]['followers'];
$your_following = $your_json_a[0]['data'][0]['following'];
//$your_following_clans = $your_json_a[0]['data'][0]['following_clans'];
$your_clans = $your_json_a[0]['data'][0]['clans'];
$your_items = $your_json_a[0]['data'][0]['items'];
$your_icon = $your_json_a[0]['data'][0]['icon'];

// END OF SETTING DATA FOR LATER USE LIKE THE HOME PAGE

// START OF COPY FROM login.php -------------------------- !!! UPDATE BOTH !!!

date_default_timezone_set('Australia/Adelaide');

$todayDate = date("Y-m-d");

$expire = date($your_lastLoginDate);

$today_dt = strtotime($todayDate);
$expire_dt = strtotime($expire);

if ($expire_dt < $today_dt)
{
    if (str_contains($your_membership, "PremiumDaily2200"))
    {
        $sql = "UPDATE users SET currency='". ($your_currency + 2200) . "' WHERE id=". $your_id;

        mysqli_query($link, $sql);
    }
    else if (str_contains($your_membership, "PremiumDaily1000"))
    {
        $sql = "UPDATE users SET currency='". ($your_currency + 1000) . "' WHERE id=". $your_id;

        mysqli_query($link, $sql);
    }
    else if (str_contains($your_membership, "PremiumDaily450"))
    {
        $sql = "UPDATE users SET currency='". ($your_currency + 450) . "' WHERE id=". $your_id;

        mysqli_query($link, $sql);
    }
    else
    {
        $sql = "UPDATE users SET currency='". ($your_currency + 10) . "' WHERE id=". $your_id;

        mysqli_query($link, $sql);
    }
}

$today_dt2 = strtotime($todayDate. ' - 1 week');

if ($today_dt2 >= $expire_dt)
{
    if (str_contains($your_membership, "Premium2200"))
    {
        $sql = "UPDATE users SET currency='". ($your_currency + 2200) . "' WHERE id=". $your_id;

        mysqli_query($link, $sql);
    }
    else if (str_contains($your_membership, "Premium1000"))
    {
        $sql = "UPDATE users SET currency='". ($your_currency + 1000) . "' WHERE id=". $your_id;

        mysqli_query($link, $sql);
    }
    else if (str_contains($your_membership, "Premium450"))
    {
        $sql = "UPDATE users SET currency='". ($your_currency + 450) . "' WHERE id=". $your_id;

        mysqli_query($link, $sql);
    }
}

$todayTime = date("Y-m-d H:i:s");

$sql = "UPDATE users SET lastloginDate='". $todayDate . "' WHERE id=". $your_id;

mysqli_query($link, $sql);

$sql = "UPDATE users SET lastlogin='". $todayTime . "' WHERE id=". $your_id;

mysqli_query($link, $sql);

// END OF COPY FROM login.php ---------------------------- !!! UPDATE BOTH !!!
?>
    <?php
    if (isset($maintenanceMode))
    {
    if ($maintenanceMode == "on")
    {
    echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 0;">The main website is under maintenance, functions may be limited.</div>';
    }
    }
    ?>

    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php"><?php echo $admin_site_name; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/moderate"><i class="far fa-user"></i> Moderation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/site-settings.php"><i class="far fa-cog"></i> Site Settings</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page"><?php echo $admin_full_name ?>
                                <small>(@<?php echo $_SESSION["username"] ?>)</small></a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>
