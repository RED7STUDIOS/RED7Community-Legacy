<?php
/*
  File Name: index.php
  Original Location: /account/settings/index.php
  Description: The main settings file for everything.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

// Initialize the session
if (!isset($_SESSION)) {
    session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../../login.php?u=" . $_SERVER["REQUEST_URI"]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">
    <script defer src="/assets/js/fontawesome.js"></script>
    <script defer src="/assets/js/site.js"></script>
</head>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
    <div class="page-content-wrapper">
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
                        if (d.success) {
                            alert('Changed value successfully!');
                            document.location = document.location;
                        } else {
                            alert("An error occurred while changing value, please try again later.")
                            document.location = document.location;
                        }
                    }
                });

                document.location = document.location;


                // return false so the form does not actually
                // submit to the page
                return false;
            }
        </script>

        

        <main class="col-md-9">
            <div class="d-flex align-items-center border-bottom">
                <h2><?php echo htmlspecialchars($_SESSION["username"]); ?>'s Settings</h2>
            </div>

            <p>Display Name:
                <b><?php if ($your_displayname == null || $your_displayname == "") {
                        echo htmlspecialchars($your_username);
                    } else {
                        echo htmlspecialchars($your_displayname);
                    } ?></b>
            </p>
            <p>Account created at: <b><?php echo htmlspecialchars($your_created_at); ?></b></p>
            <p>Last login at: <b><?php echo htmlspecialchars($your_lastLogin); ?></b></p>

            <fieldset>
                <legend>Settings:</legend>
                <a href="/account/settings/change-password.php" class="btn btn-dark" role="button"><i class="fas fa-key"></i> Change Password</a>
            <a href="/account/settings/2fa.php" class="btn btn-dark" role="button"><i class="fas fa-mobile"></i> Add/Change/Remove 2FA</a>
            <a href="/account/settings/api.php" class="btn btn-dark" role="button"><i class="fa-solid fa-cloud"></i> API Keys</a>

            <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                <input hidden type="text" name="value" value="<?php echo get_gravatar($your_email, 180) ?>" />
                <input hidden type="text" name="action" value="changeProfile" />
                <input class="btn btn-primary" type="submit" name="form_submit" value="Get Image From Gravatar" />
            </form>
            </fieldset>

            <hr />

            <fieldset>
                <legend>Change Display Name:</legend>
                <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                    <input maxlength="14" type="text" name="value" style="width: 100%;" value="<?php $sql = "SELECT displayname FROM users WHERE id=" . $_SESSION['id'];
                                                                                                $result = mysqli_query($link, $sql);
                                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                                        echo $filterwords($row['displayname']);
                                                                                                    }
                                                                                                } ?>" />
                    <input hidden type="text" name="action" value="changeDisplayName" />
                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
                </form>
            </fieldset>

            <br />

            <fieldset>
                <legend>Change Description: <small>(only 1 line)</small></legend>
                <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                    <textarea maxlength="200" type="text" name="value" style="width: 100%; border: 0 none white; overflow: hidden; padding: 0; outline: none; background-color: #D0D0D0;"><?php $sql = "SELECT description FROM users WHERE id=" . $_SESSION['id'];
                                                                                                                                                                                            $result = mysqli_query($link, $sql);
                                                                                                                                                                                            if (mysqli_num_rows($result) > 0) {
                                                                                                                                                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                                                                                                                                                    echo $filterwords($row['description']);
                                                                                                                                                                                                }
                                                                                                                                                                                            } ?>
                            </textarea>
                    <input hidden type="text" name="action" value="changeDescription" />
                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
                </form>
            </fieldset>

            <br />

            <fieldset>
                <legend>Change Email:</legend>
                <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                    <input type="text" name="value" style="width: 100%;" value="<?php $sql = "SELECT email FROM users WHERE id=" . $_SESSION['id'];
                                                                                $result = mysqli_query($link, $sql);
                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                                        echo $row['email'];
                                                                                    }
                                                                                } ?>" />
                    <input hidden type="text" name="action" value="changeEmail" />
                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
                </form>
            </fieldset>
        </main>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
        function changeDisplayName() {
            location.href = "/account/settings/change-displayname.php?displayname=" + document.getElementById(
                "changeDisplayNameText").value;
        }

        function changeDescription() {
            location.href = "/account/settings/change-description.php?description=" + document.getElementById(
                "changeDescriptionText").value;
        }

        function changeEmail() {
            location.href = "/account/settings/change-email.php?email=" + document.getElementById("changeEmailText").value;
        }
    </script>
</body>

</html>