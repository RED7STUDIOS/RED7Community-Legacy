<?php
$site_name = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'site_name'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$currency_name = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'currency'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$premiumIcon = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'premiumIcon'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$verifiedIcon = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'verifiedIcon'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$appealEmail = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'appealEmail'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$maintenanceMode = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'maintenanceMode'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$registration = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'registration'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$version = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'version'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$termsOfService = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'termsOfService'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$privacyPolicy = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'privacyPolicy'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};

$bannedWords = function () use ($link) {
	$sql_query = "SELECT content FROM site_info WHERE name = 'bannedWords'";
	$result = mysqli_query($link, $sql_query);
	
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
};