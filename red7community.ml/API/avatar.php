<?php
/*
  File Name: avatar.php
  Original Location: /API/avatar.php
  Description: Avatar API to get details.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/config.php";

$response = array();

$api_key = $_GET['key'];

$api_type = $_GET['api'];

$sql = "SELECT * FROM apikeys WHERE api_key='". $api_key. "'";
$result = mysqli_query($link, $sql);

if (mysqli_num_rows($result) > 0) {
  if (!empty($api_type)) {
		if ($api_type == 'getbyid') {
			if(!empty($_GET['id']))
			{
				$id = $_GET['id'];

				if ($link) {
					$sql = "SELECT * FROM avatars WHERE ownerid=". $id;
					$result = mysqli_query($link, $sql);

					if ($result) {
						header("Content-Type: JSON");
						$i = 0;
						while ($row = mysqli_fetch_assoc($result)) {
							$response[$i]['data'][0]['ownerid'] = $row['ownerid'];
							$response[$i]['data'][0]['items'] = $row['items'];
							$response[$i]['data'][0]['shirt'] = $row['shirt'];
							$response[$i]['data'][0]['pants'] = $row['pants'];
							$response[$i]['data'][0]['face'] = $row['face'];
						}

						echo json_encode($response, JSON_PRETTY_PRINT);
					}
				}
			}
		}
	}
}
else
{
	header("Content-Type: JSON");
	$response[0]['code'] = '1';
	$response[0]['result'] = "Invalid Key";

	echo json_encode($response, JSON_PRETTY_PRINT);
}

?>