<?php

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

require '../vendor/autoload.php';

// For test payments we want to enable the sandbox mode. If you want to put live
// payments through then this setting needs changing to `false`.
$enableSandbox = true;

// PayPal settings. Change these to your account details and the relevant URLs
// for your site.
$paypalConfig = [
    'client_id' => 'AcoYP-l9EAe-YzmABUMCUbpINMa16uS_1L6qliZqHEEFCkfOek8NKXSqsSodMPmqNonyitbmryfAruRk',
    'client_secret' => 'ENUXnnWd5P24RGIsxyOYxfLDS7E9AmExD4CzwfDqIX6HH2ZJ188SP9hjfnGvfi0iiRKj7oIMQeuwa6D8',
    'return_url' => 'https://beautypredictor.000webhostapp.com/API/paypal_integration/response.php',
    'cancel_url' => 'https://beautypredictor.000webhostapp.com/API/paypal_integration/cancel.php'
];

;


// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'remotemysql.com:3306',
    'username' => 'z6wrFpPwtG',
    'password' => '9grwvrCf1m',
    'name' => 'z6wrFpPwtG'
];

$apiContext = getApiContext($paypalConfig['client_id'], $paypalConfig['client_secret'], $enableSandbox);

/**
 * Set up a connection to the API
 *
 * @param string $clientId
 * @param string $clientSecret
 * @param bool   $enableSandbox Sandbox mode toggle, true for test payments
 * @return \PayPal\Rest\ApiContext
 */
function getApiContext($clientId, $clientSecret, $enableSandbox = false)
{
    $apiContext = new ApiContext(
        new OAuthTokenCredential($clientId, $clientSecret)
    );

    $apiContext->setConfig([
        'mode' => $enableSandbox ? 'sandbox' : 'live'
    ]);

    return $apiContext;
}
