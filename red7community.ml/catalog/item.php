<?php
/*
  File Name: item.php
  Original Location: /catalog/item.php
  Description: The details for a item.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

session_start();

$data = file_get_contents($API_URL. '/catalog.php?api=getitembyid&id='. $_GET['id']);

// Decode the json response.
if (!str_contains($data, "This item doesn't exist or has been deleted"))
{
	$json_a = json_decode($data, true);

	$id = $_GET['id'];
	$fullname = $json_a[0]['data'][0]['name'];
	$name = $json_a[0]['data'][0]['displayname'];

	$description = $json_a[0]['data'][0]['description'];

	if ($description == "") {
		$description = "This catalog item does not have a description.";
	}

	$created = $json_a[0]['data'][0]['created'];
	$limited = $json_a[0]['data'][0]['isLimited'];
	$copies = $json_a[0]['data'][0]['copies'];
	$membershipRequired = $json_a[0]['data'][0]['membershipRequired'];
	$owners = $json_a[0]['data'][0]['owners'];
	$price = $json_a[0]['data'][0]['price'];
	$type = $json_a[0]['data'][0]['type'];
	$icon = $json_a[0]['data'][0]['icon'];
	$creator = $json_a[0]['data'][0]['creator'];

	$data_u = file_get_contents($API_URL. '/user.php?api=getbyid&id='. $creator);

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

		<link rel="stylesheet" href="/assets/css/style.css">

		<script src="/assets/js/fontawesome.js"></script>
	</head>
	<body>
        <script type="text/javascript">
            var ajaxSubmit = function(formEl) {
                // fetch the data for the form
                var data = $(formEl).serializeArray();
                var url = $(formEl).attr('action');

                // setup the ajax request
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(d) {
                        if (d.success)
                        {
                            alert('Bought item successfully!');
                            document.location = document.location;
                        }
                        else
                        {
                            alert("An error occurred while purchasing, please try again later.")
                            document.location = document.location;
                        }
                    }
                });

                // return false so the form does not actually
                // submit to the page
                return false;
            }
        </script>

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
				<main class="col-md-9">
					<div class="d-flex align-items-center border-bottom">
						<?php
							if ($name == "Not Found")
							{
								echo "<h2>This item could not be found!</h2></div><p>This item could possibly not be found due to a bug/glitch or has been removed.";
								exit;
							}
						?>
						<img src="<?php echo $icon ?>" class="catalog-item-preview"></img>
						<?php if ($membershipRequired == "Premium") { echo '<img class="premium-icon" src="'. $premiumIcon . '"</img>'; } ?>
						&nbsp;
						<div class="wrapper">
							<h2><?php echo $name ?> <?php if (in_array($_GET['id'], $items)) { echo '<img src="https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-Items@main/assets/images/item-owned.png" class="item-owned"/>'; } ?>
							<span>
								<h6>By <a href="/users/profile.php?id=<?php echo $creator; ?>">@<?php echo $creator_name; ?></a></h6>
							</span>
						</div>
					</div>

					<div>
						<?php
							if ($limited == 1)
							{
								echo '<p><strong><i>LIMITED</i></strong></p>';
							}
						?>

						<h3>About:</h3>
						<p><strong>Description:</strong> <?php echo $description ?></p>
						<p><strong>Created:</strong> <?php echo $created ?></p>

						<?php
						if ($price != "-1")
						{
							if ($price == "0" || $price == 0)
							{
								echo '<p><strong>Price: </strong>Free</p>';
							}
							else
							{
								echo '<p><strong>Price: </strong>'. $price. ' '. $currency_name. '</p>';
							}
						}
						?>
						
						<p><strong>Type:</strong> <?php echo $type ?></p>

						<?php
							if ($limited == 1)
							{
								echo '<p><strong>Copies:</strong> '. $copies. '</p>';
							}
						?>

						<?php

						if (in_array($_GET['id'], $items))
						{
							echo '<p><strong>You own this item.</strong></p>';
						}
						else
						{
							echo '<p><strong>You do not own this item yet.</strong></p>';
						}

						?>

                        <form method="post" action="/ajax/process.php"
                              onSubmit="return ajaxSubmit(this);">
                            <input hidden type="text" name="value" value="<?php echo $_GET['id']; ?>"/>
                            <input hidden type="text" name="action" value="purchaseItem"/>
                            <?php if (isset($_SESSION['id'])) { if ($price === "-1") { echo 'This item is not for sale.'; } else { if ($your_currency >= $price) { echo '<input class="btn btn-primary" type="submit" name="form_submit" value="Buy"/>'; } else { echo 'You do not have enough money to buy this item!'; } } } else { echo 'Create a free account to purchase this item!'; } ?>
                        </form>

						<hr/>

                        <h3>Owners:</h3>

                        <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
							<?php
								$vals = array_count_values(json_decode($owners, true));

								if ($owners != "" && $owners != "[]" && !empty($owners)) {
									foreach($vals as $key=>$mydata)
									{
										$data = file_get_contents($API_URL. '/user.php?api=getbyid&id='. $key);

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

										echo '<div class="col profile-list-card"><a class="profile-list" href="/users/profile.php?id='. $owner_id . '"><div class="align-items-center card text-center"><img class="card-img-top normal-img" src="'. $owner_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">'. $owner_f . '</h6><p class="card-text"><span class="badge bg-success">x'. $value . '</span></div></div></a></div>';
									}
								}
								else
								{
									echo '<p>This item has no owners yet.</p>';
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