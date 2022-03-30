<?php

session_start();
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

require 'config.php';
require_once '../config/database.php';


$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Set some example data for the payment.

$currency = 'USD';


$totalAmount = $_GET["bill"];
$amountPayable = $totalAmount;
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
