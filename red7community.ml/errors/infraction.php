<?php
require $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/classes/Infractions.php";

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect them to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: ../login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}

$_id = $getActiveInfraction($_SESSION['id']);
$_type = $getInfractionType($_id);
$_reason = $getInfractionReason($_id);
$_start = $getInfractionStart($_id);
$_end = $getInfractionEnd($_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>You have been <?php if ($_type === "Ban") { echo "banned"; } else { echo "warned"; } ?> - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>
</head>

<body>
	<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/account/navbar.php" ?>
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
					if (d.success) {
						document.location = document.location;
					} else {
						document.location = document.location;
					}
				}
			});

			// return false so the form does not actually
			// submit to the page
			return false;
		}
	</script>

	<div class="page-content-wrapper">
		<main class="col-md-9">
			<div class="d-flex align-items-center border-bottom">
				<h2>You have been <?php if ($_type === "Ban") { echo "banned"; } else { echo "warned"; } ?></h2>
			</div>

			<p><b>You were <?php if ($_type === "Ban") { echo "banned"; } else { echo "warned"; } ?> on:</b> <?php echo $_start; ?></p>
			<?php if ($_type === "Ban") { echo '<p><b>You will be unbanned on:</b> '.$_end. '</p>'; } ?>
			<p><b>Reason:</b> <?php echo $_reason; ?></p>

			<p>If you wish to appeal, please email us at <b><a href="mailto:<?php echo $appealEmail ?>"><?php echo $appealEmail ?></a></b>.</p>

			<form method="post" action="/ajax/process.php" onSubmit="return ajaxSubmit(this);">
				<input hidden type="text" name="action" value="acceptInfraction" />
				<?php
					if ($_type === "Warning") {
						echo '<input class="btn btn-primary" type="submit" name="form_submit" value="I agree to the Terms Of Service"/>';
					} else {
						echo '<a class="btn btn-danger" href="/account/logout.php">Logout</a>';
					}
					?>
			</form>
	</div>
	</main>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://unpkg.com/@popperjs/core@2"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>