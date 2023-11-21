<?php
session_start();
// Step 1: Establish a connection to the database
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mess_management";
        $conn = mysqli_connect($host, $username, $password, $dbname);

// Check if user is logged in
if (!isset($_SESSION['reg_number'])) {
  echo "Please login to continue.";
  exit();
}

// Retrieve user's registration number
$reg_number = $_SESSION['reg_number'];

// Retrieve user's current balance
$balance_query = "SELECT balance FROM mess_account WHERE reg_number='$reg_number'";
$balance_result = mysqli_query($conn, $balance_query);
$balance_row = mysqli_fetch_assoc($balance_result);
$balance = $balance_row['balance'];

// Handle purchase request
if (isset($_POST['purchase'])) {
  $item_id = $_POST['item_id'];
  $item_name = $_POST['item_name'];
  $item_price = $_POST['item_price'];
  $date_purchased = date('Y-m-d H:i:s');
  
  // Check if user has sufficient balance
  if ($balance < $item_price) {
    $message = "Insufficient balance.";
  } else {
    // Deduct price from user's balance
    $new_balance = $balance - $item_price;
    $update_balance_query = "UPDATE mess_account SET balance='$new_balance' WHERE reg_number='$reg_number'";
    mysqli_query($conn, $update_balance_query);

    // Save purchase in purchases table
    $insert_purchase_query = "INSERT INTO purchases (reg_number, item_name, item_id, price, date_purchased) VALUES ('$reg_number', '$item_name', '$item_id', '$item_price', '$date_purchased')";
    mysqli_query($conn, $insert_purchase_query);
    
    $message = "Purchase successful!";
  }
}

// Handle cancel request
if (isset($_POST['cancel'])) {
  $purchase_id = $_POST['purchase_id'];
  $purchase_price = $_POST['purchase_price'];
  
  // Add price back to user's balance
  $new_balance = $balance + $purchase_price;
  $update_balance_query = "UPDATE mess_account SET balance='$new_balance' WHERE reg_number='$reg_number'";
  mysqli_query($conn, $update_balance_query);

  // Remove purchase from purchases table
  $delete_purchase_query = "DELETE FROM purchases WHERE item_id='$purchase_id'";
  mysqli_query($conn, $delete_purchase_query);
  
  $message = "Purchase cancelled.";
}

// Display menu
$menu_query = "SELECT * FROM menu";
$menu_result = mysqli_query($conn, $menu_query);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Purchases form</title>

	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f5f5f5;
			margin: 0;
			padding: 0;
		}
		h1 {
			color: #333;
			margin-top: 20px;
			margin-bottom: 20px;
			text-align: center;
		}
		h2 {
			color: #333;
			margin-top: 30px;
			margin-bottom: 10px;
		}
		table {
			border-collapse: collapse;
			margin-top: 10px;
			margin-bottom: 30px;
			width: 100%;
		}
		table th, table td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}
		table th {
			background-color: #f2f2f2;
			color: #333;
		}
		form button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 8px 16px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 14px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 4px;
		}
		form button:hover {
			background-color: #3e8e41;
		}
		form input[type=hidden] {
			display: none;
		}
		p {
			color: #4CAF50;
			margin-top: 10px;
			margin-bottom: 10px;
		}
	</style>

</head>
<body>
	<h1>Make your purchases</h1>
	<h3><?php echo "Student: $reg_number" ?></h3>
	<h3><?php echo "Balance: $balance" ?></h3>

	<?php if(isset($message)) { ?>
	<p><?php echo $message ?></p>
	<?php } ?>

	<h2>Menu</h2>
	<table>
		<thead>
			<tr>
			    <th>Item ID</th>
				<th>Item Name</th>
				<th>Price</th>
				<th>Purchase</th>
			</tr>
		</thead>
		<tbody>
		<?php while ($row = mysqli_fetch_assoc($menu_result)) { ?>
    <tr>
	    <td><?php echo $row['item_id'] ?></td>
        <td><?php echo $row['item_name'] ?></td>
        <td><?php echo $row['price'] ?></td>
        <td>
            <form method="post">
            <!--  <input type="hidden" name="item_id" value="<?php echo $row['id'] ?>">-->
				<input type="hidden" name="item_id" value="<?php echo $row['item_id'] ?>">
                <input type="hidden" name="item_name" value="<?php echo $row['item_name']?>">
                <input type="hidden" name="item_price" value="<?php echo $row['price'] ?>">
                <button type="submit" name="purchase">Purchase</button>
            </form>
        </td>
    </tr>
<?php } ?>
	</tbody>
</table>

<h2>Purchases</h2>
<table>
	<thead>
		<tr>
		    <th>Item ID</th>
			<th>Item Name</th>
			<th>Price</th>
			<th>Date purchased</th>
			<th>Cancel</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$purchases_query = "SELECT * FROM purchases WHERE reg_number='$reg_number'";
		$purchases_result = mysqli_query($conn, $purchases_query);
		while ($row = mysqli_fetch_assoc($purchases_result)) { ?>
		<tr>
		    <td><?php echo $row['item_id'] ?></td>
			<td><?php echo $row['item_name'] ?></td>
			<td><?php echo $row['price'] ?></td>
			<td><?php echo $row['date_purchased'] ?></td>
			<td>
				<form method="post">
					<input type="hidden" name="purchase_id" value="<?php echo $row['item_id'] ?>">
					<input type="hidden" name="purchase_price" value="<?php echo $row['price'] ?>">
					<input type="hidden" name="date_purchased" value="<?php echo $row['date_purchased'] ?>">
					<button type="submit" name="cancel">Cancel</button>
				</form>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>
<a class="back-link" href="students.php"><b>Back to student Home Page</b></a>
</body>
</html>