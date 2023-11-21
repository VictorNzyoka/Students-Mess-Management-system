


<?php

if (isset($_POST['phone']) ){
    $phone=$_POST['phone'];
    // Twilio API credentials
    $account_sid = 'AC834cf54e9759d06c67da84c25d7fea63';
    $auth_token = '32abdfba16b40e73c365c75cf957e7d6';
    echo 'sucesss';
    $client=new Twilio\Rest\Client($account_sid ,$auth_token)
    $client->message->create(
        $_POST['phone'], array{
            'from'
        }  
    );
}
else{
    echo 'invali number';
}







// // Phone numbers
// $from_number = '+15674004587'; // Twilio phone number
// $to_number =$phone; // Your phone number

// // Message
// $message = 'Hello, this is a test message!';

// // Twilio API URL
// $url = 'https://api.twilio.com/2010-04-01/Accounts/' . $account_sid . '/Messages.json';

// // Send the message
// $curl = curl_init($url);
// curl_setopt($curl, CURLOPT_POST, true);
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// curl_setopt($curl, CURLOPT_USERPWD, $account_sid . ':' . $auth_token);
// curl_setopt($curl, CURLOPT_POSTFIELDS, array(
//     'From' => $from_number,
//     'To' => $to_number,
//     'Body' => $message
// ));


// $response = curl_exec($curl);
// curl_close($curl);

// // Print the response
// echo $response;
// echo $curl;
// echo curl_exec($curl);
// echo 'successful'
?>
