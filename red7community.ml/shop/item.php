<?php
require $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

session_start();

$data = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . htmlspecialchars($_GET['id']));

// Decode the json response.
if (!str_contains($data, "This item doesn't exist or has been deleted")) {
    $json = json_decode($data, true);

    $id = htmlspecialchars($_GET['id']);
    $fullname = $json[0]['data'][0]['name'];
    $name = $json[0]['data'][0]['displayname'];

    $description = $json[0]['data'][0]['description'];

    if ($description === "") {
        $description = "This items item does not have a description.";
    }

    $created = $json[0]['data'][0]['created'];
    $limited = $json[0]['data'][0]['isLimited'];
    $copies = $json[0]['data'][0]['copies'];
    $membershipRequired = $json[0]['data'][0]['membershipRequired'];
    $owners = $json[0]['data'][0]['owners'];
    $price = $json[0]['data'][0]['price'];
    $type = $json[0]['data'][0]['type'];
    $icon = $json[0]['data'][0]['icon'];
    $creator = $json[0]['data'][0]['creator'];
    $obj = $json[0]['data'][0]['obj'];
    $mtl = $json[0]['data'][0]['mtl'];

    $creator_name = $getUsername($creator);
} else {
    $name = "Not Found";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($name); ?> - <?php echo htmlspecialchars($site_name); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css">

    <script defer src="/assets/js/fontawesome.js"></script>
    <script defer src="/assets/js/site.js"></script>
</head>

<body>
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
                        alert('Bought item successfully!');
                        document.location = document.location;
                    } else {
                        alert("An error occurred while purchasing, please try again later.")
                        document.location = document.location;
                    }
                }
            });

            // return false so the form does not actually
            // submit to the page
            return false;
        }
    </script>

    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>

    <?php
    if (isset($your_items)) {
        $items = json_decode($your_items, true);
    } else {
        $items = array();
    }
    ?>

    <div class="page-content-wrapper">
        <script type="text/javascript">
            var ajaxSubmit2 = function(formEl) {
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
        <main class="page-content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <canvas id="c-items" class="items-item-preview"></canvas>
                    </div>
                    <div class="col">
                        <div class="d-flex align-items-center border-bottom">
                            <?php
                            if ($name === "Not Found") {
                                echo "<h2>This item could not be found!</h2></div><p>This item could possibly not be found due to a bug/glitch or has been removed.";
                                exit;
                            }
                            ?>
                            <!-- <img src="<?php echo $icon ?>" class="items-item-preview"></img> -->


                            <?php if ($membershipRequired === "Premium") {
                                echo '<img class="premium-icon" src="' . $premiumIcon . '"</img>';
                            } ?>
                            &nbsp;
                            <div class="wrapper">
                                <h2><?php echo htmlspecialchars($name); ?>
                                    <?php if (in_array($_GET['id'], $items)) {
                                        echo '<img src="/assets/images/item-owned.png" class="item-owned"/>';
                                    } ?>
                                    <span>
                                        <h6>By <a href="/users/profile.php?id=<?php echo $creator; ?>">@<?php echo $creator_name; ?></a>
                                        </h6>
                                    </span>
                            </div>
                        </div>

                        <div>
                            <?php
                            if ($limited === 1) {
                                echo '<p><strong><i>LIMITED</i></strong></p>';
                            }
                            ?>

                            <h3>About:</h3>
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($description); ?></p>
                            <p><strong>Created:</strong> <?php echo htmlspecialchars($created); ?></p>

                            <?php
                            if ($price != "-1") {
                                if ($price === "0" || $price === 0) {
                                    echo '<p><strong>Price: </strong>Free</p>';
                                } else {
                                    echo '<p><strong>Price: </strong>' . $price . ' ' . $currency_name . '</p>';
                                }
                            }
                            ?>

                            <p><strong>Type:</strong> <?php echo htmlspecialchars($type); ?></p>

                            <?php
                            if ($limited === 1) {
                                echo '<p><strong>Copies:</strong> ' . $copies . '</p>';
                            }
                            ?>

                            <?php

                            if (in_array(htmlspecialchars($_GET['id']), $items)) {
                                echo '<p><strong>You own this item.</strong></p>';
                            } else {
                                echo '<p><strong>You do not own this item yet.</strong></p>';
                            }

                            ?>

                            <form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
                                <input hidden type="text" name="value" value="<?php echo htmlspecialchars($_GET['id']); ?>" />
                                <input hidden type="text" name="action" value="purchaseItem" />
                                <?php if (isset($_SESSION['id'])) {
                                    if ($price === "-1") {
                                        echo 'This item is not for sale.';
                                    } else {
                                        if ($your_currency >= $price) {
                                            echo '<input class="btn btn-primary" type="submit" name="form_submit" value="Buy"/>';
                                        } else {
                                            echo 'You do not have enough money to buy this item!';
                                        }
                                    }
                                } else {
                                    echo 'Create a free account to purchase this item!';
                                } ?>
                            </form>

                            <hr />

                            <h3>Owners:</h3>

                            <div class="row row-cols-1 row-cols-md-2 flex-nowrap overflow-auto profile-list-width">
                                <?php
                                $vals = array_count_values(json_decode($owners, true));

                                if ($owners != "" && $owners != "[]" && !empty($owners)) {
                                    foreach ($vals as $key => $mydata) {
                                        $owner_id = $key;
                                        $owner_icon = $getIcon($owner_id);
                                        $owner_name = $getUsername($owner_id);
                                        $owner_displayname = $getDisplayName($owner_id);

                                        if ($owner_displayname === null || $owner_displayname === "") {
                                            $owner_f = htmlspecialchars($owner_name);
                                        } else {
                                            $owner_f = htmlspecialchars($owner_displayname);
                                        }

                                        $value = $vals[$key];

                                        echo '<div class="col profile-list-card"><a class="profile-list" href="/users/profile.php?id=' . htmlspecialchars($owner_id) . '"><div class="align-items-center card text-center"><img class="card-img-top normal-img" src="' . $owner_icon . '"><div class="card-body"><h6 class="card-title profile-list-title">' . htmlspecialchars($owner_f) . '</h6><p class="card-text"><span class="badge bg-success">x' . htmlspecialchars($value) . '</span></div></div></a></div>';
                                    }
                                } else {
                                    echo '<p>This item has no owners yet.</p>';
                                }
                                ?>
                            </div>

                            <?php
                            if (isset($your_role)) {
                                if ($your_role >= 2) {
                                    echo '
					<h3>Item Settings:</h3>
                <fieldset>
                    <form method="post" action="/ajax/moderate.php" onSubmit="return ajaxSubmit2(this);">
                        <h5>Name:</h5>
                        <input maxlength="69420" type="text" name="name" class="moderate-input"
                            value="' . htmlspecialchars($name) . '" />
                        <h5>Creator:</h5>
                        <input maxlength="69420" type="text" name="creator" class="moderate-input"
                            value="' . htmlspecialchars($creator_name) . '" />
                        <h5>Description:</h5>
                        <textarea maxlength="200" type="text" name="description"
                            style="width: 100%; border: 0 none white; overflow: hidden; padding: 0; outline: none; background-color: #D0D0D0;">' . htmlspecialchars($description) . '</textarea>
                        <h5>Price:</h5>
                        <input maxlength="69420" type="text" name="price" class="moderate-input"
                            value="' . htmlspecialchars($price) . '" />
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
                        </br>
                        </br>
                        <input hidden type="text" name="action" value="updateItemSettings" />
						<input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
                        <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Update Item Settings</button>
                    </form>
                </fieldset>';
                echo '
                <h3>Give user item:</h3>
                <fieldset>
                    <form method="post" action="/ajax/moderate.php" onSubmit="return ajaxSubmit2(this);">
                        <input hidden type="text" name="action" value="giveItem" />
						<input hidden type="text" name="id" value="' . htmlspecialchars($_GET['id']) . '"/>
                        <h5>Username</h5>
                        <input type="text" name="owner" value="' . $getUsername(htmlspecialchars($_SESSION['id'])) . '"/>
                        <button class="btn btn-success" type="submit" name="form_submit" onclick="spin();"><i class="fa-solid fa-pen-to-square"></i> Submit</button>
                    </form>
                    </fieldset>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    </main>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js">
    </script>
    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/js/shop.js.php"; ?>
</body>

</html>