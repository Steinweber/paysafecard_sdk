<?php

 include_once ('src/loader.php');
 new Loader('payment');
 if (!isset($_GET['ok']) and !isset($_GET['pn']))
 {
 	exit;
 }
 $execute = new paymentExecute();
 $parameter = array(
 	'mtid' => $_GET['mtid'],
 	'amount' => $_GET['amount'],
 	'currency' => $_GET['currency'],
 	'close' => '1');
 if ($execute->execute($parameter))
 {
 	// hier den useraccount topup -EXECUTE DEBIT SUCCESSFUL- !!!
 }
 echo $execute->getCustomerInfo();
 echo '<br />' . $execute->getError();
