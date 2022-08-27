<?php
$getUsername = function ($id) use ($link) {
	$sql_query = "SELECT username FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["username"];
		}
	}
};

$getDisplayName = function ($id) use ($link) {
	$sql_query = "SELECT displayname FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["displayname"];
		}
	}
};

$getDescription = function ($id) use ($link) {
	$sql_query = "SELECT description FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["description"];
		}
	}
};

$getCreatedAt = function ($id) use ($link) {
	$sql_query = "SELECT created_at FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["created_at"];
		}
	}
};

$getLastLogin = function ($id) use ($link) {
	$sql_query = "SELECT lastLogin FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["lastLogin"];
		}
	}
};

$getLastLoginDate = function ($id) use ($link) {
	$sql_query = "SELECT lastLoginDate FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["lastLoginDate"];
		}
	}
};

$getEmail = function ($id) use ($link) {
	$sql_query = "SELECT email FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["email"];
		}
	}
};

$getBadges = function ($id) use ($link) {
	$sql_query = "SELECT badges FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["badges"];
		}
	}
};

$getItems = function ($id) use ($link) {
	$sql_query = "SELECT items FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["items"];
		}
	}
};

$getMembership = function ($id) use ($link) {
	$sql_query = "SELECT membership FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["membership"];
		}
	}
};

$isBanned = function ($id) use ($link) {
	include $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php";

	if ($getActiveInfraction($id) !== null)
	{
		if ($getInfractionType($getActiveInfraction($id)) === "Ban")
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	else
	{
		return 0;
	}
};

$isVerified = function ($id) use ($link) {
	$sql_query = "SELECT isVerified FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["isVerified"];
		}
	}
};

$getClans = function ($id) use ($link) {
	$sql_query = "SELECT clans FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["clans"];
		}
	}
};

$getRole = function ($id) use ($link) {
	$sql_query = "SELECT role FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["role"];
		}
	}
};

$getIcon = function ($id) use ($link) {
	$sql_query = "SELECT icon FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["icon"];
		}
	}
};

$getSecret = function ($id) use ($link) {
	$sql_query = "SELECT auth_secret FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["auth_secret"];
		}
	}
};

$getLastLogin = function ($id) use ($link) {
	$sql_query = "SELECT lastLogin FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["lastLogin"];
		}
	}
};

$getIdFromEmail = function ($email) use ($link) {
	$sql_query = "SELECT id FROM users WHERE email = '" . mysqli_real_escape_string($link, htmlspecialchars($email)) . "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["id"];
		}
	}
};

$getCurrencyFromId = function ($id) use ($link) {
	$sql_query = "SELECT currency FROM users WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)) . "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["currency"];
		}
	}
};

$getIdFromName = function ($email) use ($link) {
	$sql_query = "SELECT id FROM users WHERE username = '" . mysqli_real_escape_string($link, htmlspecialchars($email)) . "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["id"];
		}
	}
};

$setSecret = function ($id, $secret) use ($link) {
	$sql_query = "UPDATE users SET auth_secret='" . $secret . "' WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";

	if (mysqli_query($link, $sql_query)) {
		return true;
	} else {
		return false;
	}
};

$sendApplication = function ($id, $reason, $email, $full_name) use ($link) {
	$sql_query = "INSERT INTO applications (sender_id, preferred_email, reason, full_name) VALUES (" . mysqli_real_escape_string($link, htmlspecialchars($id)) . ", '" . mysqli_real_escape_string($link, htmlspecialchars($email)) . "', '" . mysqli_real_escape_string($link, htmlspecialchars($reason)) . "', '" . mysqli_real_escape_string($link, htmlspecialchars($full_name)) . "')";

	if (mysqli_query($link, $sql_query)) {
		return true;
	} else {
		return false;
	}
};

$getApplication = function ($id) use ($link) {
	$sql_query = "SELECT id FROM applications WHERE sender_id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["id"];
		}
	}
};

$getUserFromApplicationId = function ($id) use ($link) {
	$sql_query = "SELECT sender_id FROM applications WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["sender_id"];
		}
	}
};

$getApplicationReason = function ($id) use ($link) {
	$sql_query = "SELECT reason FROM applications WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["reason"];
		}
	}
};

$getApplicationEmail = function ($id) use ($link) {
	$sql_query = "SELECT preferred_email FROM applications WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["preferred_email"];
		}
	}
};

$getApplicationFullName = function ($id) use ($link) {
	$sql_query = "SELECT full_name FROM applications WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["full_name"];
		}
	}
};

$getApplicationSubmittedDate = function ($id) use ($link) {
	$sql_query = "SELECT submitted FROM applications WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["submitted"];
		}
	}
};

$getApplicationStatus = function ($id) use ($link) {
	$sql_query = "SELECT accepted FROM applications WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["accepted"];
		}
	}
};

$getApplicationDeniedReason = function ($id) use ($link) {
	$sql_query = "SELECT deniedReason FROM applications WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["deniedReason"];
		}
	}
};












