<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

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

if (!$role >= 2) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}

$id = htmlspecialchars($_GET['id']);
$preferred_email = $getApplicationEmail($id);
$reason = $getApplicationReason($id);
$submitted = $getApplicationSubmittedDate($id);
$full_name = $getApplicationFullName($id);
$user = $getUserFromApplicationId($id);
$status = $getApplicationStatus($id);
$deniedReason = $getApplicationDeniedReason($id);

if ($status != 1) {
    $status = "Denied";
} else {
    $status = "Accepted";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Viewing Application: <?php echo htmlspecialchars($_GET['id']); ?> - <?php echo htmlspecialchars($site_name); ?></title>
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
            <h2>Viewing Application: <?php echo htmlspecialchars($_GET['id']); ?></h2>
        </div>

        <a class="btn btn-primary" href="/users/profile.php?id=<?php echo $user; ?>">View Applicants Profile</a>

        <h4>Applicants Name</h4>
        <p><?php echo htmlspecialchars($full_name); ?></p>
        <h4>Reason</h4>
        <p><?php echo htmlspecialchars($reason); ?></p>
        <h4>Preferred Email</h4>
        <p><?php echo htmlspecialchars($preferred_email); ?></p>

        <h3>Application Settings:</h3>
        <p><b>Application Status:</b> <?php echo $status; ?></p>
        <form method="post" action="/ajax/moderate.php" onSubmit="return ajaxSubmit(this);">
            <input hidden type="text" name="action" value="acceptApplication" />
            <input hidden type="text" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>" />
            <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Accept Application</button>
        </form>
        <br />
        <fieldset>
            <form method="post" action="/ajax/moderate.php" onSubmit="return ajaxSubmit(this);">
                <h5>Reason:</h5>
                <input maxlength="69420" type="text" name="reason" class="moderate-input" value="<?php echo $deniedReason; ?>" />
                </br>
                <input hidden type="text" name="action" value="denyApplication" />
                <input hidden type="text" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>" />
                <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Deny Application</button>
            </form>
        </fieldset>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>