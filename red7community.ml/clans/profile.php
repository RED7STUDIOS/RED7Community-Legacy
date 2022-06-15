<?php
/*
  File Name: profile.php
  Original Location: /users/profile.php
  Description: The profile for a user.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
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

    $isBanned = $json[0]['data'][0]['isBanned'];

    $id = htmlspecialchars($_GET['id']);
    $name = $json[0]['data'][0]['name'];

    $real_displayname = $json[0]['data'][0]['displayname'];
    $real_description = $json[0]['data'][0]['description'];
    $currency = $json[0]['data'][0]['currency'];

    if ($isBanned != 1) {
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

$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . htmlspecialchars($owner));

// Decode the json response.
if (!str_contains($data, "This user doesn't exist or has been deleted")) {
    $json = json_decode($data, true);

    $id_owner = htmlspecialchars($_GET['id']);
    $name_owner = $json[0]['data'][0]['username'];
}

if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The profile page for <?php echo htmlspecialchars($displayname) ?>.">
    <title><?php echo htmlspecialchars($displayname) ?> - <?php echo htmlspecialchars($site_name); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">

    <script src="/assets/js/fontawesome.js"></script>
    <script src="/assets/js/site.js"></script>

    <script src="/assets/js/relation.js"></script>

    <style>
        #c {
            width: 50%;
            height: 50%;
        }
    </style>
</head>

<body onload="init();">
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

        <script>
            let observe;
            if (window.attachEvent) {
                observe = function(element, event, handler) {
                    element.attachEvent('on' + event, handler);
                };
            } else {
                observe = function(element, event, handler) {
                    element.addEventListener(event, handler, false);
                };
            }

            function init() {
                let text = document.getElementById('text');

                function resize() {
                    text.style.height = 'auto';
                    text.style.height = text.scrollHeight + 'px';
                }
                /* 0-timeout to get the already changed text */
                function delayedResize() {
                    window.setTimeout(resize, 0);
                }

                observe(text, 'change', resize);
                observe(text, 'cut', delayedResize);
                observe(text, 'paste', delayedResize);
                observe(text, 'drop', delayedResize);
                observe(text, 'keydown', delayedResize);

                text.focus();
                text.select();
                resize();
            }
        </script>

        <?php
        if (isset($your_isBanned)) {
            if ($your_isBanned == 1) {
                echo "<script type='text/javascript'>location.href = '/errors/banned.php';</script>";
            }
        }

        if (isset($maintenanceMode)) {
            if ($maintenanceMode == "on") {
                echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
            }
        }
        ?>

        <main class="page-content-wrapper">
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
                            } ?>">
                    <?php if ($displayname != "" && $displayname != "[]" && !empty($displayname)) {
                        echo $filterwords(htmlspecialchars($displayname));
                    } else {
                        echo $filterwords(htmlspecialchars($name));
                    } ?>
                    <?php if ($isVerified == 1) {
                        echo '<img src="' . $verifiedIcon . '" class="verified-icon"></img>';
                    } ?>
                    <small style="font-size: 15px;"><b>(@<?php echo htmlspecialchars($name); ?>)</b></small>
                    <?php if ($isBanned == 1) {
                        echo '<p><strong class="banned-text">*BANNED*</strong></p>';
                    } ?>
                    <span>
                        <h6>By <a href="/users/profile.php?id=1">@<?php echo $name_owner; ?></a>
                        </h6>
                    </span>
                    <span>
                        <h6><b>Worth:</b> <a><?php echo number_format_short($currency) . " " . $currency_name; ?></a>
                        </h6>
                    </span>
                </h2>

            </div>
            <div>
                <?php
                if ($isBanned == 1) {
                    if ($banDate == "" && $banReason == "") {
                        echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>Unknown</strong> with the following reason: <strong>Unknown</strong></p><hr/>';
                    } else if ($banDate != "") {
                        if ($banReason != "") {
                            echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>' . $banDate . '</strong> with the following reason: <strong>' . $banReason . '</strong></p><hr/>';
                        } else {
                            echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>' . $banDate . '</strong> with the following reason: <strong>Unknown</strong></p><hr/>';
                        }
                    } else {
                        echo '<h3>Ban Information:</h3><p>This user was banned on: <strong>Unknown</strong> with the following reason: <strong>' . $banReason . '</strong></p><hr/>';
                    }
                }
                ?>

                <?php
                if ($owner == $_SESSION['id']) {
                    echo '<a href="/clans/manage.php?id=' . $_GET['id'] . '" class="btn btn-primary">Manage</a>';
                }
                ?>

                <?php
                $d = json_decode($members);

                if (!in_array($_SESSION['id'], $d)) {
                    echo '<form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                        <input hidden type="text" name="action" value="joinClan" />
                        <input hidden type="text" name="id" value="' . $_GET['id'] . '" />
                        <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-right-to-bracket"></i> Join Clan</button>
                    </form>';
                }
                ?>


                <h3>About:</h3>
                <textarea class="description" id="text" disabled><?php echo $filterwords(htmlspecialchars($description)); ?></textarea>
                <hr />

                <div title="members" id="members">
                    <h3>Members:</h3>
                    <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
                        <?php
                        if ($members != "" && $members != "[]" && !empty($members)) {
                            foreach (json_decode($members) as $mydata) {
                                $data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $mydata);

                                $json = json_decode($data, true);

                                $member_id = $json[0]['data'][0]['id'];
                                $member_name = $json[0]['data'][0]['username'];
                                $member_icon = $json[0]['data'][0]['icon'];
                                $member_dsp = $json[0]['data'][0]['displayname'];

                                if ($member_dsp == null || $member_dsp == "") {
                                    $member_f = htmlspecialchars($name);
                                } else {
                                    $member_f = htmlspecialchars($member_dsp);
                                }

                                echo '<div class="col profile-list-card"><a class="profile-list" href="/users/profile.php?id=' . htmlspecialchars($member_id) . '"><div class="align-items-center card text-center"><img class="card-img-top user-img" src="' . $member_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">' . htmlspecialchars($member_f) . '</h6> <small><b>(@<small class="profile-list-title">' . htmlspecialchars($member_name) . '</small>)</b></small></div></div></a></div>';
                            }
                        } else {
                            echo '<p>This user has no members yet.</p>';
                        }
                        ?>
                    </div>
                </div>

                <hr />
                <?php
                if (isset($your_isAdmin))
                    if ($your_isAdmin == 1) {
                        $sql = "SELECT currency FROM clans WHERE id=" . htmlspecialchars($_GET['id']);
                        $result = mysqli_query($link, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $current_currency = htmlspecialchars($row['currency']);
                            }
                        }

                        echo '<fieldset>
                                <h3>Real Data:</h3>
                                <form method="post" action="/ajax/moderate.php"
                                    onSubmit="return ajaxSubmit(this);"><p><b>Display Name: </b> <input maxlength="69420" type="text" name="value"
                                    value="' . $real_displayname . '"/>
    <input hidden type="text" name="action" value="displayNameChangeClan"/>
    <input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
    </form></p>
                                <p><b>Name: </b>' . $name . '</p>
                                <form method="post" action="/ajax/moderate.php"
                                    onSubmit="return ajaxSubmit(this);"><p><b>Description: </b><textarea maxlength="200" type="text" name="value" style="width: 100%; border: 0 none white; overflow: hidden; padding: 0; outline: none; background-color: #D0D0D0;">' . $real_description . '
                                    </textarea><input hidden type="text" name="action" value="descriptionChangeClan"/>
                                    <input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
                                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
                                    </form></p>
                        
                                <form method="post" action="/ajax/moderate.php"
                                    onSubmit="return ajaxSubmit(this);">
                                    <label><b>Currency Amount:</b></label> <input maxlength="69420" type="number" name="amount"
                                                                                value="' . $current_currency . '"/>
                                    <input hidden type="text" name="action" value="currencyChangeClan"/>
                                    <input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
                                    <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Change</button>
                                </form>
                            </fieldset>
                            <hr/>
                            ';

                        if ($isBanned == 1) {
                            $checked = 'checked';
                        } else {
                            $checked = "";
                        }

                        echo '
                                    <fieldset>
                    <h3>Ban Settings:</h3>
                    <form method="post" action="/ajax/moderate.php"
                        onSubmit="return ajaxSubmit(this);">
                        <h5>Is Banned:</h5>
                        <input type="checkbox" name="isBanned"' . htmlspecialchars($checked) . '/>
                        <h5>Ban Reason:</h5>
                        <input maxlength="69420" type="text" name="banReason" class="moderate-input" value="' . htmlspecialchars($banReason) . '"/>
                        <input hidden type="text" name="action" value="banningClan"/>
                        <input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
                        <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-ban"></i> Ban / Unban</button>
                    </form>
                </fieldset>

                <hr/>
                                    ';
                    }


                ?>
            </div>
    </div>
    </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>