<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt Generator</title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">  
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>    
    <link rel="stylesheet" href="style.css"/>
    <style>
        /* Styles for the receipt */
        .receipt {
            margin: auto;
            width: 60%;
            border: 1px solid black;
            padding: 20px;
        }
        .receipt h1 {
            text-align: center;
        }
        .receipt h2 {
            text-align: left;
            margin-top: 30px;
        }
        .receipt table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        .receipt table th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid black;
        }
        .receipt table th {
            background-color: #eaeaea;
        }
        .receipt table td {
            font-weight: bold;
        }
        .receipt .total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    
    <div class="nav-container">
        <!-- Navigation code -->
    </div>
    <div class="nav-container2">
        <!-- Navigation code -->
    </div>
    
    <div class="purchase-container">
        <!-- Purchase code -->
        <?php
            // Establish a connection to the database
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "mess_management";
            $conn = mysqli_connect($host, $username, $password, $dbname);

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to select items from the menu table
            $sql = "SELECT item_name, price FROM menu";

            $result = mysqli_query($conn, $sql);

            // Initialize variables for the receipt
            $total = 0;
            $items = array();

            if (mysqli_num_rows($result) > 0) {
                // Display the menu items and a checkbox for selection
                echo "<h1>Select Items</h1>";
                echo "<form method='post'>";
                echo "<table>";
                echo "<tr><th>Item Name</th><th>Price</th><th>Select</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['item_name']."</td>";
                    echo "<td>".$row['price']."</td>";
                    echo "<td><input type='checkbox' name='items[]' value='".$row['item_name']."|".$row['price']."'></td>";
                    echo "</tr>";
                }
                echo "</table>";

                // Display a button to generate the receipt
                echo "<button type='submit' name='submit' class='btn btn-primary mt-3'>Generate Receipt</button>";
                echo "</form>";
            }

            
            // Function to generate receipt
            function generateReceipt($selectedItems, $totalPrice) {
                $receipt = "<h2>Receipt</h2>";
                $receipt .= "<ul>";
                foreach ($selectedItems as $item) {
                    $receipt .= "<li>" . $item["name"] . " - $" . $item["price"] . "</li>";
                }
                $receipt .= "</ul>";
                $receipt .= "<h3>Total Price: $" . $totalPrice . "</h3>";
            
                return $receipt;
            }
            
            if(isset($_POST['submit'])){
            
                // Retrieve the selected items and calculate the total price
                $selectedItems = array();
                $totalPrice = 0;
            
                foreach ($_POST['items'] as $item) {
                    $itemName = $item['name'];
                    $itemPrice = $item['price'];
            
                    $selectedItems[] = array("name" => $itemName, "price" => $itemPrice);
                    $totalPrice += $itemPrice;
                }
            
                // Generate the receipt
                $receipt = generateReceipt($selectedItems, $totalPrice);
            
                // Display the receipt
                echo "<div class='purchase-container'>";
                echo "<div class='purchase-content'>";
                echo $receipt;
                echo "</div>";
                echo "</div>";
            }
            
            ?>
         
            // When the
            </body>
            </html>   
            
            
            
            