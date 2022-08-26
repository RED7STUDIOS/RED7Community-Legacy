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
