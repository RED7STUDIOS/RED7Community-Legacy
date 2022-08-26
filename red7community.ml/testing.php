<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
	session_start();
}

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}

$data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . htmlspecialchars($_SESSION['id']));

if (!str_contains($data, "This user doesn't exist or has been deleted")) {
    $json = json_decode($data, true);

    $role = $json[0]['data'][0]['role'];
}

if (!$role >= 2) {
    header("HTTP/1.1 403 Forbidden");
    exit;
}
?>


<!-- Hello -->


<?php

// Decided to move to MySQL table instead :P



?>