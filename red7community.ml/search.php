<?php
if (isset($_GET['search'])) {
    $key = $_GET["search"];  //key=pattern to be searched
}

?>

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
}

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Search - <?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="/assets/css/paper-kit.css?v=2.2.0" rel="stylesheet"/>

    <script src="/assets/js/fontawesome.js"></script>
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

<?php
if (isset($maintenanceMode)) {
    if ($maintenanceMode == "on") {
        echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
    }
}
?>

<div class="page-content-wrapper">
    <div class="d-flex align-items-center border-bottom">
        <h1>Page <?php echo $page ?> - Catalog Search</h1>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        if ($tab == "all") {
            $datatable = "catalog"; // MySQL table name
            $results_per_page = 21; // number of results per page

            $start_from = ($page - 1) * $results_per_page;
            $sql = "SELECT * FROM catalog WHERE `displayname` like '%$key%'";
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
            }
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
            if ($i == $page) echo " class='curPage'";
            echo ">" . $i . "</a>&nbsp;";
        }
        ?>
    </div>
</div>
</main>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
        crossorigin="anonymous"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="./assets/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="./assets/js/plugins/moment.min.js"></script>
<script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
</body>
</html>
