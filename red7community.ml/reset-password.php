<?php
/*
  File Name: login.php
  Original Location: /login.php
  Description: The main login form.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2022
*/

// Include config file
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
if (!isset($_SESSION)) {
    session_start();
}

// Define variables and initialize with empty values
$password = "";
$password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailId = $_GET['key'];
    $token = $_GET['token'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $sql_query = "SELECT * FROM users WHERE email = '" . $emailId . "'";
    $result = mysqli_query($link, $sql_query);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            if (mysqli_query($link, "UPDATE users SET password='" . $password . "', reset_link_token='" . NULL . "', reset_link_exp='1970-01-01 00:00:00' WHERE email='" . $emailId . "'")) {
                $token = md5($email) . rand(10, 9999);
                $expFormat = mktime(
                    date("H"),
                    date("i"),
                    date("s"),
                    date("m"),
                    date("d") + 1,
                    date("Y")
                );
                $expDate = date("Y-m-d H:i:s", $expFormat);
                $update = mysqli_query($link, "UPDATE users SET reset_link_token='" . $token . "', reset_link_exp='" . $expDate . "' WHERE email='" . $emailId . "'");
                $url = "http://" . $_SERVER["HTTP_HOST"] . "/reset-password.php?key=" . $emailId . "&token=" . $token;

                $sendEmail($getIdFromEmail($emailId), $url, "changed-password");
                header("Location: /");
                $password_err = "This reset link has been used already or expired.";
            } else {
                $password_err = "An error occured.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The login page for <?php echo htmlspecialchars($site_name); ?>.">
    <title>Login - <?php echo htmlspecialchars($site_name); ?></title>

    <!-- Styles and Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <script defer src="/assets/js/fontawesome.js"></script>
    <script defer src="/assets/js/site.js"></script>
    <!----------------------------->
</head>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
    <div class="page-content-wrapper">
        <main class="form-signin">
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

            <?php
            if ($_GET['key'] && $_GET['token']) {
                $email = $_GET['key'];
                $token = $_GET['token'];
                $dn = $getDisplayName($getIdFromEmail($email));


                $query = mysqli_query(
                    $link,
                    "SELECT * FROM `users` WHERE `reset_link_token`='" . $token . "' and `email`='" . $email . "';"
                );
                $curDate = date("Y-m-d H:i:s");
                if (mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_array($query);
                    if ($row['reset_link_exp'] >= $curDate) { ?>
                        <form action="" method="post">
                            <h3 class="fw-normal">Reset password for <?php echo $dn; ?></h3>

                            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                <input type="hidden" name="reset_link_token" value="<?php echo $token; ?>">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Password</label>
                                    <input type="password" name='password' class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Confirm Password</label>
                                    <input type="password" name='cpassword' class="form-control">
                                </div>
                                <button type="submit" name="new-password" class="btn btn-primary" onclick="spin();"></button>
                        </form>
            <?php }
                } else {
                    echo '<p>This reset link has been used already or expired.</p>';
                }
            }
            ?>
        </main>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
        </script>
</body>

</html>