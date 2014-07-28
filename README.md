paysafecard_sdk
===============
Please note:
This is not the official SDK of the paysafecard AG

Usage
============

#### Create transaction
Load the SDK and Initiate a new payment
```php
include_once ('src/loader.php'); //load SDK
new Loader('payment');           //load sdk-classes for payment
$payment = new payment('test');  //new payment in testmode
```

Set parameter for transaction.
If you use any system like shop or CMS, you can set order_id or anything else in the url to the *mtid*. So you dosen´t need *currency* or *amount*
```php
$amount = '30.20';
$currency = 'EUR';
$mtid = 'psc_test' . rand(0, 9999999) . '_' . rand(0, 99999999);

$transaction = array(
 	'amount' => $amount,
 	'currency' => $currency,
 	'mtid' => $mtid,
 	'merchantClientId' => '3256',
 	'okUrl' => 'http://example.com/test.php?ok=1&mtid=' . $mtid .'&currency=' . $currency . '&amount=' . $amount,
 	'nokUrl' => 'http://example.com/test.php?nok',
 	'pnUrl' => 'http://example.com/test.php?pn=1&mtid=' . $mtid .'&currency=' . $currency . '&amount=' . $amount
);
```

Create transaction
```php
$result = $payment->newPayment($transaction);
```

If the transaction is successfully created, redirect the customers to pay.
```php
if (!$result)
 {
 	echo $payment->getCustomerInfo();
 }
 else
 {
 	echo '<a href="' . $result . '"> PAY NOW -> </a>';
 }
```

#### Execute debit

Once the customer has successfully completed the payment, he is forwarded to the **okUrl**.


Load the SDK and Initiate payment
```php
include_once ('src/loader.php');        //load SDK
new Loader('payment');                  //load sdk-classes for payment
$execute = new paymentExecute('test');  //new execute in testmode
```

Set the parameter. With a shopsystem, load the data (amount,currency) from database by mtid and order_id from GET
```php
$parameter = array(
 	'mtid' => $_GET['mtid'],        
 	'amount' => $_GET['amount'],
 	'currency' => $_GET['currency'],
 	'close' => '1');
```

Execute the payment
```php
if ($execute->execute($parameter))
 {
 	// useraccount topup -EXECUTE DEBIT SUCCESSFUL- Payment is completed
 }
 echo $execute->getCustomerInfo(); //show the message for the customer. On an error or success, always show this message.

```


#### Cancel payment by customer

If the customer clicked **Cancel** by paysafecard payment, you can redirect to new checkout or show a simple message.
The class **paymentCancel** dosen´t send anything to paysafecard. It´s just load the language and set a customer message.
```php
include_once ('src/loader.php');
 new Loader('payment');
 if (!isset($_GET['nok']))
 {
 	exit;
 }
 $cancel = new paymentCancel('en'); 
 echo $cancel->getCustomerInfo();

```
