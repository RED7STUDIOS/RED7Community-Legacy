<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";

require($_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Site.php");
require($_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Users.php");
require($_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php");

$site_name = $site_name();
$currency_name = $currency_name();
$premiumIcon = $premiumIcon();
$verifiedIcon = $verifiedIcon();
$appealEmail = $appealEmail();
$maintenanceMode = $maintenanceMode();
$registration = $registration();
$version = $version();
$termsOfService = $termsOfService();
$privacyPolicy = $privacyPolicy();
$bannedWords = $bannedWords();

if ($CUSTOM_SESSION_LOCATION == true) {
	session_save_path($CSL_PATH);
}

function number_format_short($n)
{
	$n = (0 + str_replace(",", "", $n));
	if (!is_numeric($n)) return false;
	if ($n > 1000000000000) return round(($n / 1000000000000), 2) . 'T+';
	elseif ($n > 1000000000) return round(($n / 1000000000), 2) . 'B+';
	elseif ($n > 1000000) return round(($n / 1000000), 2) . 'M+';
	elseif ($n > 1000) return round(($n / 1000), 2) . 'K+';
	return number_format($n);
}

function number_format_comma($n)
{
	$english_format_number = number_format($n);
	return $english_format_number;
}

if (!function_exists('str_contains')) {
	function str_contains(string $haystack, string $needle): bool
	{
		return '' === $needle || false !== strpos($haystack, $needle);
	}
}

$sendEmail = function ($id, $url, $template, $fullName = "", $reason = "", $email = "", $internalEmail = false) use ($link, $SMTP_Debug, $SMTP_Auth, $SMTP_Secure, $SMTP_Port, $SMTP_Host, $SMTP_Username, $SMTP_Password, $SMTP_From) {

	if (!class_exists("PHPMailer")) {
		require($_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Mail/PHPMailer.php");
		require($_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Mail/SMTP.php");
		require($_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Users.php");
		require($_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Site.php");
		$mail = new PHPMailer\PHPMailer\PHPMailer();
	}

	$message = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/templates/emails/" . $template . ".html");

	if ($template == "verification-form" || $template == "verification-denied") {
		$message = str_replace('%full_name%', $fullName, $message);
		$message = str_replace('%reason%', $reason, $message);
		$message = str_replace('%email%', $email, $message);
	}

	$message = str_replace('%username%', $getDisplayName($id), $message);
	$message = str_replace('%realusername%', $getUsername($id), $message);
	$message = str_replace('%site_name%', $site_name(), $message);
	$message = str_replace('%url%', $url, $message);

	$title = preg_match("/<title>(.*)<\/title>/siU", $message, $title_matches);
	$title = preg_replace('/\s+/', ' ', $title_matches[1]);
	$title = trim($title);

	$mail->isSMTP();
	$mail->SMTPDebug  = $SMTP_Debug;
	$mail->SMTPAuth   = $SMTP_Auth;
	$mail->SMTPSecure = $SMTP_Secure;
	$mail->Port       = $SMTP_Port;
	$mail->Host       = $SMTP_Host;
	$mail->Username = $SMTP_Username;
	$mail->Password = $SMTP_Password;

	$mail->From = $SMTP_From;
	$mail->FromName = $site_name();

	if ($internalEmail == false) {
		$email_address = $getEmail($id);
	} else {
		$email_address = $SMTP_From;
	}

	$mail->addAddress($email_address, $getDisplayName($id));

	if ($template == "verification-accepted" || $template == "verification-denied") {
		if ($email != $email_address) {
			$mail->addAddress($email, $getDisplayName($id));
		}
	}

	$mail->WordWrap = 50;
	$mail->isHTML(true);

	$mail->Subject = $title;
	$mail->Body    = $message;

	if (!$mail->send()) {
	} else {
	}

	if ($template == "verification-form") {
		unset($mail);

		$mail = new PHPMailer\PHPMailer\PHPMailer();

		$message = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/templates/emails/verification-sent.html");

		$message = str_replace('%full_name%', $fullName, $message);
		$message = str_replace('%reason%', $reason, $message);
		$message = str_replace('%email%', $email, $message);
		$message = str_replace('%username%', $getDisplayName($id), $message);
		$message = str_replace('%realusername%', $getUsername($id), $message);
		$message = str_replace('%site_name%', $site_name(), $message);
		$message = str_replace('%url%', $url, $message);

		$title = preg_match("/<title>(.*)<\/title>/siU", $message, $title_matches);
		$title = preg_replace('/\s+/', ' ', $title_matches[1]);
		$title = trim($title);

		$mail->isSMTP();
		$mail->SMTPDebug  = $SMTP_Debug;
		$mail->SMTPAuth   = $SMTP_Auth;
		$mail->SMTPSecure = $SMTP_Secure;
		$mail->Port       = $SMTP_Port;
		$mail->Host       = $SMTP_Host;
		$mail->Username = $SMTP_Username;
		$mail->Password = $SMTP_Password;

		$mail->From = $SMTP_From;
		$mail->FromName = $site_name();

		$email_address = $getEmail($id);

		$mail->addAddress($email_address, $getDisplayName($id));

		$mail->WordWrap = 50;
		$mail->isHTML(true);

		$mail->Subject = $title;
		$mail->Body    = $message;

		if (!$mail->send()) {
		} else {
		}
	}
};

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Users.php";

// Filter certain words out.
// Usage: filterwords("blah blah");
$filterwords = function ($text) use ($bannedWords) {
	$filterWords = json_decode($bannedWords, true);
	$filterCount = sizeof($filterWords);
	for ($i = 0; $i < $filterCount; $i++) {
		$text = preg_replace_callback('/\b' . $filterWords[$i] . '\b/i', function ($matches) {
			return str_repeat('#', strlen($matches[0]));
		}, $text);
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

function get_gravatar($email, $s = 80, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
	$url = 'https://www.gravatar.com/avatar/';
	$url .= md5(strtolower(trim($email)));
	$url .= "?s=$s&d=$d&r=$r";
	if ($img) {
		$url = '<img src="' . $url . '"';
		foreach ($atts as $key => $val)
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}
