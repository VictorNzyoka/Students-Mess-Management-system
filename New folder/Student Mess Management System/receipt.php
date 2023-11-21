<?php
// Mpesa payment information
$transaction_code = $_POST['TransactionCode'];
$amount_paid = $_POST['Amount'];
$phone_number = $_POST['PhoneNumber'];
$date = date("Y-m-d H:i:s");

// Generate a random receipt number
$receipt_number = "RECEIPT-" . rand(1000, 9999);

// Create a receipt file
$receipt_file = fopen("receipts/".$receipt_number.".txt", "w") or die("Unable to create receipt file!");

// Write the receipt information to the file
$txt = "Receipt Number: ".$receipt_number."\n";
fwrite($receipt_file, $txt);
$txt = "Transaction Code: ".$transaction_code."\n";
fwrite($receipt_file, $txt);
$txt = "Amount Paid: ".$amount_paid."\n";
fwrite($receipt_file, $txt);
$txt = "Phone Number: ".$phone_number."\n";
fwrite($receipt_file, $txt);
$txt = "Date: ".$date."\n";
fwrite($receipt_file, $txt);

// Close the receipt file
fclose($receipt_file);

// Display the receipt information to the user
echo "<h1>Receipt Information</h1>";
echo "<p>Receipt Number: ".$receipt_number."</p>";
echo "<p>Transaction Code: ".$transaction_code."</p>";
echo "<p>Amount Paid: ".$amount_paid."</p>";
echo "<p>Phone Number: ".$phone_number."</p>";
echo "<p>Date: ".$date."</p>";
?>
