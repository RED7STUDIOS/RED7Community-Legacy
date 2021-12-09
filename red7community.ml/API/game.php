<?php
/*
  File Name: user.php
  Original Location: /API/user.php
  Description: User API to get details.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";

$response = array();

$api_type = $_GET['api'];

if (!empty($api_type)) {
	if ($api_type == 'getbyid') {
		if (!empty($_GET['id'])) {
			$id = $_GET['id'];

			if ($link) {
				$sql = "SELECT * FROM games WHERE id=" . $id;
				$result = mysqli_query($link, $sql);

				if ($result) {
					header("Content-Type: JSON");
					$i = 0;

					if ($result->num_rows == 0 || $result->num_rows == null) {
						header("Content-Type: JSON");

						$response[0]['code'] = '4';
						$response[0]['result'] = "This game doesn't exist or has been deleted.";

						echo json_encode($response, JSON_PRETTY_PRINT);
					} else {
						while ($row = mysqli_fetch_assoc($result)) {
							$response[$i]['data'][0]['id'] = $row['id'];
							$response[$i]['data'][0]['name'] = $row['name'];
							$response[$i]['data'][0]['displayname'] = $row['displayname'];
							$response[$i]['data'][0]['description'] = $row['description'];
							$response[$i]['data'][0]['created_at'] = $row['created_at'];
							$response[$i]['data'][0]['isDeleted'] = $row['isDeleted'];
							$response[$i]['data'][0]['isBanned'] = $row['isBanned'];
							$response[$i]['data'][0]['bannedReason'] = $row['banReason'];
							$response[$i]['data'][0]['bannedDate'] = $row['banDate'];
							$response[$i]['data'][0]['js'] = $row['javascript'];
							$response[$i]['data'][0]['icon'] = $row['icon'];
							$response[$i]['data'][0]['ownerid'] = $row['ownerid'];
						}

						echo json_encode($response, JSON_PRETTY_PRINT);
					}
				}
			}
		}
	} else if ($api_type == 'getbyname') {
		if (!empty($_GET['name'])) {
			$username = $_GET['name'];

			if ($link) {
				$sql = "SELECT * FROM games WHERE name='" . $name . "'";
				$result = mysqli_query($link, $sql);
				if ($result) {
					header("Content-Type: JSON");
					$i = 0;

					if ($result->num_rows == 0 || $result->num_rows == null) {
						header("Content-Type: JSON");

						$response[0]['code'] = '4';
						$response[0]['result'] = "This game doesn't exist or has been deleted.";

						echo json_encode($response, JSON_PRETTY_PRINT);
					} else {
						while ($row = mysqli_fetch_assoc($result)) {
							$response[$i]['data'][0]['id'] = $row['id'];
							$response[$i]['data'][0]['name'] = $row['name'];
							$response[$i]['data'][0]['displayname'] = $row['displayname'];
							$response[$i]['data'][0]['description'] = $row['description'];
							$response[$i]['data'][0]['created_at'] = $row['created_at'];
							$response[$i]['data'][0]['isDeleted'] = $row['isDeleted'];
							$response[$i]['data'][0]['isBanned'] = $row['isBanned'];
							$response[$i]['data'][0]['bannedReason'] = $row['banReason'];
							$response[$i]['data'][0]['bannedDate'] = $row['banDate'];
							$response[$i]['data'][0]['js'] = $row['javascript'];
							$response[$i]['data'][0]['icon'] = $row['icon'];
							$response[$i]['data'][0]['ownerid'] = $row['ownerid'];
						}

						echo json_encode($response, JSON_PRETTY_PRINT);
					}
				}
			}
		}
	}
}
?>