<?php
//MPESA EXPRESS
//STK PUSH

include 'accessToken.php';

date_default_timezone_set('Africa/Nairobi');
$proccessRequestUrl='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackUrl="https://drive.google.com/drive/folders/1vSYlciRi_fx-8xxqe0lYtCXbaJcNNlSg";
$pass_key="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$bussiness_short_code="174379";
$TimeSetup=date("YmdHis");
$password=base64_encode($bussiness_short_code.$pass_key.$TimeSetup);
$phone=$_POST['phone'];

$amount=$_POST['amount'];
$partyA=$phone;
$partyB='254113730593';
$AccountRefference='DEDAN KIMATHI STUDENT MESS';
$TransactionDesc='"dekutmess';
$Stk_push_header=['Content-Type:application/json', 'Authorization:Bearer ' .$access_token];
$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$proccessRequestUrl);
curl_setopt($curl,CURLOPT_HTTPHEADER,$Stk_push_header);//setting custom header

$curl_post_data=array(
    //fill all the records properly
    'BusinessShortCode' =>$bussiness_short_code ,
    'Password' => $password,
    'Timestamp' =>$TimeSetup,
    'TransactionType' =>'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $partyA,
    'PartyB' =>$bussiness_short_code ,
    'PhoneNumber' => $partyA,
    'CallBackURL' => $callbackUrl,
    'AccountReference' => $AccountRefference,
    'TransactionDesc' => $TransactionDesc
);

$data_string=json_encode($curl_post_data);
//echo    $data_string;

curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_POST,true);
curl_setopt($curl, CURLOPT_POSTFIELDS,$data_string);

$curl_response=curl_exec($curl);
$data=json_decode($curl_response);
//$CheckoutRequestID=$data->CheckoutRequestID;



echo  $curl_response;




?>