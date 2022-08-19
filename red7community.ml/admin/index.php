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
    <title>Admin Panel - <?php echo htmlspecialchars($site_name); ?></title>
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
        <div class="d-flex align-items-center border-bottom" style="display: inline;">
            <h2>Welcome&nbsp;
                <h2><?php echo $getAdminName($your_id); ?></h2>&nbsp;
                <small><b>(@<?php echo htmlspecialchars($your_username); ?>)</b></small><?php if ($your_isBanned == 1) {
                                                                                            echo '<p><strong style="color: red;">*BANNED*</strong></p>';
                                                                                        } ?>!
            </h2>
        </div>
        <a class="btn btn-primary" href="/admin/applications"><i class="far fa-badge-check"></i> View Applications</a>
        <h3>Site Settings:</h3>
        <fieldset>
            <form method="post" action="/ajax/moderate.php" onSubmit="return ajaxSubmit(this);">
                <h5>Site Name:</h5>
                <input maxlength="69420" type="text" name="site_name" class="moderate-input" value="<?php echo htmlspecialchars($site_name); ?>" />
                <h5>Currency:</h5>
                <input maxlength="69420" type="text" name="currency" class="moderate-input" value="<?php echo $currency_name; ?>" />
                <h5>Premium Icon:</h5>
                <input maxlength="69420" type="text" name="premiumIcon" class="moderate-input" value="<?php echo $premiumIcon; ?>" />
                <h5>Verified Icon:</h5>
                <input maxlength="69420" type="text" name="verifiedIcon" class="moderate-input" value="<?php echo $verifiedIcon; ?>" />
                <h5>Appeal Email:</h5>
                <input maxlength="69420" type="text" name="appealEmail" class="moderate-input" value="<?php echo $appealEmail; ?>" />
                <h5>Registration:</h5>
                <input type="checkbox" name="registration" <?php if ($registration == "on") {
                                                                echo "checked";
                                                            } ?> />
                <h5>Maintenance Mode:</h5>
                <input type="checkbox" name="maintenance" <?php if ($maintenanceMode == "on") {
                                                                echo "checked";
                                                            } ?> />
                </br>
                <input hidden type="text" name="action" value="updateSiteSettings" />
                <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
            </form>
        </fieldset>

        <h3>Create a new catalog item:</h3>
        <fieldset>
            <form method="post" action="/ajax/moderate.php" onSubmit="return ajaxSubmit2(this);">
                <h5>*Internal* Name:</h5>
                <input maxlength="69420" type="text" name="name" class="moderate-input" value="" />
                <h5>Display Name:</h5>
                <input maxlength="69420" type="text" name="displayName" class="moderate-input" value="" />
                <h5>Creator:</h5>
                <input maxlength="69420" type="text" name="creator" class="moderate-input" value="" />
                <h5>Description:</h5>
                <textarea maxlength="200" type="text" name="description" style="width: 100%; border: 0 none white; overflow: hidden; padding: 0; outline: none; background-color: #D0D0D0;"></textarea>
                <h5>Price:</h5>
                <input maxlength="69420" type="text" name="price" class="moderate-input" value="" />
                <h5>Type:</h5>
                <select name="type" id="type">
                    <option value="back">Back</option>
                    <option value="front">Front</option>
                    <option value="face">Face</option>
                    <option value="shirt">Shirt</option>
                    <option value="pants">Pants</option>
                    <option value="t-shirt">T-Shirt</option>
                    <option value="cosmetic">Cosmetic</option>
                    <option value="hat">Hat</option>
                    <option value="faceaccessory">Face Accessory</option>
                    <option value="gear">Gear</option>
                </select>
                <h5>Membership Required:</h5>
                <input type="checkbox" name="membershipRequired" />
                <h5>Is Limited:</h5>
                <input type="checkbox" name="isLimited" />
                <h5>Is Equippable:</h5>
                <input type="checkbox" name="isEquippable" />
                <h5>Copies:</h5>
                <input maxlength="69420" type="text" name="copies" class="moderate-input" value="" />
                <h5>OBJ File:</h5>
                <input maxlength="69420" type="text" name="obj" class="moderate-input" value="" />
                <h5>MTL File:</h5>
                <input maxlength="69420" type="text" name="mtl" class="moderate-input" value="" />
                <h5>Texture File:</h5>
                <input maxlength="69420" type="text" name="texture" class="moderate-input" value="" />
                </br>
                </br>
                <input hidden type="text" name="action" value="createNewItem" />
                <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Create New Item</button>
            </form>
        </fieldset>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>