<?php
	/*
	  File Name: home.php
	  Original Location: /home.php
	  Description: The main home page.
	  Author: Mitchell (BlxckSky_959)
	  Copyright (C) RED7 STUDIOS 2021
	*/

	include_once $_SERVER["DOCUMENT_ROOT"]. "/assets/common.php";

	if(!isset($_SESSION)){
		// Initialize the session
		session_start();
	}

	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home - <?php echo $admin_site_name; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

	<link rel="stylesheet" href="/assets/css/style.css">

	<link rel="stylesheet" href="/assets/css/sidebar.css">

	<script src="/assets/js/fontawesome.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/markdown-it@12.2.0/index.min.js"></script>
</head>
<body>
<?php
	if (isset($your_isBanned))
	{
		if ($your_isBanned == 1) {
			echo "<script type='text/javascript'>location.href = '" . $ROOT_URL . "/errors/banned.php';</script>";
		}
	}
?>

<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>

<div class="page-content-wrapper">
    <script type="text/javascript">
        var ajaxSubmit = function(formEl) {
            // fetch the data for the form
            var data = $(formEl).serializeArray();
            var url = $(formEl).attr('action');

            // setup the ajax request
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                success: function(d) {
                    if (d.success)
                    {
                        alert('Changed values successfully!');
                        document.location = document.location;
                    }
                }
            });

            // return false so the form does not actually
            // submit to the page
            return false;
        }
    </script>
	<div class="d-flex align-items-center border-bottom">
		<h2>
            Site Settings
		</h2>
	</div>

    <form method="post" action="/moderate/ajax.php"
          onSubmit="return ajaxSubmit(this);">
        <label><b>Site Name:</b></label>
        <input type="text" name="site_name" value="<?php $sql = "SELECT content FROM site_info WHERE name='site_name'";
	        $result = mysqli_query($link, $sql);
	        if (mysqli_num_rows($result) > 0) {
		        while ($row = mysqli_fetch_assoc($result)) {
			        echo $row['content'];
		        }
	        } ?>" />
        <br>
        <label><b>Registration:</b></label>
        <input type="checkbox" name="registration" <?php if ($registration == "on") { echo 'checked'; } ?> />
        <br>
        <label><b>Currency:</b></label>
        <input type="text" name="currency" value="<?php $sql = "SELECT content FROM site_info WHERE name='currency'";
		    $result = mysqli_query($link, $sql);
		    if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
				    echo $row['content'];
			    }
		    } ?>" />
        <br>
        <label><b>Premium Icon:</b></label>
        <input type="text" name="premiumIcon" value="<?php $sql = "SELECT content FROM site_info WHERE name='premiumIcon'";
		    $result = mysqli_query($link, $sql);
		    if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
				    echo $row['content'];
			    }
		    } ?>" />
        <br>
        <label><b>Verified Icon:</b></label>
        <input type="text" name="verifiedIcon" value="<?php $sql = "SELECT content FROM site_info WHERE name='verifiedIcon'";
		    $result = mysqli_query($link, $sql);
		    if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
				    echo $row['content'];
			    }
		    } ?>"/>
        <br>
        <label><b>Appeal Email:</b></label>
        <input type="text" name="appealEmail" value="<?php $sql = "SELECT content FROM site_info WHERE name='appealEmail'";
		    $result = mysqli_query($link, $sql);
		    if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
				    echo $row['content'];
			    }
		    } ?>"/>
        <br>
        <label><b>Maintenance Mode:</b></label>
        <input type="checkbox" name="maintenance" <?php if ($maintenanceMode == "on") { echo 'checked'; } ?> />
        <br>
        <label><b>Admin Site Name:</b></label>
        <input type="text" name="admin_site_name" value="<?php $sql = "SELECT content FROM site_info WHERE name='admin_site_name'";
		    $result = mysqli_query($link, $sql);
		    if (mysqli_num_rows($result) > 0) {
			    while ($row = mysqli_fetch_assoc($result)) {
				    echo $row['content'];
			    }
		    } ?>"/>
        <input hidden type="text" name="action" value="updateSiteSettings"/>
        <br>
        <input class="btn btn-success" type="submit" name="form_submit" value="Change"/>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>