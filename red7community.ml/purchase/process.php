<?php
/*
  File Name: process.php
  Original Location: /purchase/process.php
  Description: Process a payment.
  Author: Mitchell (BlxckSky_959)
  Copyright (C) RED7 STUDIOS 2021
*/

use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

include_once $_SERVER["DOCUMENT_ROOT"] . "/assets/common.php";

if (!isset($_SESSION)) {
    // Initialize the session
    session_start();
}

$allowGifts = "";

$your_data = file_get_contents($API_URL . '/user.php?api=getbyid&id=' . $_SESSION['id']);
$your_json_a = json_decode($your_data, true);
$your_currency = $your_json_a[0]['data'][0]['currency'];
$your_membership = $your_json_a[0]['data'][0]['membership'];

if ($_POST["giftUser"] == "" && empty($_POST["giftUser"])) {
    $user = $_SESSION['id'];
    $currencyAmount = $your_currency;
    $membership = $your_membership;
} else {
    $data = file_get_contents($API_URL . '/user.php?api=getbyname&name=' . $_POST["giftUser"]);

    $json_a = json_decode($data, true);

    $user = $json_a[0]['data'][0]['id'];
    $currencyAmount = $json_a[0]['data'][0]['currency'];
    $membership = $json_a[0]['data'][0]['membership'];
    $allowGifts = $json_a[0]['data'][0]['allowGifts'];
}

//check if stripe token exist to proceed with payment
if (!empty($_POST['stripeToken'])) {
    if ($allowGifts == 1 || $allowGifts == "" || $allowGifts == null) {
        // get token and user details
        $stripeToken = $_POST['stripeToken'];
        $custName = $_POST['custName'];
        $custEmail = $_POST['custEmail'];
        $cardNumber = $_POST['cardNumber'];
        $cardCVC = $_POST['cardCVC'];
        $cardExpMonth = $_POST['cardExpMonth'];
        $cardExpYear = $_POST['cardExpYear'];
        //include Stripe PHP library
        require_once('stripe-php/init.php');
        //set stripe secret key and publishable key
        $stripe = array(
            "secret_key" => "sk_test_51IhCSFHFvvpJx5JTNNYkrdLu3K5Hep0I80wxHc7XR4moFrbW2HfkkPOsT2jixqzXxIc6666SVC1UBIA0uzymfMib00tV9EajIP",
            "publishable_key" => "pk_test_51IhCSFHFvvpJx5JTi6JC0Gs3vfxkojvppb2T6qnGmMNQgufsGVbeDBGENKZTqaCGMtAijKSgWOealsXfKqzeJbQT00GgXO9hjO"
        );
        Stripe::setApiKey($stripe['secret_key']);
        //add customer to stripe
        $customer = Customer::create(array(
            'email' => $custEmail,
            'source' => $stripeToken
        ));
        // item details for which payment made
        $itemName = $_GET['nam'];
        $itemNumber = $_GET['num'];
        $itemPrice = $_GET['pri'];
        $currency = "AUD";
        $orderID = $_GET['oid'];
        // details for which payment performed
        $payDetails = Charge::create(array(
            'customer' => $customer->id,
            'amount' => $itemPrice,
            'currency' => $currency,
            'description' => $itemName,
            'metadata' => array(
                'order_id' => $orderID
            )
        ));
        // get payment details
        $paymenyResponse = $payDetails->jsonSerialize();
        // check whether the payment is successful
        if ($paymenyResponse['amount_refunded'] == 0 && empty($paymenyResponse['failure_code']) && $paymenyResponse['paid'] == 1 && $paymenyResponse['captured'] == 1) {
            // transaction details
            $amountPaid = $paymenyResponse['amount'];
            $balanceTransaction = $paymenyResponse['balance_transaction'];
            $paidCurrency = $paymenyResponse['currency'];
            $paymentStatus = $paymenyResponse['status'];
            $paymentDate = date("Y-m-d H:i:s");
            //insert tansaction details into database
            include_once("db_connect.php");
            $insertTransactionSQL = "INSERT INTO transaction(cust_name, cust_email, item_name, item_number, item_price, item_price_currency, paid_amount, paid_amount_currency, txn_id, payment_status, created, modified) 
			VALUES('" . $custName . "','" . $custEmail . "','" . $itemName . "','" . $itemNumber . "','" . $itemPrice . "','" . $paidCurrency . "','" . $amountPaid . "','" . $paidCurrency . "','" . $balanceTransaction . "','" . $paymentStatus . "','" . $paymentDate . "','" . $paymentDate . "')";
            mysqli_query($conn, $insertTransactionSQL) or die("database error: " . mysqli_error($conn));
            $lastInsertId = mysqli_insert_id($conn);

            include_once($_SERVER["DOCUMENT_ROOT"] . "/assets/config.php");

            if (!str_contains($_GET['nam'], "Premium")) {
                $sql = "UPDATE users SET currency = " . ($currencyAmount + $_GET["nam"]) . " WHERE id = " . $user;

                if (mysqli_query($link, $sql)) {

                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
            } else {
                $sql = "UPDATE users SET membership = '" . $_GET["nam"] . "' WHERE id = " . $user;

                if (mysqli_query($link, $sql)) {

                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($link);
                }
            }

            //if order inserted successfully
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
    header("location: login.php");
    exit;
}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Processed Purchase - <?php echo $site_name; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="/assets/css/paper-kit.css?v=2.2.0" rel="stylesheet"/>

    <script src="/assets/js/fontawesome.js"></script>

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
            <p>You found it challenger, here it is: (<b>MUFjMH</b>)</p>
            <?php echo $paymentMessage; ?>
            <a class="btn btn-primary" href="/currency.php">Go Back to Purchasing Page</a>
        </main>
    </div>
</div>
</body>
</html>