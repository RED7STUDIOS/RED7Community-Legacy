<?php
/*
  File Name: process.php
  Original Location: /purchase/process.php
  Description: Process a payment.
  Author: Mitchell (Creaous)
  Copyright (C) RED7 STUDIOS 2022
*/

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/config.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

$allowGifts = "";

$your_data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . htmlspecialchars($_SESSION['id']));
$your_json = json_decode($your_data, true);
$your_currency = $your_json[0]['data'][0]['currency'];
$your_membership = $your_json[0]['data'][0]['membership'];

if ($_POST["giftUser"] == "" && empty($_POST["giftUser"])) {
	$user = htmlspecialchars($_SESSION['id']);
	$currencyAmount = $your_currency;
	$membership = $your_membership;
	$allowGifts = 1;
} else {
	$data = file_get_contents($API_URL . '/user.php?api=getbyname&name=' . $_POST["giftUser"]);

	$json = json_decode($data, true);

	$user = $json[0]['data'][0]['id'];
	$currencyAmount = $json[0]['data'][0]['currency'];
	$membership = $json[0]['data'][0]['membership'];
	$allowGifts = $json[0]['data'][0]['allowGifts'];
}

if (!empty($_POST['stripeToken'])) {
	if ($allowGifts == 1 || $allowGifts == "" || $allowGifts == null) {

		$stripeToken  = $_POST['stripeToken'];
		$custName = $_POST['custName'];
		$custEmail = $_POST['custEmail'];
		$cardNumber = $_POST['cardNumber'];
		$cardCVC = $_POST['cardCVC'];
		$cardExpMonth = $_POST['cardExpMonth'];
		$cardExpYear = $_POST['cardExpYear'];

		require_once('stripe-php/init.php');

		$stripe = array(
			"secret_key"      => $STRIPE_SECRET_KEY,
			"publishable_key" => $STRIPE_PUBLISHABLE_KEY
		);

		\Stripe\Stripe::setApiKey($stripe['secret_key']);

		$customer = \Stripe\Customer::create(array(
			'email' => $custEmail,
			'source'  => $stripeToken
		));

		$itemName = $_GET['nam'];
		$itemNumber = $_GET['num'];
		$itemPrice = $_GET['pri'];
		$currency = "AUD";
		$orderID = $_GET['oid'];

		$payDetails = \Stripe\Charge::create(array(
			'customer' => $customer->id,
			'amount'   => $itemPrice,
			'currency' => $currency,
			'description' => $itemName,
			'metadata' => array(
				'order_id' => $orderID
			)
		));
		$paymentResponse = $payDetails->jsonSerialize();
		if ($paymentResponse['amount_refunded'] == 0 && empty($paymentResponse['failure_code']) && $paymentResponse['paid'] == 1 && $paymentResponse['captured'] == 1) {
			$amountPaid = $paymentResponse['amount'];
			$balanceTransaction = $paymentResponse['balance_transaction'];
			$paidCurrency = $paymentResponse['currency'];
			$paymentStatus = $paymentResponse['status'];
			$paymentDate = date("Y-m-d H:i:s");
			$insertTransactionSQL = "INSERT INTO transactions(cust_name, cust_email, item_name, item_number, item_price, item_price_currency, paid_amount, paid_amount_currency, txn_id, payment_status, created, modified) 
			VALUES('" . $custName . "','" . $custEmail . "','" . $itemName . "','" . $itemNumber . "','" . $itemPrice . "','" . $paidCurrency . "','" . $amountPaid . "','" . $paidCurrency . "','" . $balanceTransaction . "','" . $paymentStatus . "','" . $paymentDate . "','" . $paymentDate . "')";
			mysqli_query($link, $insertTransactionSQL) or die("Database Error: " . mysqli_error($link));
			$lastInsertId = mysqli_insert_id($link);

			if (!str_contains($_GET['nam'], "Premium")) {
				$sql = "UPDATE users SET currency = " . ($currencyAmount + $_GET["nam"]) . " WHERE id = '" . $user. "'";

				if (mysqli_query($link, $sql)) {
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($link);
				}
			} else {
				$sql = "UPDATE users SET membership = '" . $_GET["nam"] . "' WHERE id = '" . $user. "'";

				if (mysqli_query($link, $sql)) {
				} else {
					echo "Error: " . $sql . "<br>" . mysqli_error($link);
				}
			}

			if ($lastInsertId && $paymentStatus == 'succeeded') {
				$paymentMessage = "<h3>The payment was successful.</h3><h4><strong> Order ID: " . $lastInsertId . "</strong></h4>";
			} else {
				$paymentMessage = "<h3>Payment failed!</h3>";
			}
		} else {
			$paymentMessage = "<h3>Payment failed due to a refund.</h3>";
		}
	} else {
		$paymentMessage = "<h3>This user doesn't allow gifts.</h3>";
	}
} else {
	$paymentMessage = "<h3>Payment failed due to invalid payment token.</h3>";
}

if (!isset($_SESSION)) {
	// Initialize the session
	session_start();
}

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: /login.php?u=" . $_SERVER["REQUEST_URI"]);
	exit;
}
?>

<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Processed Purchase - <?php echo htmlspecialchars($site_name); ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="/assets/css/style.css">

	<script defer src="/assets/js/fontawesome.js"></script>
	<script defer src="/assets/js/site.js"></script>

	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript" src="payment.js"></script>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/purchase/navbar.php" ?>

			<?php
			if (isset($maintenanceMode)) {
				if ($maintenanceMode == "on") {
					echo "<script type='text/javascript'>location.href = '/errors/maintenance.php';</script>";
				}
			}
			?>

			<main class="col-md-9">
				<?php echo $paymentMessage; ?>
				<a class="btn btn-primary" href="/currency.php">Go Back to Purchasing Page</a>
			</main>
		</div>
	</div>
</body>

</html>