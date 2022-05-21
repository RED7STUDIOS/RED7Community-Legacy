<?php
$site_name = function() use ($link) {
	$sql_query = "SELECT id, name, content FROM site_info WHERE name = 'site_name'";
	$result = mysqli_query($link, $sql_query);

	resetSQLVariables();

	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			return $row["content"];
		}
	}
}
?>