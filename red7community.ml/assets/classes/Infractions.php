<?php
$getActiveInfraction = function ($id) use ($link) {
	$sql_query = "SELECT id FROM infractions WHERE active = 1 AND user_id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["id"];
		}
	}
};

$getInfractionType = function ($id) use ($link) {
	$sql_query = "SELECT type FROM infractions WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["type"];
		}
	}
};

$getInfractionReason = function ($id) use ($link) {
	$sql_query = "SELECT reason FROM infractions WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["reason"];
		}
	}
};

$getInfractionStart = function ($id) use ($link) {
	$sql_query = "SELECT start FROM infractions WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["start"];
		}
	}
};

$getInfractionEnd = function ($id) use ($link) {
	$sql_query = "SELECT end FROM infractions WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["end"];
		}
	}
};

$getInfractionIssuer = function ($id) use ($link) {
	$sql_query = "SELECT issued_by FROM infractions WHERE id = '" . mysqli_real_escape_string($link, htmlspecialchars($id)). "'";
	$result = mysqli_query($link, $sql_query);

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["issued_by"];
		}
	}
};