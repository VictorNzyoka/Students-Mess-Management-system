<?php
include 'accessToken.php';
include 'STKPUSH.php';
date_default_timezone_set('Africa/Nairobi');
$Query_url="https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query";
$pass_key="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$bussiness_short_code="174379";
$TimeSetup=date("YmdHis");
$password=base64_encode($bussiness_short_code.$pass_key.$TimeSetup);
$Query_header=['Content-Type:application/json', 'Authorization:Bearer ' .$access_token];
$CheckoutRequestID="ws_CO_26032023163350235113730593";

$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$Query_url);
curl_setopt($curl,CURLOPT_HTTPHEADER,$Query_header);//setting custom header

$curl_post_data=array(
    'BusinessShortCode' =>$bussiness_short_code ,
    'Password' => $password,
    'Timestamp' =>$TimeSetup,
    'CheckoutRequestID'=>$CheckoutRequestID

);

$data_string=json_encode($curl_post_data);
//echo    $data_string;

curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_POST,true);
curl_setopt($curl, CURLOPT_POSTFIELDS,$data_string);

$data_to=json_decode($curl_response);

if(isset($data_to->ResultCode)){
$ResultCode=$data_to->ResultCode;
if($ResultCode=='1037'){
    $message="Timeout in completing Transaction";
}else if($ResultCode=='1032'){
    $message="Transaction Cancelled";  
}
else if($ResultCode=='1'){
    $message="Top up your phone to complete these   transaction";  
}
else if($ResultCode=='1'){
    $message="TRANSACTION COMPLETE !";  
}
}
?>