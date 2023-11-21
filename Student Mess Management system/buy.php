<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
</head>
<body>
    <h1>Menu</h1>

    <?php
// Establish a connection to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "mess_management";
$conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to select items from the menu table
    $sql = "SELECT item_name, price FROM menu";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display the menu items and a checkbox for selection
        echo "<h2>Menu Items</h2>";
        echo "<table><tr><th>Item Name</th><th>Price</th><th>Select</th></tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["item_name"] . "</td><td>" . $row["price"] . "</td><td><input type='checkbox' name='selected_items[]' value='" . $row["item_name"] . "," . $row["price"] . "' onclick='updateTotalPrice()'></td></tr>";
        }

        echo "</table>";

        // Display the selected items and the total price
        echo "<h2>Selected Items</h2>";
        echo "<table id='selected_items_table'><tr><th>Item Name</th><th>Price</th></tr></table>";
        echo "<p>Total Price: <span id='total_price'></span></p>";
        echo "<button onclick='buyItems()'>Buy</button>";

    } else {
        echo "No items found in the menu.";
    }

    $conn->close();
    ?>

    <script>
        function updateTotalPrice() {
            // Get the selected items
            const selectedItems = document.getElementsByName("selected_items[]");

            // Calculate the total price
            let totalPrice = 0;
            let selectedItemsHtml = "";
            for (let i = 0; i < selectedItems.length; i++) {
                if (selectedItems[i].checked) {
                    const itemData = selectedItems[i].value.split(",");
                    selectedItemsHtml += "<tr><td>" + itemData[0] + "</td><td>" + itemData[1] + "</td></tr>";
                    totalPrice += parseFloat(itemData[1]);
                }
            }

            // Update the selected items table
            const selectedItemsTable = document.getElementById("selected_items_table");
            selectedItemsTable.innerHTML = "<tr><th>Item Name</th><th>Price</th></tr>" + selectedItemsHtml;

            // Update the total price element
            const totalElem = document.getElementById("total_price");
            totalElem.innerHTML = totalPrice.toFixed(2);
        }

        function buyItems() {
            // Submit the form
            // Replace "form_id" with the actual ID of your form
            document.getElementById("form_id").submit();
        }
    </script>

    <form id="form_id" method="post" action="process_order.php">
        <!-- Add any other form fields you need here -->
    </form>
</body>
</html>
