<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/common.php';

if (!isset($_SESSION)) {
    // Initialize the session
    session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
    exit;
}

$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . htmlspecialchars($_SESSION['id']));

// Decode the json response.
if (!str_contains($data, "This user doesn't exist or has been deleted")) {
    $json = json_decode($data, true);

    $role = $json[0]['data'][0]['role'];
}

if (false == true) { // (!$role >= 2) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Roles - Admin Panel - <?php echo htmlspecialchars($site_name); ?></title>
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

                // return false so the form does not actually
                // submit to the page
                return false;
            }
        </script>
        <!-- <div class="d-flex align-items-center border-bottom" style="display: inline;">
            <h2>Welcome&nbsp;
                <h2><?php echo $getDisplayName($your_id); ?></h2>&nbsp;
                <small><b>(@<?php echo htmlspecialchars($your_username); ?>)</b></small><?php if ($your_isBanned == 1) {
                                                                                            echo '<p><strong style="color: red;">*BANNED*</strong></p>';
                                                                                        } ?>!
            </h2>
        </div>
        <h3>Roles:</h3>
        <fieldset>
            <form method="post" action="/ajax/moderate.php" onSubmit="return ajaxSubmit(this);">
            <p><b><input type="checkbox" name="user-api-keys"/> User - API Keys</b></p>
            <p><b><input type="checkbox" name="admin-items-name"/> Admin - Shop - Name</b></p>
            <p><b><input type="checkbox" name="admin-items-creator"/> Admin - Shop - Creator</b></p>
            <p><b><input type="checkbox" name="admin-items-description"/> Admin - Shop - Description</b></p>
            <p><b><input type="checkbox" name="admin-items-price"/> Admin - Shop - Price</b></p>
            <p><b><input type="checkbox" name="admin-items-type"/> Admin - Shop - Type</b></p>
            <p><b><input type="checkbox" name="admin-user-display-name"/> Admin - User - Display Name</b></p>
            <p><b><input type="checkbox" name="admin-user-description"/> Admin - User - Description</b></p>
            <p><b><input type="checkbox" name="admin-user-currency"/> Admin - User - <?php echo htmlspecialchars($currency_name); ?></b></p>
            <p><b><input type="checkbox" name="admin-user-role"/> Admin - User - Role</b></p>
            <p><b><input type="checkbox" name="admin-user-ban"/> Admin - User - Ban</b></p>
            <p><b><input type="checkbox" name="admin-user-unban"/> Admin - User - Unban</b></p>
            <p><b><input type="checkbox" name="admin-maintenance-bypass"/> Admin - Maintenance - Bypass</b></p>
                
                <input hidden type="text" name="action" value="updateUserRoles" />
                <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
            </form>
        </fieldset> -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>