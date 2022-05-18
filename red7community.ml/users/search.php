<?php
    // TODO: Make this feature work properly.
    // TODO: Add a filter section.
    // TODO: Add in next major release :)

	if(isset($_GET['search'])) {
		$key = $_GET["search"];  //key=pattern to be searched
	}
	else
	{
		$key = "";
	}

?>

<?php
	/*
	  File Name: index.php
	  Original Location: /users/index.php
	  Description: The users list.
	  Author: Mitchell (BlxckSky_959)
	  Copyright (C) RED7 STUDIOS 2021
	*/

	include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

	session_start();

	include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";

	if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Users Search - <?php echo $site_name; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script src="/assets/js/fontawesome.js"></script>
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

<?php
	if (isset($maintenanceMode))
	{
		if ($maintenanceMode == "on")
		{
			echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
		}
	}
?>

<div class="page-content-wrapper">

	<div class="d-flex align-items-center">
		<h1>Page <?php echo $page ?> - Users Search</h1>
	</div>

	<div class="d-flex align-items-center border-bottom">
		<form method="get">
			<input class="form-control" type="text" name="search" value="<?php echo $key; ?>" />
			<input class="btn btn-success" type="submit" value="Search" />
		</form>
	</div>

	<div class="row row-cols-1 row-cols-md-3 g-4">
		<?php
			$datatable = "users"; // MySQL table name
			$results_per_page = 21; // number of results per page

			$start_from = ($page-1) * $results_per_page;
			$sql = "SELECT * FROM users WHERE `displayname` like '%$key%'";
			$result = mysqli_query($link, $sql);

			while($row = mysqli_fetch_assoc($result)) {
				if ($row["displayname"] == null || $row["displayname"] == "")
                {
                    $owner_f = htmlspecialchars($row["username"]);
                }
                else
                {
                    $owner_f = htmlspecialchars($row["displayname"]);
                }
				echo '<div class="col profile-list-card"><a class="profile-list" href="/users/profile.php?id='. $row["id"] . '"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="'. $row["icon"] . '"><div class="card-body"><h6 class="card-title profile-list-title">'. $owner_f . '</h6> <small><b>(@<small class="profile-list-title">'. htmlspecialchars($row["username"]). '</small>)</b></small></div></div></a></div>';
			};
		?>
	</div>
	<div class="d-flex justify-content flex-wrap flex-md align-items-center pt-3 mb-3">
		<a><b>Page Selector:&nbsp;</b></a>
		<?php
			$sql = "SELECT COUNT(ID) AS total FROM ".$datatable;
			$result = mysqli_query($link, $sql);
			$row = mysqli_fetch_assoc($result);
			$total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

			for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
				echo " <a class='btn btn-primary' href='/users/?page=".$i."'";
				if ($i==$page)  echo " class='curPage'";
				echo ">".$i."</a>&nbsp;";
			};
		?>
	</div>
</div>
</main>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
