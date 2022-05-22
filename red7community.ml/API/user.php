<?php
/*
  File Name: user.php
  Original Location: /API/user.php
  Description: User API to get details.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";

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
							$response[$i]['data'][0]['id'] = $row['id'];
							$response[$i]['data'][0]['username'] = $row['username'];
							$response[$i]['data'][0]['displayname'] = $row['displayname'];
							$response[$i]['data'][0]['description'] = $row['description'];
							$response[$i]['data'][0]['created_at'] = $row['created_at'];
							$response[$i]['data'][0]['lastLogin'] = $row['lastLogin'];
							$response[$i]['data'][0]['lastLoginDate'] = $row['lastLoginDate'];
							$response[$i]['data'][0]['currency'] = $row['currency'];
							$response[$i]['data'][0]['badges'] = $row['badges'];
							$response[$i]['data'][0]['items'] = $row['items'];
							$response[$i]['data'][0]['membership'] = $row['membership'];
							$response[$i]['data'][0]['isBanned'] = $row['isBanned'];
							$response[$i]['data'][0]['bannedReason'] = $row['bannedReason'];
							$response[$i]['data'][0]['bannedDate'] = $row['bannedDate'];
							// WARNING: Please use the role API response value instead!
							// This API call may be deprecated in the next releases.
							if ($row['role'] >= 2) {
								$response[$i]['data'][0]['isAdmin'] = "1";
							} else {
								$response[$i]['data'][0]['isAdmin'] = "0";
							}

							if ($row['role'] > 2) {
								$response[$i]['data'][0]['isSuperAdmin'] = "1";
							} else {
								$response[$i]['data'][0]['isSuperAdmin'] = "0";
							}
							$response[$i]['data'][0]['isVerified'] = $row['isVerified'];
							$response[$i]['data'][0]['followers'] = $row['followers'];
							$response[$i]['data'][0]['following'] = $row['following'];
							$response[$i]['data'][0]['clans'] = $row['clans'];
							$response[$i]['data'][0]['icon'] = $row['icon'];
							$response[$i]['data'][0]['role'] = $row['role'];
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
							$response[$i]['data'][0]['id'] = $row['id'];
							$response[$i]['data'][0]['username'] = $row['username'];
							$response[$i]['data'][0]['displayname'] = $row['displayname'];
							$response[$i]['data'][0]['description'] = $row['description'];
							$response[$i]['data'][0]['created_at'] = $row['created_at'];
							$response[$i]['data'][0]['lastLogin'] = $row['lastLogin'];
							$response[$i]['data'][0]['lastLoginDate'] = $row['lastLoginDate'];
							$response[$i]['data'][0]['currency'] = $row['currency'];
							$response[$i]['data'][0]['badges'] = $row['badges'];
							$response[$i]['data'][0]['items'] = $row['items'];
							$response[$i]['data'][0]['membership'] = $row['membership'];
							$response[$i]['data'][0]['isBanned'] = $row['isBanned'];
							$response[$i]['data'][0]['bannedReason'] = $row['bannedReason'];
							$response[$i]['data'][0]['bannedDate'] = $row['bannedDate'];
							// WARNING: Please use the role API response value instead!
							// This API call may be deprecated in the next releases.
							if ($row['role'] >= 2) {
								$response[$i]['data'][0]['isAdmin'] = "1";
							} else {
								$response[$i]['data'][0]['isAdmin'] = "0";
							}

							if ($row['role'] > 2) {
								$response[$i]['data'][0]['isSuperAdmin'] = "1";
							} else {
								$response[$i]['data'][0]['isSuperAdmin'] = "0";
							}
							$response[$i]['data'][0]['isVerified'] = $row['isVerified'];
							$response[$i]['data'][0]['followers'] = $row['followers'];
							$response[$i]['data'][0]['following'] = $row['following'];
							$response[$i]['data'][0]['clans'] = $row['clans'];
							$response[$i]['data'][0]['icon'] = $row['icon'];
							$response[$i]['data'][0]['role'] = $row['role'];
						}

						echo json_encode($response, JSON_PRETTY_PRINT);
					}
				}
			}
		}
	}
}
