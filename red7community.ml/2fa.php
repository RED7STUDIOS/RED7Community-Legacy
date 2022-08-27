<?php
/*
  File Name: change-password.php
  Original Location: /account/settings/change-password.php
  Description: Changing Password file.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION["loggedin_b2fa"]) || $_SESSION["loggedin_b2fa"] !== true) {
    header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
    exit;
}

// Include config file
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/GoogleAuthenticator.php";

$url_components = parse_url($_SERVER["REQUEST_URI"]);
if (isset($url_components['query'])) {
    parse_str($url_components['query'], $params);

    if (!isset($params['u'])) {
        $u = "/home.php";
    } else {
        $u = $params['u'];
        if ($u === "/") {
            $u = "/home.php";
        }
    }
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $checkResult = "";
    if ($_POST['code']) {
        $code = $link->real_escape_string($_POST['code']);
        $secret = $getSecret($_SESSION["id"]);

        $ga = new GoogleAuthenticator();
        $checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance

        if ($checkResult) {
            $setSecret($_SESSION["id"], $secret);

            $_SESSION['loggedin'] = true;

            // Redirect user to welcome page
            if (isset($u)) {
                header("Location: " . $u);
            } else {
                header("location: home.php");
            }
            exit;
        } else {
            echo '<script>alert("Invalid 2FA Code!")</script>';
            header("Refresh:0");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enter 2FA Code - <?php echo htmlspecialchars($site_name); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">

    <script defer src="/assets/js/fontawesome.js"></script>
    <script defer src="/assets/js/site.js"></script>
</head>

</html>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
    <div class="page-content-wrapper">
        
        <main class="centered">
            <h1><i class="fa-solid fa-mobile"></i></h1>
            <h2>2 Factor Authentication</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?u=<?php echo $u; ?>" method="post">
                <div class="form-group">
                    <h5>Enter Authentication Code</h5>
                    <input type="text" maxlength="6" name="code" id="code" autocomplete="off" value="" required>
                </div>

                <button class="btn btn-success" type="submit">Submit</button>
            </form>
        </main>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>