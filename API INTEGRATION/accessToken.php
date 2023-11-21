<?php

//MPESA KEYS

$CUSTOMER_KEY="CpeQbK9e1ChSDAl1W5yc5dIelXfFMAlL";
$SECRET_KEY="n9xASsHZL4kbdZ0L";


//ACCESS TOKEN URL
$access_token_url="https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
$headers=['content-Type:application/json; charset=utf8'];
$curl=curl_init($access_token_url);

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_USERPWD, $CUSTOMER_KEY .':' .$SECRET_KEY);
$result=curl_exec($curl);
echo $result;
$status=curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result=json_decode($result);
$access_token= $result-> access_token;
curl_close($curl);
?>