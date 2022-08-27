<?php
/*
  File Name: profile.php
  Original Location: /users/profile.php
  Description: The profile for a user.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
    // Initialize the session
    session_start();
}

$data = file_get_contents($API_URL . '/clan.php?api=getbyid&id=' . htmlspecialchars($_GET['id']));

// Decode the json response.
if (!str_contains($data, "This clan doesn't exist or has been deleted")) {
    $json = json_decode($data, true);

    $hasInfraction = $json[0]['data'][0]['hasInfraction'];

    $id = htmlspecialchars($_GET['id']);
    $name = $json[0]['data'][0]['name'];

    $real_displayname = $json[0]['data'][0]['displayname'];
    $real_description = $json[0]['data'][0]['description'];
    $currency = $json[0]['data'][0]['currency'];

    if ($hasInfraction != 1) {
        $displayname = $filterwords($json[0]['data'][0]['displayname']);
        $description = $filterwords($json[0]['data'][0]['description']);
        $icon = $json[0]['data'][0]['icon'];
    } else {
        $displayname = "[ CONTENT REMOVED ]";
        $description = "[ CONTENT REMOVED ]";
        $icon = "https://www.gravatar.com/avatar/?s=180";
    }

    if ($description == "") {
        $description = "This clan has not set a description.";
    }

    $created_at = $json[0]['data'][0]['created_at'];
    $banReason = $json[0]['data'][0]['bannedReason'];
    $banDate = $json[0]['data'][0]['bannedDate'];
    $members = $json[0]['data'][0]['members'];
    $isVerified = $json[0]['data'][0]['isVerified'];
    $isSpecial = $json[0]['data'][0]['isSpecial'];
    $owner = $json[0]['data'][0]['owner'];
} else {
    $name = "Not Found";
}

if (isset($_GET["page"])) {
    $page = htmlspecialchars($_GET["page"]);
} else {
    $page = 1;
};

if (htmlspecialchars($_SESSION['id']) != $owner) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The profile page for <?php echo htmlspecialchars($displayname) ?>.">
    <title>Manage <?php echo htmlspecialchars($displayname) ?> - <?php echo htmlspecialchars($site_name); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">

    <script defer src="/assets/js/fontawesome.js"></script>
    <script defer src="/assets/js/site.js"></script>

    <script defer src="/assets/js/relation.js"></script>

    <style>
        .blok {
            margin: 10px;
        }

        .row-nav {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
    
    <main class="page-content-wrapper">
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
        <section>
            <div class="blok">
                <div class="row-nav">
                    <div class="d-flex align-items-center border-bottom">
                        <?php
                        if ($name == "Not Found") {
                            echo "<h2>This user could not be found!</h2></div><p>This user could possibly not be found due to a bug/glitch or has been removed (not banned).";
                            exit;
                        }
                        ?>
                        <img src="<?php echo htmlspecialchars($icon) ?>" class="profile-picture"></img>
                        &nbsp;
                        <h2 class="<?php if ($isSpecial == 1) {
                                        echo 'title-rainbow-lr';
                                    } else {
                                    } ?>"><a href="/clans/profile.php?id=<?php echo htmlspecialchars($_GET['id']); ?>">
                                <?php if ($displayname != "" && $displayname != "[]" && !empty($displayname)) {
                                    echo $filterwords(htmlspecialchars($displayname));
                                } else {
                                    echo $filterwords(htmlspecialchars($name));
                                } ?></a>
                            <?php if ($isVerified == 1) {
                                echo '<img src="' . $verifiedIcon . '" class="verified-icon"></img>';
                            } ?>
                            <small style="font-size: 15px;"><b>(@<?php echo htmlspecialchars($name); ?>)</b></small>
                            <?php if ($hasInfraction == 1) {
                                echo '<p><strong class="banned-text">*BANNED*</strong></p>';
                            } ?>
                            <span>
                                <h6>By <a href="/users/profile.php?id=1">@RED7Community</a>
                                </h6>
                            </span>
                            <span>
                                <h6><b>Worth:</b> <a><?php echo number_format_short($currency) . " " . $currency_name; ?></a>
                                </h6>
                            </span>
                        </h2>
                    </div>

                    <ul class="nav tab-menu nav-pills">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info">Info</a></li>
                        <li class="nav-item"><a class="nav-link" href="#payout" data-toggle="tab">Payout</a></li>
                        <li class="nav-item"><a class="nav-link" href="#addFunds" data-toggle="tab">Add Funds</a></li>
                    </ul>

                    <div class="tab-content col-sm-8">
                        <div class="tab-pane well active in active" id="info">
                            <div>
                                <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                                    <h5>Display Name:</h5>
                                    <input maxlength="69420" type="text" name="displayname" class="moderate-input" value="<?php echo htmlspecialchars($displayname); ?>" />
                                    <h5>Description:</h5>
                                    <input maxlength="69420" type="text" name="description" class="moderate-input" value="<?php echo $description; ?>" />
                                    <input hidden type="text" name="action" value="updateClanSettings" />
                                    <input hidden type="text" name="id" value="<?php echo htmlspecialchars($_GET["id"]); ?>" />
                                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-gear"></i> Update Clan Settings</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane well fade" id="payout">
                            <div>
                                <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                                    <h5>Username:</h5>
                                    <input type="text" name="username" class="moderate-input" />
                                    <h5>Amount:</h5>
                                    <input type="number" name="amount" class="moderate-input" />
                                    <input hidden type="text" name="action" value="payoutClan" />
                                    <input hidden type="text" name="id" value="<?php echo htmlspecialchars($_GET["id"]); ?>" />
                                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-money-check-dollar-pen"></i> Payout to User</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane well fade" id="addFunds">
                            <div>
                                <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                                    <h5>Amount:</h5>
                                    <input type="number" name="amount" class="moderate-input" />
                                    <input hidden type="text" name="action" value="addFundsToClan" />
                                    <input hidden type="text" name="id" value="<?php echo htmlspecialchars($_GET["id"]); ?>" />
                                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-money-bill-wave"></i> Add Funds</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
        // BS tabs hover (instead - hover write - click)
        $('.tab-menu a').click(function(e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
</body>

</html>