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

// Check if items have been selected
if (isset($_POST['items'])) {

    // Initialize variables
    $total = 0;
    $cart_items = [];

    // Loop through selected items and calculate total
    foreach ($_POST['items'] as $item) {
        $item_array = explode("|", $item);
        $item_name = $item_array[0];
        $item_price = $item_array[1];
        $total += $item_price;
        
        // Add item to cart_items
        $cart_items[] = ['name' => $item_name, 'price' => $item_price];
    }

    // Display selected items and total
    echo "<br><br>";
    echo "Selected Items:<br>";
    foreach ($cart_items as $key => $item) {
        echo $item['name'] . " - KSh " . number_format($item['price'], 2) . 
            " <a href='?cancel=" . $key . "'>Cancel</a><br>";
    }
    echo "Total: KSh " . number_format($total, 2);

    // Handle cancellation of item
    if (isset($_GET['cancel'])) {
        $item_key = $_GET['cancel'];
        $item_price = $cart_items[$item_key]['price'];
        $total -= $item_price;
        unset($cart_items[$item_key]);
        echo "<br><br>Item cancelled successfully.<br>";
    }

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
if (isset($_POST['purchase']) && isset($_POST['phone']) && count($cart_items) > 0) {

    // Initialize variables
    $total = $_POST['total'];
    $phone = $_POST['phone'];

    // Calculate timestamp for transaction
    $timestamp = date("YmdHis");

    // Generate receipt
    $receipt = "<h3>Receipt</h3><br>";
    foreach ($cart_items as $item) {
        $receipt .= $item['name'] . " - KSh " . number_format($item['price'], 2) . "<br>";
    }
    $receipt .= "Total: KSh " . number_format($total, 2) . "<br>";
    $receipt .= "Phone: " . $phone . "<br>";
    $receipt .= "Timestamp: " . $timestamp . "<br>";

    // Save receipt to file
    $file_name = "receipt_" . $timestamp . ".html";
    file_put_contents($file_name, $receipt);

    // Redirect to success page
    header("Location: success.php?file=" . $file_name);
    exit();

}

//
if ($status == 200) {
    // Generate a random receipt number
    $receipt_number = "MPSA" . rand(100000, 999999);

    // Insert purchase record into the database
    $sql = "INSERT INTO purchases (phone, amount, receipt_number) VALUES ('$phone', $total, '$receipt_number')";
    mysqli_query($conn, $sql);

    // Display receipt to user
    echo "<br><br>";
    echo "<h2>Receipt</h2>";
    echo "Receipt Number: " . $receipt_number . "<br>";
    echo "Phone Number: " . $phone . "<br>";
    echo "Total Amount: KSh " . number_format($total, 2) . "<br>";
    echo "Items Purchased:<br>";
    echo $cart_items;
}
else {
    // Display error message if payment was not successful
    echo "Payment was not successful. Please try again later.";
}

// Close database connection
mysqli_close($conn);
?>
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

        // Add cancel option for each item
        $cart_items .= $item_name . " - KSh " . number_format($item_price, 2) .
            " <a href='?cancel=" . urlencode($item_name) . "'>Cancel</a><br>";
    }

    // Store cart items and total in session variables
    $_SESSION['cart_items'] = $cart_items;
    $_SESSION['total'] = $total;

    // Display selected items and total
    echo "<br><br>";
    echo "Selected Items:<br>";
    echo $cart_items;
    echo "Total: KSh " . number_format($total, 2);

    // Display purchase button and phone number input box
    echo "<br><br>";
    echo "<form method='post'>";
    echo "<label for='phone'>Enter phone number for M-Pesa payment:</label><br>";
    echo "<input type='text' id='phone' name='phone'><br><br>";
    echo "<input type='submit' name='purchase' value='Purchase'>";
    echo "</form>";

}

// Check if cancel button has been clicked
if (isset($_GET['cancel'])) {
    // Get the item name from the parameter
    $item_name = urldecode($_GET['cancel']);

    // Loop through the selected items and remove the item with the matching name
    foreach ($_SESSION['cart_items'] as $key => $item) {
        $item_array = explode("|", $item);
        $current_item_name = $item_array[0];

        if ($current_item_name == $item_name) {
            // Remove the item from the cart_items
            unset($_SESSION['cart_items'][$key]);

            // Deduct the item price from the total
            $item_price = $item_array[1];
            $_SESSION['total'] -= $item_price;

            // Redirect back to the cart page
            header("Location: cart.php");
            exit();
        }
    }
}

// Check if purchase button has been clicked and phone number has been inputted
if (isset($_POST['purchase']) && isset($_POST['phone'])) {

