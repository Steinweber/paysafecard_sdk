<?php
 include_once ('src/loader.php');
 $amount = '30.20';
 $currency = 'EUR';
 $mtid = 'psc_test' . rand(0, 9999999) . '_' . rand(0, 99999999);
new Loader('payment');
 if (isset($_GET['ok']) or isset($_GET['pn'])) //execute payment
 {
 	$execute = new paymentExecute();
    $parameter = array(
        'mtid' => $_GET['mtid'],
        'amount' => $amount,
        'currency' => $currency,
        'close' => '1'
    );
 	if($execute->execute($parameter))
    {
        // hier den useraccount topup -EXECUTE DEBIT SUCCESSFUL- !!!
    }
    echo $execute->getCustomerInfo();
    echo '<br />'.$execute->getError();
 }
 elseif(isset($_GET['nok']))// canceled paymend
 {
    $cancel = new paymentCancel(); //wird normal nicht verwendet, da der Kunde auf den Checkout geleitet wird
    echo $cancel->getCustomerInfo();
 }
 else//new Payment
 {
 	$payment = new payment('test');
 	$transaction = array(
 		'amount' => $amount,
 		'currency' => $currency,
 		'mtid' => $mtid,
 		'merchantClientId' => '3256',
 		'okUrl' => 'http://example.com/_onefile.php?ok=1&mtid=' . $mtid,
 		'nokUrl' => 'http://example.com/_onefile.php?nok',
 		'pnUrl' => 'http://example.com/_onefile.php?pn=1&mtid=' . $mtid);
 	$result = $payment->newPayment($transaction);
 	if (!$result)
 	{
 		echo $payment->getCustomerInfo();
        echo '<br />'.$payment->getError();
 	}
 	else
 	{
 		echo '<a href="' . $result . '"> Zum Bezahlen -> </a>';
 	}
 }

