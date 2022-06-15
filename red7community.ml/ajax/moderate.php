<?php
if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/common.php';

$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $_SESSION['id']);

// Decode the json response.
if (!str_contains($data, "This user doesn't exist or has been deleted")) {
	$json = json_decode($data, true);

	$role = $json[0]['data'][0]['role'];
}

if ($role == 0) {
	header("HTTP/1.1 403 Forbidden");
	exit;
}

function post($key)
{
	if (isset($_POST[$key]))
		return $_POST[$key];
	return false;
}

$sql = "";

if ($role >= 1) {
	if (str_contains($_POST['action'], "Application")) {
		$id = $_POST['id'];
		$preferred_email = $getApplicationEmail($id);
		$full_name = $getApplicationFullName($id);
		$user = $getUserFromApplicationId($id);

		if ($_POST['action'] == "acceptApplication") {
			$sql = "UPDATE users SET isVerified = 1 WHERE id = " . $user;
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE applications SET accepted = 1 WHERE id = '" . $_POST['id'] . "'";
			$sendEmail($user, $ROOT_URL. "/verify.php", "verification-accepted", $full_name, "", $preferred_email, false);
		} else if ($_POST['action'] == "denyApplication") {
			$sql = "UPDATE users SET isVerified = 0 WHERE id = " . $user;
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE applications SET accepted = 0 WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE applications SET deniedReason = '" . $_POST['reason'] . "' WHERE id = '" . $_POST['id'] . "'";
			$sendEmail($user, $ROOT_URL. "/verify.php", "verification-denied", $full_name, $_POST['reason'], $preferred_email, false);
		}
	}
}

