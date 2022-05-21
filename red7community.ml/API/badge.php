<?php
/*
  File Name: badge.php
  Original Location: /API/badge.php
  Description: Badge API to get details.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";

$response = array();

$api_type = $_GET['api'];

if (!empty($api_type)) {
	if ($api_type == 'getbyid') {
		if (!empty(htmlspecialchars($_GET['id']))) {
			$id = htmlspecialchars($_GET['id']);

			if ($link) {
				$sql = "SELECT * FROM badges WHERE id=" . $id;
				$result = mysqli_query($link, $sql);

				if ($result) {
					header("Content-Type: JSON");
					$i = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						$response[$i]['data'][0]['id'] = $row['id'];
						$response[$i]['data'][0]['name'] = $row['name'];
						$response[$i]['data'][0]['displayname'] = $row['displayname'];
						$response[$i]['data'][0]['description'] = $row['description'];
						$response[$i]['data'][0]['icon'] = $row['icon'];
					}

					echo json_encode($response, JSON_PRETTY_PRINT);
				}
			}
		}
	} else if ($api_type == 'getbyname') {
		if (!empty($_GET['name'])) {
			$name = $_GET['name'];

			if ($link) {
				$sql = "SELECT * FROM badges WHERE name='" . $name . "'";
				$result = mysqli_query($link, $sql);

				if ($result) {
					header("Content-Type: JSON");
					$i = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						$response[$i]['data'][0]['id'] = $row['id'];
						$response[$i]['data'][0]['name'] = $row['name'];
						$response[$i]['data'][0]['description'] = $row['description'];
						$response[$i]['data'][0]['icon'] = $row['icon'];
					}

					echo json_encode($response, JSON_PRETTY_PRINT);
				}
			}
		}
	}
}
