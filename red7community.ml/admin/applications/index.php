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

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
    exit;
}

$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $_SESSION['id']);

// Decode the json response.
if (!str_contains($data, "This user doesn't exist or has been deleted")) {
    $json = json_decode($data, true);

    $role = $json[0]['data'][0]['role'];
}

if (!$role >= 2) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}
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

    <?php
    
            if (isset($maintenanceMode)) {
                if ($maintenanceMode == "on") {
                    if (!$role >= 2)
                    {
                        echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
                    }
                }
            }

    ?>

    <div class="page-content-wrapper">
        <div class="d-flex align-items-center border-bottom">
            <h1>Applications - <?php echo $site_name; ?></h1>
        </div>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Submitted</th>
                    <th scope="col">View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $datatable = "applications"; // MySQL table name
                $results_per_page = 21; // number of results per page

                $start_from = ($page - 1) * $results_per_page;
                $sql = "SELECT * FROM applications WHERE accepted = 0 ORDER BY id ASC LIMIT " . $start_from . ", " . $results_per_page;
                $result = mysqli_query($link, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr><th scope="row">' . $row['id'] . '</th><td>' . $getUsername($row['sender_id']) . '</td><td>' . $row['submitted'] . '</td><td><a href="/admin/applications/view.php?id=' . $row['id'] . '">Click here</a></td></tr>';
                };
                ?>

            </tbody>
        </table>
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