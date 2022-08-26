<?php
/*
  File Name: register.php
  Original Location: /register.php
  Description: The main register form.
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
$name = $displayname = "";
$name_err = $displayname_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        if (!preg_match("/([%\$#\*]+)/", $_POST["name"])) {
            // Prepare a select statement
            $sql = "SELECT id FROM clans WHERE name = ?";

            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_name);

                // Set parameters
                $param_name = trim($_POST["name"]);

                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    /* store result */
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        $name_err = "This name is already taken.";
                    } else {
                        $name = trim($_POST["name"]);
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                $name_err = "You are not allowed to use ~`!@#$%^&*()-+=[]{}\|;:',./?";
            }
        }
    }

    // Validate displayname
    if (empty(trim($_POST["displayname"]))) {
        $displayname_err = "Please enter a display name.";
    } elseif (strlen(trim($_POST["displayname"])) < 4) {
        $displayname_err = "A display name must have atleast 4 characters.";
    } else {
        $displayname = trim($_POST["displayname"]);
        $param_displayname = trim($_POST["displayname"]);
    }

    // Check input errors before inserting in database
    if (empty($name_err) && empty($displayname_err)) {
        // Prepare an insert statement
        $sql = 'INSERT INTO clans (name, displayname, owner, icon, members) VALUES (?, ?, ?, ?, ?)';

        $icon = "https://www.gravatar.com/avatar/?s=180&d=mp&r=g";
        $owner = $_SESSION["id"];
        $members = "[" . $_SESSION["id"] . "]";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_displayname, $owner, $icon, $members);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                $data = file_get_contents($API_URL . '/clan.php?api=getbyname&name=' . $_POST["name"]);

                // Decode the json response.
                if (!str_contains($data, "This clan doesn't exist or has been deleted")) {
                    $json = json_decode($data, true);

                    $id = $json[0]['data'][0]['id'];
                }

                // Redirect to login page
                header("location: /clans/profile.php?id=" . $id);
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The register page for <?php echo htmlspecialchars($site_name); ?>.">
    <title>Create Clan - <?php echo htmlspecialchars($site_name); ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <script defer src="/assets/js/fontawesome.js"></script>
    <script defer src="/assets/js/site.js"></script>
</head>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
    <div class="page-content-wrapper">
        <script>
            function nospaces(t) {
                if (t.value.match(/\s/g)) {
                    t.value = t.value.replace(/\s/g, '');
                }
            }
        </script>

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

        <main class="col-md-9 form-signin">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1 class="h3 mb-3 fw-normal">Create Clan</h1>
                <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                    <label><i class=" fas fa-input-text"></i> Name (no spaces)</label>
                    <input type="text" name="name" class="form-control" onkeyup="nospaces(this)" value="<?php echo $name; ?>">
                    <span class="help-block"><?php echo $name_err; ?></span>
                </div>
                <div class="form-group">
                    <div class="form-group <?php echo (!empty($displayname_err)) ? 'has-error' : ''; ?>">
                        <label><i class="fas fa-display-code"></i> Display Name</label>
                        <input type="text" name="displayname" class="form-control" value="<?php echo $displayname; ?>">
                        <span class="help-block"><?php echo $displayname_err; ?></span>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit"><i class="fas fa-user-plus"></i> Create</button>
                    <p class="mt-5 mb-3 text-muted">&copy; <?php echo $site_name . " " . date("Y") ?></p>
            </form>
        </main>
    </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>