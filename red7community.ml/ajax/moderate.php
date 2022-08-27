<?php
if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/assets/common.php';
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php";

$role = $getRole($_SESSION['id']);

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
	if (str_contains(htmlspecialchars($_POST['action']), "Application")) {
		$id = $_POST['id'];
		$preferred_email = $getApplicationEmail($id);
		$full_name = $getApplicationFullName($id);
		$user = $getUserFromApplicationId($id);

		if (htmlspecialchars($_POST['action']) == "acceptApplication") {
			$sql = "UPDATE users SET isVerified = 1 WHERE id = '" . $user. "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE applications SET accepted = 1 WHERE id = '" . $_POST['id'] . "'";
			$sendEmail($user, $ROOT_URL . "/verify.php", "verification-accepted", $full_name, "", $preferred_email, false);
		} else if (htmlspecialchars($_POST['action']) == "denyApplication") {
			$sql = "UPDATE users SET isVerified = 0 WHERE id = '" . $user. "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE applications SET accepted = 0 WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE applications SET deniedReason = '" . $_POST['reason'] . "' WHERE id = '" . $_POST['id'] . "'";
			$sendEmail($user, $ROOT_URL . "/verify.php", "verification-denied", $full_name, $_POST['reason'], $preferred_email, false);
		}
	}
}

if ($role >= 2) {
	if (htmlspecialchars($_POST['action']) == "infractUser") {
		$_id = $getActiveInfraction($_POST['id']);

		if (isset($_id))
		{
			$_type = $getInfractionType($_id);
			if (isset($_POST['isActive'])) {
				// Prepare an insert statement
				$sql = "UPDATE infractions SET active = 1 WHERE id = '" . $_id . "'";
				$result = mysqli_query($link, $sql);
	
				$sql = "UPDATE infractions SET type = '" . $_POST["type"] . "' WHERE id = '" . $_id . "'";
				$result = mysqli_query($link, $sql);
	
				$sql = "UPDATE infractions SET reason = '" . $_POST["reason"] . "' WHERE id = '" . $_id . "'";
				$result = mysqli_query($link, $sql);
	
				$sql = "UPDATE infractions SET start = '" . $_POST["start"] . "' WHERE id = '" . $_id . "'";
				$result = mysqli_query($link, $sql);
	
				$sql = "UPDATE infractions SET end = '" . $_POST["end"] . "' WHERE id = '" . $_id . "'";
			} else {
				// Prepare an insert statement
				$sql = "UPDATE infractions SET active = 0 WHERE id = '" . $_id . "'";
			}
		}
		else {
			// Prepare an insert statement
			$sql = "INSERT INTO infractions (issued_by, user_id, `type`, reason, `start`, `end`, active) VALUES(". $_SESSION["id"].", ". $_POST["id"].", '". $_POST["type"]. "', '". $_POST["reason"]. "', '". $_POST["start"]. "', '". $_POST["end"]. "', 1);";
		}
	} else if (htmlspecialchars($_POST['action']) == "currencyChange") {
		// Prepare an insert statement
		$sql = "UPDATE users SET currency = '" . htmlspecialchars($_POST["amount"]) . "' WHERE id = '" . $_POST['id'] . "'";
	} else if (htmlspecialchars($_POST['action']) == "displayNameChange") {
		// Prepare an insert statement
		$sql = "UPDATE users SET displayName = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . $_POST['id'] . "'";
	} else if (htmlspecialchars($_POST['action']) == "descriptionChange") {
		// Prepare an insert statement
		$sql = "UPDATE users SET description = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . $_POST['id'] . "'";
	} else if (htmlspecialchars($_POST['action']) == "banningClan") {
		if (isset($_POST['hasInfraction'])) {
			// Prepare an insert statement
			$sql = "UPDATE clans SET hasInfraction = 1 WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$sql = "UPDATE clans SET bannedReason = '" . $_POST["banReason"] . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);

			$todayTime = date("Y-m-d H:i:s");
			$sql = "UPDATE clans SET bannedDate = '" . $todayTime . "' WHERE id = '" . $_POST['id'] . "'";
			$result = mysqli_query($link, $sql);
		} else {
			// Prepare an insert statement
			$sql = "UPDATE clans SET hasInfraction = 0 WHERE id = '" . $_POST['id'] . "'";
		}
	} else if (htmlspecialchars($_POST['action']) == "currencyChangeClan") {
		// Prepare an insert statement
		$sql = "UPDATE clans SET currency = '" . htmlspecialchars($_POST["amount"]) . "' WHERE id = '" . $_POST['id'] . "'";
	} else if (htmlspecialchars($_POST['action']) == "displayNameChangeClan") {
		// Prepare an insert statement
		$sql = "UPDATE clans SET displayName = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . $_POST['id'] . "'";
	} else if (htmlspecialchars($_POST['action']) == "descriptionChangeClan") {
		// Prepare an insert statement
		$sql = "UPDATE clans SET description = '" . htmlspecialchars($_POST["value"]) . "' WHERE id = '" . $_POST['id'] . "'";
	} else if (htmlspecialchars($_POST['action']) == "updateSiteSettings") {
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
	} else if (htmlspecialchars($_POST['action']) == "updateItemSettings") {
		// Prepare an insert statement
		$sql = "UPDATE items SET displayname = '" . $_POST["name"] . "' WHERE id = '" . htmlspecialchars($_POST["id"]). "'";
		$result = mysqli_query($link, $sql);

		$creator = $getIdFromName($_POST['creator']);

		// Prepare an insert statement
		$sql = "UPDATE items SET creator = " . $creator . " WHERE id = '" . htmlspecialchars($_POST["id"]). "'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE items SET description = '" . htmlspecialchars($_POST["description"]) . "' WHERE id = '" . htmlspecialchars($_POST["id"]). "'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE items SET price = '" . $_POST["price"] . "' WHERE id = '" . htmlspecialchars($_POST["id"]). "'";
		$result = mysqli_query($link, $sql);

		// Prepare an insert statement
		$sql = "UPDATE items SET type = '" . $_POST["type"] . "' WHERE id = '" . htmlspecialchars($_POST["id"]). "'";
		$result = mysqli_query($link, $sql);
	} else if (htmlspecialchars($_POST['action']) == "createNewItem") {
		$creator = $getIdFromName($_POST['creator']);

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
		$sql = "INSERT INTO items (name, displayname, description, created, membershipRequired, owners, price, type, isLimited, isEquippable, copies, creator, obj, mtl, texture, icon) VALUES ('" . $_POST["name"] . "', '" . htmlspecialchars($_POST["displayname"]) . "', '" . htmlspecialchars($_POST["description"]) . "', '" . $created . "', '" . $membershipRequired . "', '[]', " . $_POST["price"] . ", '" . $_POST["type"] . "', " . $isLimited . ", " . $isEquippable . ", " . $_POST["copies"] . ", " . $creator . ", '" . $_POST["obj"] . "', '" . $_POST["mtl"] . "', '" . $_POST["texture"] . "', '" . $_POST["icon"] . "')";
	}
}

if ($role == 3) {
	if (htmlspecialchars($_POST['action']) == "roleChange") {
		if (htmlspecialchars($_POST["action"]) == "user") {
			$v = 0;
		} else if (htmlspecialchars($_POST["action"]) == "moderator") {
			$v = 1;
		} else if (htmlspecialchars($_POST["action"]) == "admin") {
			$v = 2;
		} else if (htmlspecialchars($_POST["action"]) == "super_admin") {
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
