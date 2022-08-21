<?php
/*
  File Name: index.php
  Original Location: /catalog/index.php
  Description: The catalog list.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";

if (isset($_GET["tab"])) {
	$tab = $_GET["tab"];
} else {
	$tab = "all";
};

if (isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = 1;
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Catalog - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>

	<?php
	if (isset($your_items)) {
		$items = json_decode($your_items, true);
	} else {
		$items = array();
	}
	?>

	<script>
		function showOffsaleItems() {
			var url = window.location.href;
			if (url.indexOf('?') > -1) {
				url += '&offsale=1'
			} else {
				url += '?offsale=1'
			}
			window.location.href = url;
		}
	</script>

	<div class="page-content-wrapper">
		<div class="d-flex align-items-center border-bottom">
			<h1>Page <?php echo $page ?> - Catalog</h1>
			&nbsp;
			<a class="btn btn-primary btn-sm" href="/catalog/search.php"><i class="fa-solid fa-magnifying-glass"></i></a>
		</div>

		<a class="btn btn-primary" href="/catalog/?tab=all">All</a>
		<a class="btn btn-primary" href="/catalog/?tab=shirts">Shirts</a>
		<a class="btn btn-primary" href="/catalog/?tab=pants">Pants</a>
		<a class="btn btn-primary" href="/catalog/?tab=hats">Hats</a>
		<a class="btn btn-primary" href="/catalog/?tab=faces">Faces</a>

		<a class="btn btn-danger" onclick="showOffsaleItems()"><?php if (!isset($_GET["offsale"])) {
																	echo 'Show';
																} else {
																	echo 'Hide';
																} ?> Offsale Items</a>

		<div class="row row-cols-1 row-cols-md-3 g-4">
			<?php
			if ($tab == "all") {
				$datatable = "catalog"; // MySQL table name
				$results_per_page = 21; // number of results per page

				$price_offsale = "";

				if (isset($_GET["offsale"])) {
					$price_offsale = "";
				} else {
					$price_offsale = " WHERE price != '-1'";
				}

				$start_from = ($page - 1) * $results_per_page;
				$sql = "SELECT id, displayname, membershipRequired, price, type, icon FROM catalog" . $price_offsale . " ORDER BY id ASC LIMIT " . $start_from . ", " . $results_per_page;
				$result = mysqli_query($link, $sql);

				while ($row = mysqli_fetch_assoc($result)) {
					if (in_array($row['id'], $items)) {
						$item_owned = ' <img src="/assets/images/item-owned.png" style="height: 20px; width: 20px;"/></h2>';
					} else {
						$item_owned = "";
					}

					echo '<div class="col" style="height:180px; width:180px;"><a href="/catalog/item.php?id=' . $row['id'] . '" style="text-decoration: none;"><div class="align-items-center card text-center"><img class="card-img-top" src="' . $row['icon'] . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['displayname'] . '</h6><p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">';
					if ($row['price'] == "0") {
						echo '<b>Free' . $item_owned . '</b>';
					} else {
						echo '<b>' . number_format_short($row['price']) . '</b> ' . $currency_name . $item_owned;
					}
					echo '</div></div></a></div>';
				};
			} else if ($tab == "shirts") {
				$datatable = "catalog"; // MySQL table name
				$results_per_page = 21; // number of results per page

				$price_offsale = "";

				if (isset($_GET["offsale"])) {
					$price_offsale = " WHERE";
				} else {
					$price_offsale = " WHERE price != '-1' AND";
				}

				$start_from = ($page - 1) * $results_per_page;
				$sql = "SELECT id, displayname, membershipRequired, price, type, icon FROM catalog" . $price_offsale . " type = 'Shirt' ORDER BY id ASC LIMIT " . $start_from . ", " . $results_per_page;
				$result = mysqli_query($link, $sql);

				while ($row = mysqli_fetch_assoc($result)) {
					if (in_array($row['id'], $items)) {
						$item_owned = ' <img src="/assets/images/item-owned.png" style="height: 20px; width: 20px;"/></h2>';
					} else {
						$item_owned = "";
					}

					echo '<div class="col" style="height:180px; width:180px;"><a href="/catalog/item.php?id=' . $row['id'] . '" style="text-decoration: none;"><div class="align-items-center card text-center"><img class="card-img-top" src="' . $row['icon'] . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['displayname'] . '</h6><p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">';
					if ($row['price'] == "0") {
						echo '<b>Free' . $item_owned . '</b>';
					} else {
						echo '<b>' . number_format_short($row['price']) . '</b> ' . $currency_name . $item_owned;
					}
					echo '</div></div></a></div>';
				};
			} else if ($tab == "pants") {
				$datatable = "catalog"; // MySQL table name
				$results_per_page = 21; // number of results per page

				$price_offsale = "";

				if (isset($_GET["offsale"])) {
					$price_offsale = " WHERE";
				} else {
					$price_offsale = " WHERE price != '-1' AND";
				}

				$start_from = ($page - 1) * $results_per_page;
				$sql = "SELECT id, displayname, membershipRequired, price, type, icon FROM catalog" . $price_offsale . " type = 'Pants' ORDER BY id ASC LIMIT " . $start_from . ", " . $results_per_page;
				$result = mysqli_query($link, $sql);

				while ($row = mysqli_fetch_assoc($result)) {
					if (in_array($row['id'], $items)) {
						$item_owned = ' <img src="/assets/images/item-owned.png" style="height: 20px; width: 20px;"/></h2>';
					} else {
						$item_owned = "";
					}

					echo '<div class="col" style="height:180px; width:180px;"><a href="/catalog/item.php?id=' . $row['id'] . '" style="text-decoration: none;"><div class="align-items-center card text-center"><img class="card-img-top" src="' . $row['icon'] . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['displayname'] . '</h6><p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">';
					if ($row['price'] == "0") {
						echo '<b>Free' . $item_owned . '</b>';
					} else {
						echo '<b>' . number_format_short($row['price']) . '</b> ' . $currency_name . $item_owned;
					}
					echo '</div></div></a></div>';
				};
			} else if ($tab == "hats") {
				$datatable = "catalog"; // MySQL table name
				$results_per_page = 21; // number of results per page

				$price_offsale = "";

				if (isset($_GET["offsale"])) {
					$price_offsale = " WHERE";
				} else {
					$price_offsale = " WHERE price != '-1' AND";
				}

				$start_from = ($page - 1) * $results_per_page;
				$sql = "SELECT id, displayname, membershipRequired, price, type, icon FROM catalog" . $price_offsale . " type = 'Hat' ORDER BY id ASC LIMIT " . $start_from . ", " . $results_per_page;
				$result = mysqli_query($link, $sql);

				while ($row = mysqli_fetch_assoc($result)) {
					if (in_array($row['id'], $items)) {
						$item_owned = ' <img src="/assets/images/item-owned.png" style="height: 20px; width: 20px;"/></h2>';
					} else {
						$item_owned = "";
					}

					echo '<div class="col" style="height:180px; width:180px;"><a href="/catalog/item.php?id=' . $row['id'] . '" style="text-decoration: none;"><div class="align-items-center card text-center"><img class="card-img-top" src="' . $row['icon'] . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['displayname'] . '</h6><p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">';
					if ($row['price'] == "0") {
						echo '<b>Free' . $item_owned . '</b>';
					} else {
						echo '<b>' . number_format_short($row['price']) . '</b> ' . $currency_name . $item_owned;
					}
					echo '</div></div></a></div>';
				};
			} else if ($tab == "faces") {
				$datatable = "catalog"; // MySQL table name
				$results_per_page = 21; // number of results per page

				$price_offsale = "";

				if (isset($_GET["offsale"])) {
					$price_offsale = " WHERE";
				} else {
					$price_offsale = " WHERE price != '-1' AND";
				}

				$start_from = ($page - 1) * $results_per_page;
				$sql = "SELECT id, displayname, membershipRequired, price, type, icon FROM catalog" . $price_offsale . " type = 'Face' ORDER BY id ASC LIMIT " . $start_from . ", " . $results_per_page;
				$result = mysqli_query($link, $sql);

				while ($row = mysqli_fetch_assoc($result)) {
					if (in_array($row['id'], $items)) {
						$item_owned = ' <img src="/assets/images/item-owned.png" style="height: 20px; width: 20px;"/></h2>';
					} else {
						$item_owned = "";
					}

					echo '<div class="col" style="height:180px; width:180px;"><a href="/catalog/item.php?id=' . $row['id'] . '" style="text-decoration: none;"><div class="align-items-center card text-center"><img class="card-img-top" src="' . $row['icon'] . '" style="height:90px;width:90px;margin-top:15px"><div class="card-body"><h6 class="card-title" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">' . $row['displayname'] . '</h6><p class="card-text" style="text-align: center; width: 120px; text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">';
					if ($row['price'] == "0") {
						echo '<b>Free' . $item_owned . '</b>';
					} else {
						echo '<b>' . number_format_short($row['price']) . '</b> ' . $currency_name . $item_owned;
					}
					echo '</div></div></a></div>';
				};
			}
			?>
		</div>
		<div class="d-flex justify-content flex-wrap flex-md align-items-center pt-3 mb-3">
			<a><b>Page Selector:&nbsp;</b></a>
			<?php
			$sql = "SELECT COUNT(ID) AS total FROM " . $datatable;
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

			for ($i = 1; $i <= $total_pages; $i++) {  // print links for all pages
				echo " <a class='btn btn-primary' href='/catalog/?page=" . $i . "'";
				if ($i == $page)  echo " class='curPage'";
				echo ">" . $i . "</a>&nbsp;";
			};
			?>
		</div>
	</div>
	</main>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>