<?php
/*
  File Name: owners.php
  Original Location: /catalog/owners.php
  Description: The owners of a item.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

session_start();

$data = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $_GET['id']);

// Decode the json response.
if (!str_contains($data, "This item doesn't exist or has been deleted"))
{
	$json_a = json_decode($data, true);

	$id = $_GET['id'];
	$name = $json_a[0]['data'][0]['displayname'];
	$membershipRequired = $json_a[0]['data'][0]['membershipRequired'];
	$owners = $json_a[0]['data'][0]['owners'];
	$icon = $json_a[0]['data'][0]['icon'];
	$creator = $json_a[0]['data'][0]['creator'];

	$data_u = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $creator);

	$json_a = json_decode($data_u, true);

	$creator_name = $json_a[0]['data'][0]['username'];
}
else
{
	$name = "Not Found";
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $name ?> - <?php echo $site_name; ?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-Items@main/assets/css/style.css">

		<link rel="stylesheet" href="/assets/css/sidebar.css">

		<script src="https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-Items@main/assets/js/fontawesome.js"></script>
	</head>
	<body>
		<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>

		<?php
		if (isset($your_items))
		{
			$items = json_decode($your_items, true);
		}
		else
		{
			$items = array();
		}
		?>

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
				<main class="col-md-9">
					<div class="d-flex align-items-center border-bottom">
						<?php
							if ($name == "Not Found")
							{
								echo "<h2>This item could not be found!</h2></div><p>This item could possibly not be found due to a bug/glitch or has been removed.";
								exit;
							}
						?>
						<img src="<?php echo $icon ?>" style="height: 128px; width: 128px;"></img>
						<?php if ($membershipRequired == "Premium") { echo '<img src="'. $premiumIcon . '" style="height: 40px; width: 40px;"></img>'; } ?>
						&nbsp;
						<div class="wrapper">
							<h2><?php echo $name ?> <?php if (in_array($_GET['id'], $items)) { echo '<img src="https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-Items@main/assets/images/item-owned.png" style="height: 20px; width: 20px;"/></h2>'; } ?>
							<span>
								<h6>By <a href="/users/profile.php?id=<?php echo $creator; ?>">@<?php echo $creator_name; ?></a></h6>
							</span>
						</div>
					</div>
					<div>
						<h3>Owners:</h3>

						<div class="row row-cols-1 row-cols-md-2 g-4">
							<?php
								$vals = array_count_values(json_decode($owners, true));

								if ($owners != "" && $owners != "[]" && !empty($owners)) {
									foreach($vals as $key=>$mydata)
									{
										$data = file_get_contents($API_URL. '/user.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getbyid&id='. $key);

										$json_a = json_decode($data, true);

										$owner_id = $json_a[0]['data'][0]['id'];
										$owner_icon = $json_a[0]['data'][0]['icon'];
										$owner_name = $json_a[0]['data'][0]['username'];
										$owner_displayname = $json_a[0]['data'][0]['displayname'];

										if ($owner_displayname == null || $owner_displayname == "")
										{
											$owner_f = htmlspecialchars($owner_name);
										}
										else
										{ 
											$owner_f = htmlspecialchars($owner_displayname);
										}

										$value = $vals[$key];

										echo '<div class="col" style="height:180px; width:180px"><a href="/users/profile.php?id='. $owner_id . '" style="text-decoration: none;"><div class="align-items-center card text-center"><img class="card-img-top" src="'. $owner_icon . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">'. $owner_f . '</h6><p class="card-text"><span class="badge bg-success">x'. $value . '</span></div></div></a></div>';
									}
								}
								else
								{
									echo '<p>This item has no owners yet.</p>';
								}
							?>
						</div>
						<hr/>
						<a class="btn btn-primary" href="item.php?id=<?php echo $_GET['id'] ?>">Item Page</a>
					</div>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>