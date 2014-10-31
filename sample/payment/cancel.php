<?php

 include_once('../../src/loader.php');
 new Loader('payment');
 if (!isset($_GET['nok']))
 {
 	exit;
 }
 $cancel = new paymentCancel(); //wird normal nicht verwendet, da der Kunde auf den Checkout geleitet wird
 echo $cancel->getCustomerInfo();
