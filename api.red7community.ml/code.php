<?php
	/*
	  File Name: catalog.php
	  Original Location: /API/catalog.php
	  Description: Catalog API to get details.
	  Author: Mitchell (Creaous)
	  Copyright (C) RED7 STUDIOS 2021
	*/

	include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";

	$response = array();

	$api_type = $_GET['api'];

	/* $sql = "SELECT * FROM apikeys WHERE api_key='". $api_key. "'";
	$result = mysqli_query($link, $sql);

	if (mysqli_num_rows($result) > 0) { */
	if (!empty($api_type)) {
		if ($api_type == 'getbyid') {
			if(!empty($_GET['id']))
			{
				$id = $_GET['id'];

				if ($link) {
					$sql = "SELECT * FROM codes WHERE id=". $id;
					$result = mysqli_query($link, $sql);

					if ($result) {
						header("Content-Type: JSON");
						$i = 0;

						if ($result->num_rows == 0 || $result->num_rows == null)
						{
							header("Content-Type: JSON");

							$response[0]['code'] = '3';
							$response[0]['result'] = "This item doesn't exist or has been deleted.";

							echo json_encode($response, JSON_PRETTY_PRINT);
						}
						else
						{
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
		else if ($api_type == 'getbycode') {
			if(!empty($_GET['code']))
			{
				$code = $_GET['code'];

				if ($link) {
					$sql = "SELECT * FROM codes WHERE code='". $code. "'";
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
	/*}
	else
	{
		header("Content-Type: JSON");
		$response[0]['code'] = '1';
		$response[0]['result'] = "Invalid Key";

		echo json_encode($response, JSON_PRETTY_PRINT);
	}*/

?>