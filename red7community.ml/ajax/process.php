<?php

if (!isset($_SESSION)) {
    session_start();
}

function post($key)
{
    if (isset($_POST[$key]))
        return $_POST[$key];
    return false;
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config.php';
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php";

if (htmlspecialchars($_POST['action']) == "changeDisplayName") {
    if (strlen(htmlspecialchars($_POST["action"])) > 14) {
        $sql = null;
    } else {
        // Prepare an insert statement
        $sql = "UPDATE users SET displayname = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . htmlspecialchars($_SESSION['id']) . "'";
    }
} else if (htmlspecialchars($_POST['action']) == "acceptInfraction") {
    $_id = $getActiveInfraction($_SESSION['id']);
    $_type = $getInfractionType($_id);
    if ($_type === "Warning")
    {
        $sql = "UPDATE infractions SET active = 0 WHERE id = '" . htmlspecialchars($_id) . "'";
    }
    else
    {
        $sql = null;
    }
} else if (htmlspecialchars($_POST['action']) == "changeDescription") {
    if (strlen(htmlspecialchars($_POST["action"])) > 200) {
        $sql = null;
    } else {
        // Prepare an insert statement
        $sql = "UPDATE users SET description = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . htmlspecialchars($_SESSION['id']) . "'";
    }
} else if (htmlspecialchars($_POST['action']) == "changeEmail") {
    // Prepare an insert statement
    $sql = "UPDATE users SET email = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . htmlspecialchars($_SESSION['id']) . "'";
} else if (htmlspecialchars($_POST['action']) == "changeProfile") {
    // Prepare an insert statement
    $sql = "UPDATE users SET icon = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . htmlspecialchars($_SESSION['id']) . "'";
} else if (htmlspecialchars($_POST['action']) == "updateClanSettings") {
    // Prepare an insert statement
    $sql = "UPDATE clans SET displayname = '" . htmlspecialchars($_POST["displayname"]) . "', description='" . htmlspecialchars($_POST["description"]) . "' WHERE id = '" . htmlspecialchars($_POST["id"]) . "' AND owner = " . htmlspecialchars($_SESSION['id']);
} else if (htmlspecialchars($_POST['action']) == "payoutClan") {
    $data = file_get_contents($API_URL . '/clan.php?api=getbyid&id=' . htmlspecialchars($_POST["id"]));
    $json = json_decode($data, true);
    $currency = $json[0]['data'][0]['currency'];

    $data = file_get_contents($API_URL . '/user.php?api=getbyname&name=' . $_POST["username"]);
    $json = json_decode($data, true);
    $id = $json[0]['data'][0]['id'];
    $currency_user = $json[0]['data'][0]['currency'];

    if ($currency >= htmlspecialchars($_POST["amount"])) {
        $sql_c = "UPDATE users SET currency = " . ($currency_user + htmlspecialchars($_POST["amount"])) . " WHERE id = '" . $id. "'";
        $result_c = mysqli_query($link, $sql_c);

        $sql = "UPDATE clans SET currency = " . ($currency - htmlspecialchars($_POST["amount"])) . " WHERE id = '" . htmlspecialchars($_POST["id"]) . "' AND owner = " . htmlspecialchars($_SESSION['id']);
    } else {
        $sql = null;
    }
} else if (htmlspecialchars($_POST['action']) == "addFundsToClan") {
    $data = file_get_contents($API_URL . '/clan.php?api=getbyid&id=' . htmlspecialchars($_POST["id"]));
    $json = json_decode($data, true);
    $currency = $json[0]['data'][0]['currency'];

    $data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . htmlspecialchars($_SESSION['id']));
    $json = json_decode($data, true);
    $id = $json[0]['data'][0]['id'];
    $currency_user = $json[0]['data'][0]['currency'];

    if ($currency_user >= htmlspecialchars($_POST["amount"])) {
        $sql_c = "UPDATE users SET currency = " . ($currency_user - htmlspecialchars($_POST["amount"])) . " WHERE id = '" . $id. "'";
        $result_c = mysqli_query($link, $sql_c);

        $sql = "UPDATE clans SET currency = " . ($currency + htmlspecialchars($_POST["amount"])) . " WHERE id = '" . htmlspecialchars($_POST["id"]) . "' AND owner = " . htmlspecialchars($_SESSION['id']);
    } else {
        $sql = null;
    }
} else if (htmlspecialchars($_POST['action']) == "joinClan") {
    $data = file_get_contents($API_URL . '/clan.php?api=getbyid&id=' . htmlspecialchars($_POST["id"]));
    $json = json_decode($data, true);
    $members = $json[0]['data'][0]['members'];

    $members = json_decode($members);

    array_push($members, htmlspecialchars($_SESSION['id']));

    $members = json_encode($members);

    $sql = "UPDATE clans SET members = '" . $members . "' WHERE id = '" . htmlspecialchars($_POST["id"]). "'";
} else if (htmlspecialchars($_POST['action']) == "purchaseItem") {
    $your_id = htmlspecialchars($_SESSION['id']);

    // Get the user so an interceptor cannot be used to modify currency.
    $data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $your_id);
    $json = json_decode($data, true);
    $currency = $json[0]['data'][0]['currency'];

    $data = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . htmlspecialchars(htmlspecialchars($_POST["action"])));
    $json = json_decode($data, true);
    $price = $json[0]['data'][0]['price'];
    $owners = $json[0]['data'][0]['owners'];

    if ($currency >= $price) {
        $sql_query = "SELECT items FROM users WHERE id = '" . $your_id . "'";
        $result_e = mysqli_query($link, $sql_query);

        if (mysqli_num_rows($result_e) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result_e)) {
                $your_items = $row["items"];
            }
        }

        $items_before = json_decode($your_items, true);
        $owners_before = json_decode($owners, true);

        array_push($items_before, intval(htmlspecialchars(htmlspecialchars($_POST["action"]))));
        array_push($owners_before, $your_id);

        $items_final = json_encode($items_before);
        $owners_final = json_encode($owners_before);

        $sql_items = "UPDATE users SET items = '" . $items_final . "' WHERE id = '" . $your_id . "'";

        $result_items = mysqli_query($link, $sql_items);

        $sql_items = "UPDATE users SET currency = '" . ($currency - $price) . "' WHERE id = '" . $your_id . "'";

        $result_items = mysqli_query($link, $sql_items);

        $sql = "UPDATE items SET owners = '" . $owners_final . "' WHERE id = '" . htmlspecialchars($_POST["value"]) . "'";
    } else {
        $sql = null;
    }
} else if (htmlspecialchars($_POST['action']) == "redeemCode") {
    $your_id = htmlspecialchars($_SESSION['id']);

    // Get the user so an interceptor cannot be used to modify currency.
    $data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $your_id);
    $json = json_decode($data, true);
    $your_currency = $json[0]['data'][0]['currency'];

    $data = file_get_contents($API_URL . '/code.php?api=getbycode&code=' . htmlspecialchars(htmlspecialchars($_POST["action"])));
    $json = json_decode($data, true);

    $code_id = $json[0]['data'][0]['id'];
    $code_name = $json[0]['data'][0]['name'];
    $code_currency = $json[0]['data'][0]['currency'];
    $code_items = $json[0]['data'][0]['items'];

    if ($code_items != "[]") {
        if ($code_items != "" && $code_items != "[]" && !empty($code_items)) {
            foreach (json_decode($code_items) as $mydata) {
                $data = file_get_contents($API_URL . '/item.php?api=getitembyid&id=' . $mydata);
                $json = json_decode($data, true);
                $price = $json[0]['data'][0]['price'];
                $owners = $json[0]['data'][0]['owners'];

                $sql_query = "SELECT items FROM users WHERE id = '" . $your_id . "'";
                $result_e = mysqli_query($link, $sql_query);

                if (mysqli_num_rows($result_e) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result_e)) {
                        $your_items = $row["items"];
                    }
                }

                $items_before = json_decode($your_items, true);
                $owners_before = json_decode($owners, true);

                array_push($items_before, $mydata);
                array_push($owners_before, $your_id);

                $items_final = json_encode($items_before);
                $owners_final = json_encode($owners_before);

                $sql_items = "UPDATE users SET items = '" . $items_final . "' WHERE id = '" . $your_id . "'";

                $result_items = mysqli_query($link, $sql_items);

                $sql_items1 = "UPDATE items SET owners = '" . $owners_final . "' WHERE id = '" . $mydata . "'";

                $result_items1 = mysqli_query($link, $sql_items1);
            }
        }
    }

    $sql = "UPDATE users SET currency = '" . ($your_currency + $code_currency) . "' WHERE id = '" . $your_id . "'";
}

// lets run our query
$result = mysqli_query($link, $sql);

// setup our response "object"
$resp = new stdClass();
$resp->success = false;
if ($result) {
    $resp->success = true;
}

//echo($link -> error);

print json_encode($resp);
