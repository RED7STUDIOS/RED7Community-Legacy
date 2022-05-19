<?php
/*
  File Name: home.php
  Original Location: /home.php
  Description: The main home page.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

if(!isset($_SESSION)){
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
header("location: login.php?u=". $_SERVER["REQUEST_URI"]);
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Home - <?php echo $site_name; ?></title>
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

			if (isset($maintenanceMode)) {
				if ($maintenanceMode == "on") {
					echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
				}
			}
		?>

        <div class="page-content-wrapper">
            <div class="d-flex align-items-center border-bottom" style="display: inline;">
                <img src="<?php echo $your_icon; ?>" class="profile-picture"/>
                &nbsp;
                <h2>Welcome&nbsp;<?php if (str_contains($your_membership, "Premium")) {
						echo '<img src="' . $premiumIcon . '" class="premium-icon"></img>';
					} ?>
                    <h2 class="<?php if ($your_isAdmin == 1) {
						echo 'title-rainbow-lr';
					} else {
					} ?>"> <?php if ($your_displayname != "" && $your_displayname != "[]" && !empty($your_displayname)) {
							echo htmlspecialchars($your_displayname);
						} else {
							echo $your_username;
						} ?></h2>&nbsp;<?php if ($your_isVerified == 1) {
						echo '<img src="' . $verifiedIcon . '" class="verified-icon"></img>';
					} ?> &nbsp; <small><b>(@<?php echo htmlspecialchars($your_username); ?>)</b></small><?php if ($your_isBanned == 1) {
						echo '<p><strong style="color: red;">*BANNED*</strong></p>';
					} ?>!
                </h2>
            </div>

            <br/>

            <h3>Friends:</h3>
            <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
				<?php
					require $_SERVER['DOCUMENT_ROOT']. "/assets/relation.php";

					$users = $REL->getUsers();
					$friends = $REL->getFriends($_SESSION['id']);

					if ($friends != "" && $friends != "[]" && !empty($friends)) {
						foreach ($users as $id=>$name) {
							if (isset($friends['f'][$id]))
							{
								$data = file_get_contents($API_URL. '/user.php?api=getbyname&name='. $name);

								$json_a = json_decode($data, true);

								$friend_id = $json_a[0]['data'][0]['id'];
								$friend_name = $json_a[0]['data'][0]['username'];
								$friend_icon = $json_a[0]['data'][0]['icon'];
								$friend_dsp = $json_a[0]['data'][0]['displayname'];

								if ($friend_dsp == null || $friend_dsp == "")
								{
									$friend_f = htmlspecialchars($name);
								}
								else
								{
									$friend_f = htmlspecialchars($friend_dsp);
								}

								echo '<div class="col profile-list-card"><a href="/users/profile.php?id='. $friend_id . '" class="profile-list"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="'. $friend_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">'. $friend_f . '</h6> <small><b>(@<small class="profile-list-title">'. htmlspecialchars($name). '</small>)</b></small></div></div></a></div>';
							}
						}
					}
					else
					{
						echo '<p>This user has no friends yet.</p>';
					}
				?>
            </div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>