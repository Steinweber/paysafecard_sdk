<?php
include_once('../../src/loader.php');
new Loader('payout');
$payout = new payout('test');

$amount = '30.20';
$currency = 'EUR';
$ptid = 'psc_payout' . rand(0, 9999999) . '_' . rand(0, 99999999);


$transaction = array(
    //payout details
    'amount' => $amount,
    'currency' => $currency,
    'ptid' => $ptid,
    'utcOffset' => '+01:00',
    //paysafecardCustomerAccount details
    'customerIdType' => 'E-MAIL',
    'customerId' => 'customer@example.com',
    'merchantClientId' => '3256',
    'customerDetailsBasic' => array(
        'firstName' => 'Max',
        'lastName'  => 'Mustermann',
        'dateOfBirth' => '24.04.1998'
    ),
    'ValidationOnly' => true,
    );

//start payout