if ($role >= 2) {
	if ($_POST['action'] == "banningUser") {
		if (isset($_POST['isBanned'])) {
			// Prepare an insert statement
			$sql = "UPDATE users SET isBanned = 1 WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE users SET bannedReason = '" . $_POST["banReason"] . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$todayTime = date("Y-m-d H:i:s");
			$sql = "UPDATE users SET bannedDate = '" . $todayTime . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);
		} else {
			// Prepare an insert statement
			$sql = "UPDATE users SET isBanned = 0 WHERE id = '" . $_POST['id'] . "'";
		}
	} else if ($_POST['action'] == "currencyChange") {
		// Prepare an insert statement
		$sql = "UPDATE users SET currency = '" . $_POST["amount"] . "' WHERE id = '" . $_POST['id'] . "'";
	} else if ($_POST['action'] == "displayNameChange") {
		// Prepare an insert statement
		$sql = "UPDATE users SET displayName = '" . $_POST["value"] . "' WHERE id = '" . $_POST['id'] . "'";
	} else if ($_POST['action'] == "descriptionChange") {
		// Prepare an insert statement
		$sql = "UPDATE users SET description = '" . $_POST["value"] . "' WHERE id = '" . $_POST['id'] . "'";
	} else if ($_POST['action'] == "banningClan") {
		if (isset($_POST['isBanned'])) {
			// Prepare an insert statement
			$sql = "UPDATE clans SET isBanned = 1 WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE clans SET bannedReason = '" . $_POST["banReason"] . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$todayTime = date("Y-m-d H:i:s");
			$sql = "UPDATE clans SET bannedDate = '" . $todayTime . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);
		} else {
			// Prepare an insert statement
			$sql = "UPDATE clans SET isBanned = 0 WHERE id = '" . $_POST['id'] . "'";
		}
	} else if ($_POST['action'] == "currencyChangeClan") {
		// Prepare an insert statement
		$sql = "UPDATE clans SET currency = '" . $_POST["amount"] . "' WHERE id = '" . $_POST['id'] . "'";
	} else if ($_POST['action'] == "displayNameChangeClan") {
		// Prepare an insert statement
		$sql = "UPDATE clans SET displayName = '" . $_POST["value"] . "' WHERE id = '" . $_POST['id'] . "'";
	} else if ($_POST['action'] == "descriptionChangeClan") {
		// Prepare an insert statement
		$sql = "UPDATE clans SET description = '" . $_POST["value"] . "' WHERE id = '" . $_POST['id'] . "'";
	} else if ($_POST['action'] == "updateSiteSettings") {
		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '" . $_POST["site_name"] . "' WHERE name = 'site_name'";
		$result = mysqli_query($link, $sql);

		if (isset($_POST['registration'])) {
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'on' WHERE name = 'registration'";
			$result = mysqli_query($link, $sql);
		} else {
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'off' WHERE name = 'registration'";
			$result = mysqli_query($link, $sql);
		}

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '" . $_POST["currency"] . "' WHERE name = 'currency'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '" . $_POST["premiumIcon"] . "' WHERE name = 'premiumIcon'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '" . $_POST["verifiedIcon"] . "' WHERE name = 'verifiedIcon'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE site_info SET content = '" . $_POST["appealEmail"] . "' WHERE name = 'appealEmail'";
		$result = mysqli_query($link, $sql);

		if (isset($_POST['maintenance'])) {
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'on' WHERE name = 'maintenanceMode'";
			$result = mysqli_query($link, $sql);
		} else {
			// Prepare an insert statement
			$sql = "UPDATE site_info SET content = 'off' WHERE name = 'maintenanceMode'";
			$result = mysqli_query($link, $sql);
		}
	} else if ($_POST['action'] == "updateItemSettings") {
		// Prepare an insert statement
		$sql = "UPDATE catalog SET displayname = '" . $_POST["name"] . "' WHERE id = " . $_POST["id"];
		$result = mysqli_query($link, $sql);

		$data = file_get_contents($API_URL . '/user.php?api=getbyname&name=' . $_POST['creator']);

		// Decode the json response.
		if (!str_contains($data, "This user doesn't exist or has been deleted")) {
			$json = json_decode($data, true);

			$creator = $json[0]['data'][0]['displayname'];
		}

		// Prepare an insert statement
		$sql = "UPDATE catalog SET creator = " . $creator . " WHERE id = " . $_POST["id"];
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE catalog SET description = '" . $_POST["description"] . "' WHERE id = " . $_POST["id"];
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE catalog SET price = '" . $_POST["price"] . "' WHERE id = " . $_POST["id"];
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE catalog SET type = '" . $_POST["type"] . "' WHERE id = " . $_POST["id"];
		$result = mysqli_query($link, $sql);
	} else if ($_POST['action'] == "createNewItem") {
		$data = file_get_contents($API_URL . '/user.php?api=getbyname&name=' . $_POST['creator']);

		// Decode the json response.
		if (!str_contains($data, "This user doesn't exist or has been deleted")) {
			$json = json_decode($data, true);

			$creator = $json[0]['data'][0]['id'];
		}

		$createdFormat = mktime(
			date("H"),
			date("i"),
			date("s"),
			date("m"),
			date("d") + 1,
			date("Y")
		);
		$created = date("Y-m-d H:i:s", $createdFormat);

		if ($_POST["isLimited"] == "on") {
			$isLimited = 1;
		} else {
			$isLimited = 0;
		}

		if ($_POST["isEquippable"] == "on") {
			$isEquippable = 1;
		} else {
			$isEquippable = 0;
		}

		if ($_POST["membershipRequired"] == "on") {
			$membershipRequired = "Premium";
		} else {
			$membershipRequired = "None";
		}

		// Prepare an insert statement
		$sql = "INSERT INTO catalog (name, displayname, description, created, membershipRequired, owners, price, type, isLimited, isEquippable, copies, creator, obj, mtl, texture, icon) VALUES ('" . $_POST["name"] . "', '" . $_POST["displayName"] . "', '" . $_POST["description"] . "', '" . $created . "', '" . $membershipRequired . "', '[]', " . $_POST["price"] . ", '" . $_POST["type"] . "', " . $isLimited . ", " . $isEquippable . ", " . $_POST["copies"] . ", " . $creator . ", '" . $_POST["obj"] . "', '" . $_POST["mtl"] . "', '" . $_POST["texture"] . "', '" . $_POST["icon"] . "')";
	}
}

if ($role == 3) {
	if ($_POST['action'] == "roleChange") {
		if ($_POST["value"] == "user") {
			$v = 0;
		} else if ($_POST["value"] == "moderator") {
			$v = 1;
		} else if ($_POST["value"] == "admin") {
			$v = 2;
		} else if ($_POST["value"] == "super_admin") {
			$v = 3;
		}

		// Prepare an insert statement
		$sql = "UPDATE users SET role = " . $v . " WHERE id = '" . $_POST['id'] . "'";
	}
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
