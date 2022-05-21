<?php
/*
  File Name: change-password.php
  Original Location: /account/settings/change-password.php
  Description: Changing Password file.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: /login.php?u=". $_SERVER["REQUEST_URI"]);
	exit;
}
 
// Include config file
include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/assets/classes/GoogleAuthenticator.php";

if ($getSecret($_SESSION["id"]) != null)
{
    $start = date_create($getLastLogin($_SESSION["id"]));
    $end = date_create(date('m/d/Y h:i:s a', time()));
    $diff = date_diff($end, $start);
    $hours   = $diff->format('%h'); 
    $minutes = $diff->format('%i');
    $diff = $hours * 60 + $minutes;
    if ($diff > 5)
    {
        header("Location: /account/logout.php?u=". $_SERVER["REQUEST_URI"]);
        exit;
    }
}

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $checkResult="";
    if($_POST['code']){
        $code = $link->real_escape_string($_POST['code']);	
        $secret = $_POST["secret"];

        $ga = new GoogleAuthenticator();
        $checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance

        if ($checkResult){
            $setSecret($_SESSION["id"], $secret);

            header("Location: /account/logout.php");
            exit;
        }
        else
        {
            header("Location ". $_SERVER["REQUEST_URI"]);
            exit;
        }
    }
}

$ga = new GoogleAuthenticator();
$secret = $ga->createSecret();
$user 	= $getEmail($_SESSION["id"]);
$qrCodeUrl 	= $ga->getQRCodeGoogleUrl($user, $secret, $_SERVER['HTTP_HOST']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add/Change 2FA - Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="/assets/js/fontawesome.js"></script>
</head>

</html>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"]. "/account/navbar.php" ?>
    <div class="page-content-wrapper">
        <?php
				if (isset($your_isBanned))
				{
					if ($your_isBanned == 1)
					{
						echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
					}
				}
				
				if (isset($maintenanceMode))
				{
					if ($maintenanceMode == "on")
					{
						echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
					}
				}
				?>
        <main class="col-lg-10">
            <h2>Enter Code</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
                <input type="hidden" name="secret" value="<?php echo $secret; ?>">

                <div class="form-group">
                    <img src='<?php echo $qrCodeUrl; ?>' />
                </div>

                <div class="form-group">
                    <h5>Enter Google Authenticator Code</h5>
                    <input type="text" name="code" id="code" autocomplete="off" value="" required>
                </div>

                <btn class="btn btn-success" type="submit">Submit</button>

            </form>
        </main>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
</body>

</html>