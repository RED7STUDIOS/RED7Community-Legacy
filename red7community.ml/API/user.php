<?php
/*
  File Name: user.php
  Original Location: /API/user.php
  Description: User API to get details.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Users.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php";

$response = array();

$api_type = $_GET['api'];

if (!empty($api_type)) {
	if ($api_type == 'getbyid') {
		if (!empty(htmlspecialchars($_GET['id']))) {
			$id = htmlspecialchars($_GET['id']);

			if ($link) {
				$sql = "SELECT * FROM users WHERE id=" . $id;
				$result = mysqli_query($link, $sql);

				if ($result) {
					header("Content-Type: JSON");
					$i = 0;

					if ($result->num_rows == 0 || $result->num_rows == null) {
						header("Content-Type: JSON");

						$response[0]['code'] = '2';
						$response[0]['result'] = "This user doesn't exist or has been deleted.";

						echo json_encode($response, JSON_PRETTY_PRINT);
					} else {
						while ($row = mysqli_fetch_assoc($result)) {
							/* $_id = $getActiveInfraction($_GET['id']);
							$_type = $getInfractionType($_id);
							$_hasInfraction = 0;

							if ($_type === "Ban") {
								$_hasInfraction = 1;
							}

							$response[$i]['data'][0]['id'] = $row['id'];
							$response[$i]['data'][0]['username'] = $row['username'];
							$response[$i]['data'][0]['displayname'] = $row['displayname'];
							$response[$i]['data'][0]['description'] = $row['description'];
							$response[$i]['data'][0]['created_at'] = $row['created_at'];
							$response[$i]['data'][0]['lastLogin'] = $row['lastLogin'];
							$response[$i]['data'][0]['lastLoginDate'] = $row['lastLoginDate'];
							$response[$i]['data'][0]['badges'] = $row['badges'];
							$response[$i]['data'][0]['items'] = $row['items'];
							$response[$i]['data'][0]['membership'] = $row['membership'];
							$response[$i]['data'][0]['hasInfraction'] = $_hasInfraction;
							$response[$i]['data'][0]['isVerified'] = $row['isVerified'];
							$response[$i]['data'][0]['followers'] = $row['followers'];
							$response[$i]['data'][0]['following'] = $row['following'];
							$response[$i]['data'][0]['clans'] = $row['clans'];
							$response[$i]['data'][0]['icon'] = $row['icon'];
							$response[$i]['data'][0]['role'] = $row['role']; */
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
				$sql = "SELECT * FROM users WHERE username='" . $username . "'";
				$result = mysqli_query($link, $sql);
				if ($result) {
					header("Content-Type: JSON");
					$i = 0;

					if ($result->num_rows == 0 || $result->num_rows == null) {
						header("Content-Type: JSON");

						$response[0]['code'] = '2';
						$response[0]['result'] = "This user doesn't exist or has been deleted.";

						echo json_encode($response, JSON_PRETTY_PRINT);
					} else {
						while ($row = mysqli_fetch_assoc($result)) {
							/* $_id = $getActiveInfraction($getIdFromName($_GET['name']));
							$_type = $getInfractionType($_id);
							$_hasInfraction = 0;

							if ($_type === "Ban") {
								$_hasInfraction = 1;
							}

							$response[$i]['data'][0]['id'] = $row['id'];
							$response[$i]['data'][0]['username'] = $row['username'];
							$response[$i]['data'][0]['displayname'] = $row['displayname'];
							$response[$i]['data'][0]['description'] = $row['description'];
							$response[$i]['data'][0]['created_at'] = $row['created_at'];
							$response[$i]['data'][0]['lastLogin'] = $row['lastLogin'];
							$response[$i]['data'][0]['lastLoginDate'] = $row['lastLoginDate'];
							$response[$i]['data'][0]['badges'] = $row['badges'];
							$response[$i]['data'][0]['items'] = $row['items'];
							$response[$i]['data'][0]['membership'] = $row['membership'];
							$response[$i]['data'][0]['hasInfraction'] = $_hasInfraction;
							$response[$i]['data'][0]['isVerified'] = $row['isVerified'];
							$response[$i]['data'][0]['followers'] = $row['followers'];
							$response[$i]['data'][0]['following'] = $row['following'];
							$response[$i]['data'][0]['clans'] = $row['clans'];
							$response[$i]['data'][0]['icon'] = $row['icon'];
							$response[$i]['data'][0]['role'] = $row['role']; */
						}

						echo json_encode($response, JSON_PRETTY_PRINT);
					}
				}
			}
		}
	}
}
