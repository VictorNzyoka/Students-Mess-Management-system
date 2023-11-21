<?php
// Get the item name from the parameter
$item_name = urldecode($_GET['item_name']);

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

        break;
    }
}

// Redirect back to the cart page
header("Location: pay3.php");
exit();
?>
