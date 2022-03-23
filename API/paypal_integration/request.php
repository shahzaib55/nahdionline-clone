<?php


use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

require 'config.php';
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: access");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT,DELETE');
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Set some example data for the payment.

$currency = 'USD';
session_start();

// $totalAmount = $_SESSION["bill"];
$amountPayable = 100;
$invoiceNumber = uniqid();

$amount = new Amount();
$amount->setCurrency($currency)
    ->setTotal($amountPayable);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setDescription('pay the Amount')
    ->setInvoiceNumber($invoiceNumber);

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl($paypalConfig['return_url'])
    ->setCancelUrl($paypalConfig['cancel_url']);

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);

try {
$payment->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $ex) {
echo $ex->getCode(); // Prints the Error Code
echo $ex->getData(); // Prints the detailed error message
die($ex);
} catch (Exception $ex) {
die($ex);
}

header('location:' . $payment->getApprovalLink());
exit(1);
