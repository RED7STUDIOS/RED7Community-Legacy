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

$data = file_get_contents($API_URL. '/catalog.php?key=CvHKAVEBzGveKVUpLaUZZWgHt&api=getitembyid&id='. $_GET['id']);

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
						<img src="<?php echo $icon ?>" style="height: 128px; width: 128px;"></img>
						<?php if ($membershipRequired == "Premium") { echo '<img src="'. $premiumIcon . '" style="height: 40px; width: 40px;"></img>'; } ?>
						&nbsp;
						<div class="wrapper">
							<h2><?php echo $name ?> <?php if (in_array($_GET['id'], $items)) { echo '<img src="https://cdn.jsdelivr.net/gh/RED7Studios/RED7Community-Items@main/assets/images/item-owned.png" style="height: 20px; width: 20px;"/>'; } ?>
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
                            <?php if ($price === "-1") { echo 'hidden'; } else { if ($your_currency >= $price) { echo '<input class="btn btn-primary" type="submit" name="form_submit" value="Buy"/>'; } else { echo 'You do not have enough money to buy this item!'; } } ?>
                        </form>

						<hr/>
						
						<a class="btn btn-primary" href="owners.php?id=<?php echo $_GET['id'] ?>">Owners</a>
					</div>
				</div>
			</main>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	</body>
</html>