<?php
header("content_type: application/json");
$stkcallbackResponse=file_get_contents('php://inputs');
$logfile="Mpesastkresponse.json";
$log=fopen($logfile,"a");
fwrite($log,$stkcallbackResponse);
fclose($log);

$data=json_decode($stkcallbackResponse);
$MerchantRequestID=$data->Body->stkCallback->MerchantRequestID;
$CheckoutRequestID=$data->Body->stkCallback->CheckoutRequestID;
$ResultCode=$data->Body->stkCallback->ResultCode;
$ResultDesc=$data->Body->stkCallback->ResultDesc;
$Amount=$data->Body->stkCallback->CallbackMetaData->Item[0]->value;
$TransactionID=$data->Body->stkCallback->CallbackMetaData->Item[1]->value;

///IF THE TRANSACTION WAS SUCCESSFUL    -----

if($ResultCode==0){
    echo "TRANSACTION  SUCCESSFULL!!!!!";
    //STORE TO THE DATABASE--------------
}


?>