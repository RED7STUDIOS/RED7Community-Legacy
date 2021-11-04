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
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - <?php echo $admin_site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">

    <link rel="stylesheet" href="/assets/css/sidebar.css">

    <script src="/assets/js/fontawesome.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/markdown-it@12.2.0/index.min.js"></script>
</head>
<body>
<?php
if (isset($your_isBanned))
{
    if ($your_isBanned == 1)
    {
        echo "<script type='text/javascript'>location.href = '". $ROOT_URL. "/errors/banned.php';</script>";
    }
}
?>

<?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>

<div class="page-content-wrapper">
    <div class="d-flex align-items-center border-bottom">
        <h2>Welcome&nbsp;<?php if (str_contains($your_membership, "Premium")) { echo '<img src="'. $premiumIcon . '" style="height: 40px; width: 40px;"></img>'; } ?>
            <h2 class="<?php if( $your_isAdmin == 1 ) { echo 'title-rainbow-lr'; } else {  } ?>"> <?php if ($your_displayname != "" && $your_displayname != "[]" && !empty($your_displayname)) { echo htmlspecialchars($your_displayname); } else { echo $your_username; } ?></h2>&nbsp;<?php if ($your_isVerified == 1) { echo '<img src="'. $verifiedIcon . '" style="height: 35px; width: 35px;"></img>'; } ?><small><b>(@<?php echo htmlspecialchars($your_username); ?>)</b></small><?php if ( $your_isBanned == 1 ) { echo '<p><strong style="color: red;">*BANNED*</strong></p>'; } ?>!</h2>
    </div>

    <div class="card" style="width: fit-content; height: fit-content;">
        <div class="card-body">
            <h2 class="card-title">Site Status</h2>
            <?php

            include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/Parsedown.php";

            $Parsedown = new Parsedown();

            $file = file_get_contents($STATUS_GITHUB_URL. "/raw/master/README.md");

            $file = str_replace("./", $STATUS_GITHUB_URL. "/raw/master/", $file);

            $file = str_replace("h1", "h6", $file);

            echo $Parsedown->text($file);

            ?>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>