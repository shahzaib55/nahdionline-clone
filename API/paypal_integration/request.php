<?php
//include connection file
require_once '../config/database.php';
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

require 'config.php';



$payer = new Payer();
$payer->setPaymentMethod('paypal');

// Set some example data for the payment.

$currency = 'USD';
session_start();

$totalAmount = $_SESSION["bill"];
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
} catch (Exception $e) {
    throw new Exception('Unable to create link for payment');
}

header('location:' . $payment->getApprovalLink());
exit(1);
