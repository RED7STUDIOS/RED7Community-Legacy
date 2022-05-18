<?php

if(!isset($_SESSION))
{
    session_start();
}

function post($key) {
    if (isset($_POST[$key]))
        return $_POST[$key];
    return false;
}

include_once $_SERVER['DOCUMENT_ROOT']. '/assets/config.php';

if ($_POST['action'] == "changeDisplayName")
{
    if (strlen($_POST["value"]) > 14)
    {
        $sql = null;
    }
    else
    {
        // Prepare an insert statement
        $sql = "UPDATE users SET displayname = '". $_POST["value"] . "' WHERE id = '". $_SESSION['id'] . "'";
    }
    
}

else if ($_POST['action'] == "changeDescription")
{
    if (strlen($_POST["value"]) > 200)
    {
        $sql = null;
    }
    else
    {
        // Prepare an insert statement
        $sql = "UPDATE users SET description = '". $_POST["value"] . "' WHERE id = '". $_SESSION['id'] . "'";
    }
}

else if ($_POST['action'] == "changeEmail")
{
    // Prepare an insert statement
    $sql = "UPDATE users SET email = '". $_POST["value"] . "' WHERE id = '". $_SESSION['id'] . "'";
}

else if ($_POST['action'] == "changeProfile")
{
    // Prepare an insert statement
    $sql = "UPDATE users SET icon = '". $_POST["value"] . "' WHERE id = '". $_SESSION['id'] . "'";
}

else if ($_POST['action'] == "purchaseItem")
{
    $your_id = $_SESSION['id'];

    // Get the user so an interceptor cannot be used to modify currency.
    $data = file_get_contents($API_URL. '/user.php?api=getbyid&id='. $your_id);
    $json_a = json_decode($data, true);
    $currency = $json_a[0]['data'][0]['currency'];

    $data = file_get_contents($API_URL. '/catalog.php?api=getitembyid&id='. $_POST['value']);
    $json_a = json_decode($data, true);
    $price = $json_a[0]['data'][0]['price'];
    $owners = $json_a[0]['data'][0]['owners'];

    if ($currency >= $price )
    {
        $sql_query = "SELECT items FROM users WHERE id = '". $your_id. "'";
        $result_e = mysqli_query($link, $sql_query);

        if (mysqli_num_rows($result_e) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result_e)) {
                $your_items = $row["items"];
            }
        }

        $items_before = json_decode($your_items, true);
        $owners_before = json_decode($owners, true);

        array_push($items_before, intval($_POST['value']));
        array_push($owners_before, $your_id);

        $items_final = json_encode($items_before);
        $owners_final = json_encode($owners_before);

        $sql_catalog = "UPDATE users SET items = '". $items_final . "' WHERE id = '". $your_id . "'";

        $result_catalog = mysqli_query($link, $sql_catalog);

        $sql_catalog = "UPDATE users SET currency = '". ($currency - $price) . "' WHERE id = '". $your_id . "'";

        $result_catalog = mysqli_query($link, $sql_catalog);

        $sql = "UPDATE catalog SET owners = '". $owners_final . "' WHERE id = '". $_POST["value"] . "'";
    }
    else
    {
        $sql = null;
    }
}

else if ($_POST['action'] == "redeemCode")
{
	$your_id = $_SESSION['id'];

	// Get the user so an interceptor cannot be used to modify currency.
	$data = file_get_contents($API_URL. '/user.php?api=getbyid&id='. $your_id);
	$json_a = json_decode($data, true);
	$your_currency = $json_a[0]['data'][0]['currency'];

	$data = file_get_contents($API_URL. '/code.php?api=getbycode&code='. $_POST['value']);
	$json_a = json_decode($data, true);

	$code_id = $json_a[0]['data'][0]['id'];
	$code_name = $json_a[0]['data'][0]['name'];
	$code_currency = $json_a[0]['data'][0]['currency'];
	$code_items = $json_a[0]['data'][0]['items'];

	if ($code_items != "[]")
	{
		if ($code_items != "" && $code_items != "[]" && !empty($code_items)) {
			foreach(json_decode($code_items) as $mydata) {
				$data = file_get_contents($API_URL. '/catalog.php?api=getitembyid&id='. $mydata);
				$json_a = json_decode($data, true);
				$price = $json_a[0]['data'][0]['price'];
				$owners = $json_a[0]['data'][0]['owners'];

				$sql_query = "SELECT items FROM users WHERE id = '". $your_id. "'";
				$result_e = mysqli_query($link, $sql_query);

				if (mysqli_num_rows($result_e) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result_e)) {
						$your_items = $row["items"];
					}
				}

				$items_before = json_decode($your_items, true);
				$owners_before = json_decode($owners, true);

				array_push($items_before, $mydata);
				array_push($owners_before, $your_id);

				$items_final = json_encode($items_before);
				$owners_final = json_encode($owners_before);

				$sql_catalog = "UPDATE users SET items = '". $items_final . "' WHERE id = '". $your_id . "'";

				$result_catalog = mysqli_query($link, $sql_catalog);

				$sql_catalog1 = "UPDATE catalog SET owners = '". $owners_final . "' WHERE id = '". $mydata . "'";

				$result_catalog1 = mysqli_query($link, $sql_catalog1);
			}
		}
	}

	$sql = "UPDATE users SET currency = '". ($your_currency + $code_currency) . "' WHERE id = '". $your_id . "'";
}

// lets run our query
$result = mysqli_query($link, $sql);

// setup our response "object"
$resp = new stdClass();
$resp->success = false;
if($result) {
    $resp->success = true;
}

//echo($link -> error);

print json_encode($resp);
?>