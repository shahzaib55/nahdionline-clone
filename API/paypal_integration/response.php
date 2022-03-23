<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require 'config.php';

if (empty($_GET['paymentId']) || empty($_GET['PayerID'])) {
    throw new Exception('The response is missing the paymentId and PayerID');
    
}
else{ 
  
$paymentId = $_GET['paymentId'];
$payment = Payment::get($paymentId, $apiContext);

$execution = new PaymentExecution();
$execution->setPayerId($_GET['PayerID']);

try {
    // Take the payment
    $payment->execute($execution, $apiContext);

    try {
       
        $payment = Payment::get($paymentId, $apiContext);

        $data = [
           
            'payment_status' => $payment->getState(),
           
        ];
        
        if ($data['payment_status'] === 'approved') {
            // Payment successfully added, redirect to the payment complete page.
            header('Location: https://quiet-caverns-02461.herokuapp.com/paypal_integration/success.php');
            exit(1);
        } else {
            // Payment failed

        }

    } catch (Exception $e) {
        // Failed to retrieve payment from PayPal

    }

} catch (Exception $e) {
    // Failed to take payment

}
}


