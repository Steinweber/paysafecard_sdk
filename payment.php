<?php

 include_once ('src/loader.php');
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
 	'okUrl' => 'http://188.194.170.38/test.php?ok=1&mtid=' . $mtid .'&currency=' . $currency . '&amount=' . $amount,
 	'nokUrl' => 'http://188.194.170.38/test.php?nok',
 	'pnUrl' => 'http://188.194.170.38/test.php?pn=1&mtid=' . $mtid .'&currency=' . $currency . '&amount=' . $amount,);
 $result = $payment->newPayment($transaction);
 if (!$result)
 {
 	echo $payment->getCustomerInfo();
 	echo '<br />' . $payment->getError();
 }
 else
 {
 	echo '<a href="' . $result . '"> Zum Bezahlen -> </a>';
 }
