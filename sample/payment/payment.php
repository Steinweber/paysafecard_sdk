<?php

 include_once('../../src/loader.php');
 new Loader('payment');
 $amount = '30.20';
 $currency = 'EUR';
 $mtid = 'psc_test' . rand(0, 9999999) . '_' . rand(0, 99999999);
 $payment = new payment('test');
 $transaction = array(
 	'amount' => $amount,
 	'currency' => $currency,
 	'mtid' => $mtid,
 	'merchantClientId' => '3256',
     'okUrl' => DOMAIN.'payment/_onefile.php?ok=1&mtid=' . $mtid,
     'nokUrl' => DOMAIN.'payment/_onefile.php?nok',
     'pnUrl' => DOMAIN.'payment/_onefile.php?pn=1&mtid=' . $mtid);
 $result = $payment->newPayment($transaction);
 if (!$result)
 {
 	echo $payment->getCustomerInfo();
 }
 else
 {
 	echo '<a href="' . $result . '"> Zum Bezahlen -> </a>';
 }
