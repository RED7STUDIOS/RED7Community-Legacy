<?php
$getUsername = function($id) use ($link) {
	$sql_query = "SELECT username FROM users WHERE id = ". $id;
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["username"];
		}
	}
};

$getDisplayName = function($id) use ($link) {
	$sql_query = "SELECT displayname FROM users WHERE id = ". $id;
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["displayname"];
		}
	}
};

$getAdminName = function($id) use ($link) {
	$sql_query = "SELECT full_name FROM admin_panel WHERE ownerid = ". $id;
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["full_name"];
		}
	}
};

$getEmail = function($id) use ($link) {
	$sql_query = "SELECT email FROM users WHERE id = ". $id;
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["email"];
		}
	}
};

$getSecret = function($id) use ($link) {
	$sql_query = "SELECT auth_secret FROM users WHERE id = ". $id;
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["auth_secret"];
		}
	}
};

$getLastLogin = function($id) use ($link) {
	$sql_query = "SELECT lastLogin FROM users WHERE id = ". $id;
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["lastLogin"];
		}
	}
};

$getIdFromEmail = function($email) use ($link) {
	$sql_query = "SELECT id FROM users WHERE email = '". $email. "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["id"];
		}
	}
};

$setSecret = function($id, $secret) use ($link) {
	$sql_query = "UPDATE users SET auth_secret='". $secret."' WHERE id = ". $id;

	if (mysqli_query($link, $sql_query))
	{
		return true;
	}
	else
	{
		return false;
	}
};
?>