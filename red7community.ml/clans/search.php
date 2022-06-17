<?php
// TODO: Make this feature work properly.
// TODO: Add a filter section.
// TODO: Add in next major release :)

if (isset($_GET['search'])) {
	$key = htmlspecialchars($_GET["search"]);  //key=pattern to be searched
} else {
	$key = "";
}

?>

<?php
/*
	  File Name: index.php
	  Original Location: /clans/index.php
	  Description: The clans list.
	  Author: Mitchell (BlxckSky_959)
	  Copyright (C) RED7 STUDIOS 2021
	*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";

if (isset($_GET["page"])) {
	$page = htmlspecialchars($_GET["page"]);
} else {
	$page = 1;
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clans Search - <?php echo htmlspecialchars($site_name); ?></title>
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


	<div class="page-content-wrapper">

		<div class="d-flex align-items-center">
			<h1>Page <?php echo $page ?> - Clans Search</h1>
		</div>

		<div class="d-flex align-items-center border-bottom">
			<form method="get">
				<input class="form-control" type="text" name="search" value="<?php echo htmlspecialchars($key); ?>" />
				<button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
				<a class="btn btn-warning" href="/clans/create.php"><i class="fa-solid fa-plus"></i> Create</a>
			</form>
		</div>

		<div class="row row-cols-1 row-cols-md-3 g-4">
			<?php
			$datatable = "clans"; // MySQL table name
			$results_per_page = 21; // number of results per page

			$start_from = ($page - 1) * $results_per_page;
			$sql = "SELECT id, name, displayname, icon FROM clans WHERE `displayname` like '%$key%' OR `name` like '%$key%'";
			$result = mysqli_query($link, $sql);

			while ($row = mysqli_fetch_assoc($result)) {
				if ($row["displayname"] == null || $row["displayname"] == "") {
					$owner_f = htmlspecialchars($row["name"]);
				} else {
					$owner_f = htmlspecialchars($row["displayname"]);
				}
				echo '<div class="col profile-list-card"><a class="profile-list" href="/clans/profile.php?id=' . htmlspecialchars($row["id"]) . '"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="' . $row["icon"] . '"><div class="card-body"><h6 class="card-title profile-list-title">' . htmlspecialchars($owner_f) . '</h6> <small><b>(@<small class="profile-list-title">' . htmlspecialchars($row["name"]) . '</small>)</b></small></div></div></a></div>';
			};
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
				echo " <a class='btn btn-primary' href='/clans/?page=" . $i . "'";
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