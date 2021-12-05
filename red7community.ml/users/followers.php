<?php
/*
  File Name: followers.php
  Original Location: /users/followers.php
  Description: The list of followers for a user.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if(!isset($_SESSION)){
	// Initialize the session
	session_start();
}

$data = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $_GET['id']);

$json_a = json_decode($data, true);

$id = $_GET['id'];
$isBanned = $json_a[0]['data'][0]['isBanned'];

$id = $_GET['id'];
$username = $json_a[0]['data'][0]['username'];

if ($isBanned != 1)
{
	$displayname = filterwords($json_a[0]['data'][0]['displayname']);
	$description = filterwords($json_a[0]['data'][0]['description']);
	$icon = $json_a[0]['data'][0]['icon'];
}
else
{
	$displayname = "[ CONTENT REMOVED ]";
	$description = "[ CONTENT REMOVED ]";
	$icon = "https://www.gravatar.com/avatar/?s=180";
}
$followers = $json_a[0]['data'][0]['followers'];
$membership = $json_a[0]['data'][0]['membership'];
$isAdmin = $json_a[0]['data'][0]['isAdmin'];
$isVerified = $json_a[0]['data'][0]['isVerified'];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="The followers page for <?php echo $username ?>.">
		<title><?php echo $username ?> - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="/assets/css/style.css">

		<script src="/assets/js/fontawesome.js"></script>
	</head>
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
				<main class="col-md-9">
					<div class="d-flex align-items-center border-bottom">
						<img src="<?php echo $icon ?>" style="height: 128px; width: 128px;"></img>
						&nbsp;
						<?php if (str_contains($membership, "Premium")) { echo '<img src="'. $premiumIcon . '" style="height: 40px; width: 40px;"></img>'; } ?>
						<h2 class="<?php if( $isAdmin == 1 ) { echo 'title-rainbow-lr'; } else {  } ?>"> <?php if ($displayname != "" && $displayname != "[]" && !empty($displayname)) { echo htmlspecialchars($displayname); } else { echo $username; } ?></h2>&nbsp;<?php if ($isVerified == 1) { echo '<img src="'. $verifiedIcon . '" style="height: 35px; width: 35px;"></img>'; } ?><small><b>(@<?php echo htmlspecialchars($username); ?>)</b></small><?php if ( $isBanned == 1 ) { echo '<p><strong style="color: red;">*BANNED*</strong></p>'; } ?> 
					</div>
					<div>
						<a class="btn btn-primary" href="profile.php?id=<?php echo $_GET['id'] ?>">Profile</a>
						<a class="btn btn-primary" href="/users/following.php?id=<?php echo $_GET['id'] ?>">Following</a>
						<a class="btn btn-primary" href="/users/friends.php?id=<?php echo $_GET['id'] ?>">Friends</a>
						<a class="btn btn-primary" href="/users/badges.php?id=<?php echo $_GET['id'] ?>">Badges</a>
						<a class="btn btn-primary" href="/users/inventory.php?id=<?php echo $_GET['id'] ?>">Inventory</a>
						<a class="btn btn-primary" href="/users/clans.php?id=<?php echo $_GET['id'] ?>">Clans</a>
						<hr/>
						<h3>Followers:</h3>
						<div class="row row-cols-1 row-cols-md-2">
							<?php
								if ($followers != "" && $followers != "[]" && !empty($followers)) {
									foreach(json_decode($followers) as $mydata)
									{
										$data = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $mydata);

										$json_a = json_decode($data, true);

										$followers_id = $json_a[0]['data'][0]['id'];
										$followers_name = $json_a[0]['data'][0]['username'];
										$followers_icon = $json_a[0]['data'][0]['icon'];
										$followers_dsp = $json_a[0]['data'][0]['displayname'];

										if ($followers_dsp == null || $followers_dsp == "")
										{
											$followers_f = htmlspecialchars($followers_name);
										}
										else
										{ 
											$followers_f = filterwords(htmlspecialchars($followers_dsp));
										}

										echo '<div class="col" style="height:180px; width:180px"><a href="/users/profile.php?id='. $followers_id . '" style="text-decoration: none;"><div class="align-items-center card text-center"><img class="card-img-top" src="'. $followers_icon . '" style="height:90px;width:90px;margin-top:15px"><div class="following_icon-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">'. $followers_f . '</h6> <small><b>(@'. htmlspecialchars($followers_name). ')</b></small></div></div></a></div>';
									}
								}
								else
								{
									echo '<p>This user has no followers yet.</p>';
								}
							?>
						</div>
					</div>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>