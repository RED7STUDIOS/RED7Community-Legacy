<?php
/*
  File Name: common.php
  Original Location: /assets/common.php
  Description: Functions that are common.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

// Include the configuration file.
include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";

// For custom session saving.
if ($CUSTOM_SESSION_LOCATION == true) {
	session_save_path($CSL_PATH);
}

// Shorten down numbers to make them look nicer :)
// Usage: number_format_short(1000000);
function number_format_short($n) {
	// first strip any formatting;
	$n = (0+str_replace(",", "", $n));
	// is this a number?
	if (!is_numeric($n)) return false;
	 // now filter it;
	if ($n > 1000000000000) return round(($n/1000000000000), 2).'T+';
	elseif ($n > 1000000000) return round(($n/1000000000), 2).'B+';
	elseif ($n > 1000000) return round(($n/1000000), 2).'M+';
	elseif ($n > 1000) return round(($n/1000), 2).'K+';

	return number_format($n);
}

// Add commas to big numbers to look nicer.
// Usage: number_format_comma(1000000);
function number_format_comma($n) {
	$english_format_number = number_format($n);
	return $english_format_number;
}

// Add the str_contains function.
// Usage: str_contains("test", "test");
if (!function_exists('str_contains')) {
	function str_contains(string $haystack, string $needle): bool
	{
		return '' === $needle || false !== strpos($haystack, $needle);
	}
}

/*
 *
 * SQL QUERIES FOR SETTINGS
 *
 */

function resetSQLVariables() {
    $_id = "";
    $_name = "";
    $_content = "";
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'site_name'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$site_name = $row["content"];
	}
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'currency'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$currency_name = $row["content"];
	}
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'premiumIcon'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$premiumIcon = $row["content"];
	}
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'verifiedIcon'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$verifiedIcon = $row["content"];
	}
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'appealEmail'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$appealEmail = $row["content"];
	}
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'maintenanceMode'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$maintenanceMode = $row["content"];
	}
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'registration'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $registration = $row["content"];
    }
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'version'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
	// output data of each row
	while($row = mysqli_fetch_assoc($result)) {
		$version = $row["content"];
	}
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'termsOfService'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $termsOfService = $row["content"];
    }
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'privacyPolicy'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $privacyPolicy = $row["content"];
    }
}

$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'bannedWords'";
$result = mysqli_query($link, $sql_query);

resetSQLVariables();

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        $bannedWords = $row["content"];
    }
}

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

// Filter certain words out.
// Usage: filterwords("blah blah");
$filterwords = function($text) use ($bannedWords) {
	$filterWords = json_decode($bannedWords, true);
	$filterCount = sizeof($filterWords);
	for ($i = 0; $i < $filterCount; $i++) {
		$text = preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function($matches){return str_repeat('#', strlen($matches[0]));}, $text);
	}
	return $text;
};

/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mp | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */

 // THIS IS A TEMPORARY FIX
error_reporting(E_ALL ^ E_DEPRECATED);

function get_gravatar( $email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}
?>