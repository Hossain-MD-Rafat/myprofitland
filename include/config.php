<?php 
/* 
* PayPal and database configuration 
*/ 
// PayPal configuration 
define('PAYPAL_ID', 'miltonlo22@gmail.com'); 
define('PAYPAL_SANDBOX', FALSE); //TRUE or FALSE 
define('PAYPAL_RETURN_URL', 'http://exampleWebsite.com/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://exampleWebsite.com/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://exampleWebsite.com/ipn.php');
define('PAYPAL_CURRENCY', 'EUR'); 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
?>