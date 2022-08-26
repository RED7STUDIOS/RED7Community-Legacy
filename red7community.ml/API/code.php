<?php
/*
	  File Name: item.php
	  Original Location: /API/item.php
	  Description: Shop API to get details.
	  Author: Mitchell (Creaous)
	  Copyright (C) RED7 STUDIOS 2022
	*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";

$response = array();

$api_type = $_GET['api'];

if (!empty($api_type)) {
	if ($api_type == 'getbyid') {
		if (!empty(htmlspecialchars($_GET['id']))) {
			$id = htmlspecialchars($_GET['id']);

			if ($link) {
				$sql = "SELECT * FROM codes WHERE id=" . $id;
				$result = mysqli_query($link, $sql);

				if ($result) {
					header("Content-Type: JSON");
					$i = 0;

					if ($result->num_rows == 0 || $result->num_rows == null) {
						header("Content-Type: JSON");

						$response[0]['code'] = '3';
						$response[0]['result'] = "This item doesn't exist or has been deleted.";

						echo json_encode($response, JSON_PRETTY_PRINT);
					} else {
						while ($row = mysqli_fetch_assoc($result)) {
							$response[$i]['data'][0]['id'] = $row['id'];
							$response[$i]['data'][0]['name'] = $row['name'];
							$response[$i]['data'][0]['code'] = $row['code'];
							$response[$i]['data'][0]['currency'] = $row['currency'];
							$response[$i]['data'][0]['items'] = $row['items'];
						}

						echo json_encode($response, JSON_PRETTY_PRINT);
					}
				}
			}
		}
	} else if ($api_type == 'getbycode') {
		if (!empty($_GET['code'])) {
			$code = $_GET['code'];

			if ($link) {
				$sql = "SELECT * FROM codes WHERE code='" . $code . "'";
				$result = mysqli_query($link, $sql);

				if ($result) {
					header("Content-Type: JSON");
					$i = 0;
					while ($row = mysqli_fetch_assoc($result)) {
						$response[$i]['data'][0]['id'] = $row['id'];
						$response[$i]['data'][0]['name'] = $row['name'];
						$response[$i]['data'][0]['code'] = $row['code'];
						$response[$i]['data'][0]['currency'] = $row['currency'];
						$response[$i]['data'][0]['items'] = $row['items'];
					}

					echo json_encode($response, JSON_PRETTY_PRINT);
				}
			}
		}
	}
}
