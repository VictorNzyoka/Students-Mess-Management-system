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
    $cart_items .= $item_name . "<br>";
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

}

// Check if purchase button has been clicked and phone number has been inputted
if (isset($_POST['purchase']) && isset($_POST['phone'])) {

  // Initialize variables
  $total = $_POST['total'];
  $phone = $_POST['phone'];

  // Make M-Pesa payment using API
  // TODO: Implement M-Pesa API integration code here
  // For example: 
  // $response = mpesa_make_payment($phone, $total);

  // Display payment response
  echo "<br><br>";
  echo "Payment Response:<br>";
  echo "Phone number: " . $phone . "<br>";
  echo "Amount: KSh " . number_format($total, 2) . "<br>";
  echo "Status: Success"; // TODO: Use actual status returned by M-Pesa API

}

// Close database connection
mysqli_close($conn);

?>
