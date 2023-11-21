<?php

// Connect to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "mess_management";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get menu items from database
$sql = "SELECT item_name, price FROM menu";
$result = mysqli_query($conn, $sql);

// Display menu items with checkboxes
echo "<form method='post'>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<input type='checkbox' name='items[]' value='" . $row['item_name'] . "|" . $row['price'] . "'>";
    echo $row['item_name'] . " - KSh " . $row['price'];
    echo "<br>";
}
echo "<br><input type='submit' value='Add to Cart'>";
echo "</form>";

// Check if items have been selected
if (isset($_POST['items'])) {

    // Initialize variables
    $total = 0;
    $cart_items = "";
  
    // Loop through selected items and calculate total
    foreach ($_POST['items'] as $item) {
        $item_array = explode("|", $item);
        $item_name = $item_array[0];
        $item_price = $item_array[1];
        $total += $item_price;
        $cart_items .= $item_name . "<button name='cancel' value='cancel' class='cancel-item' data-price='" . $item_price . "'>Cancel</button><br>";
    
    // Loop through selected items and calculate total
    // foreach ($_POST['items'] as $item) {
    //     $item_array = explode("|", $item);
    //     $item_name = $item_array[0];
    //     $item_price = $item_array[1];
    //     $total += $item_price;
    //     $cart_items .= $item_name . "<br>";
    }

    // Display selected items and total
    echo "<br><br>";
    echo "Selected Items:<br>";
    echo $cart_items;
    echo "Total: KSh " . number_format($total, 2);

    // Display purchase button and phone number input box
    echo "<br><br>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='total' value='" . $total . "'>";
    echo "<label for='phone'>Enter phone number for M-Pesa payment:</label><br>";
    echo "<input type='text' id='phone' name='phone'><br><br>";
    echo "<input type='submit' name='purchase' value='Purchase'>";
    echo "</form>";

    // Check if cancel button has been clicked
if (isset($_POST['cancel'])) {

    // Get item name and price
    $cancel_item = $_POST['cancel'];
    $cancel_array = explode("|", $cancel_item);
    $cancel_name = $cancel_array[0];
    $cancel_price = $cancel_array[1];

    // Remove item from cart_items
    $cart_items = str_replace($cancel_name . "<br>", "", $cart_items);

    // Deduct price from total
    $total -= $cancel_price;

    // Display updated cart
    echo "<br><br>";
    echo "Selected Items:<br>";
    echo $cart_items;
    echo "Total: KSh " . number_format($total, 2);
}
if(isset($_SESSION['cart'])){
    $items = $_SESSION['cart']['items'];
} else {
    $_SESSION['cart'] = array();
    $items = array();
}
// Display cancel buttons for selected items
echo "<br><br>";
echo "<form method='post'>";
foreach($items as $item){
    // code to process each item
    $item_array = explode("|", $item);
    $item_name = $item_array[0];
    $item_price = $item_array[1];
    echo $item_name . " - KSh " . $item_price;
    echo "<button type='submit' name='cancel' value='" . $item . "'>Cancel</button>";
    echo "<br>";
}
echo "</form>";
}

// // Display cancel buttons for selected items
// echo "<br><br>";
// echo "<form method='post'>";
// foreach ($_POST['items'] as $item) {
//     $item_array = explode("|", $item);
//     $item_name = $item_array[0];
//     $item_price = $item_array[1];
//     echo $item_name . " - KSh " . $item_price;
//     echo "<button type='submit' name='cancel' value='" . $item . "'>Cancel</button>";
//     echo "<br>";
// }
// echo "</form>";

// Check if purchase button has been clicked and phone number has been inputted
if (isset($_POST['purchase']) && isset($_POST['phone'])) {

    // Initialize variables
    $total = $_POST['total'];
    $phone = $_POST['phone'];
    
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
//echo $result;
$status=curl_getinfo($curl, CURLINFO_HTTP_CODE);
$result=json_decode($result);
$access_token= $result-> access_token;
curl_close($curl);
//MPESA EXPRESS
//STK PUSH


date_default_timezone_set('Africa/Nairobi');
$proccessRequestUrl='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackUrl="https://drive.google.com/drive/folders/1vSYlciRi_fx-8xxqe0lYtCXbaJcNNlSg";
$pass_key="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$bussiness_short_code="174379";
$TimeSetup=date("YmdHis");
$password=base64_encode($bussiness_short_code.$pass_key.$TimeSetup);
$phone=$_POST['phone'];

$amount=$_POST['total'];
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



//echo  $curl_response;
    /*
// Make API call to generate access token
$access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'; // Set URL to generate access token
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $access_token_url);
$app_key_secret = base64_encode($app_key . ':' . $app_secret); // Encode app key and secret to base64
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $app_key_secret)); // Set authorization header
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
$access_token_response = curl_exec($curl); // Execute cURL request
$access_token = json_decode($access_token_response)->access_token; // Decode the response and extract access token
curl_close($curl); // Close cURL session

// Make API call to initiate M-Pesa payment request
$payment_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest'; // Set URL for M-Pesa payment
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $payment_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token)); // Set headers
$timestamp = date('YmdHis'); // Set timestamp
$password = base64_encode($business_short_code . $passkey . $timestamp); // Generate password
$curl_post_data = array(
'BusinessShortCode' => $business_short_code,
'Password' => $password,
'Timestamp' => $timestamp,
'TransactionType' => 'CustomerPayBillOnline',
'Amount' => $total,
'PartyA' => $phone,
'PartyB' => $business_short_code,
'PhoneNumber' => $phone,
'CallBackURL' => $callback_url,
'AccountReference' => 'MyStore',
'TransactionDesc' => 'Purchase of items from MyStore'
); // Set payment data
$curl_post_data = json_encode($curl_post_data); // Encode payment data as JSON
curl_setopt($curl, CURLOPT_POST, true); // Set POST request method
curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data); // Set payment data as request body
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
$payment_response = curl_exec($curl); // Execute cURL request
curl_close($curl); // Close cURL session

// Parse payment response and get status
$status = json_decode($payment_response)->ResponseDescription; // Decode the response and extract status
*/
// Display payment response
echo "<br><br>";
echo "Payment Response:<br>";
echo "Phone number: " . $phone . "<br>"; // Display phone number used for payment
echo "Amount: KSh " . number_format($total, 2) . "<br>"; // Display payment amount


}

// Close database connection
mysqli_close($conn);

?>