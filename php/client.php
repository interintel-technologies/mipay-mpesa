<?php
require 'utils/security.php';
require 'utils/request.php';

define("API_KEY","<<API_KEY>>");
define("USERNAME","<<USERNAME>>");
define("PASSWORD","<<PASSWORD>>");

function send_money($msisdn,$amount,$payment_method,$transid="", $schedule="", $institution_id, $product_id){
        $payload = init_payload();
        $credentials = array();
        $credentials['username'] = USERNAME;
        $credentials['password'] = PASSWORD;
        $payload["credentials"] = $credentials;
        $payload["account_number"] = $msisdn;
        $payload["amount"] = $amount;
        $payload["currency"] = 'KES';
        $payload["institution_id"] = $institution_id;
	$payload['product_item_id'] = $product_id;
        $payload["payment_method"] = $payment_method; //Payment M-PESA|MIPAY
        $payload["ext_outbound_id"] = $transid;
        $payload["scheduled_send"] = $schedule; // d/m/Y H:M (am/pm)
        print_r($payload);
        print "|||||||||||||||||||||||||||||||||";
        $payload = security($payload, API_KEY);
        print_r($payload);
        print "|||||||||||||||||||||||||||||||||";
        return request($payload, 'REMIT');
}

//*************************SEND MONEY*****************************
//TRANSACTION_ID|SCHEDULED_SEND are optional
//A transaction can be referenced using the reference number number which is part of the result or the optional transaction id if was part of the request
//INSTITUTION ID and PRODUCT ID will be gotten from your account details
$result = send_money("+2547XXXXXXXX","10","M-PESA","MYTRANSID","17/09/2016 6:31 am","MYINSTID","PRODUCTID(B2B|B2C)");

$payload = (array) json_decode($result);
print_r($payload);
//**********************************************************************

?>

