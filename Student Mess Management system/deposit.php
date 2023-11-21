<?php
// Set database connection variables
$servername = "localhost";
$username = "yourusername";
$password = "yourpassword";
$dbname = "yourdbname";

// Initialize variables for input fields
$reg_number = $account_number = $amount = $password = $payment_method = "";

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	// Sanitize and validate input fields
	$reg_number = trim($_POST["reg_number"]);
	$account_number = trim($_POST["account_number"]);
	$amount = trim($_POST["amount"]);
	$password = trim($_POST["password"]);
	$payment_method = trim($_POST["payment_method"]);
	
	// Validate input fields
	if (empty($reg_number) || empty($account_number) || empty($amount) || empty($password) || empty($payment_method)) {
		echo "Please fill in all required fields.";
	} elseif (!is_numeric($amount)) {
		echo "Please enter a valid amount.";
	} else {
  // Connect to the database 
  $host = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mess_management";
  $conn = mysqli_connect($host, $username, $password, $dbname);

		// Check database connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Check if student with given reg_number exists in the database
        $sql = "SELECT * FROM students WHERE reg_number='$reg_number'";
        $result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) == 0) {
			echo "Invalid registration number or password.";
		} else {
			// Get the current balance for the student's account
			$balance_query = "SELECT * FROM mess_account WHERE reg_number='$reg_number'";
			$balance_result = mysqli_query($conn, $balance_query);

			if (mysqli_num_rows($balance_result) == 0) {
				// Insert new row into mess_account table
				$insert_query = "INSERT INTO mess_account (reg_number, account_number, balance) VALUES ('$reg_number', '$account_number', '$amount')";
				mysqli_query($conn, $insert_query);
			} else {
				// Update existing row in mess_account table
				$current_balance = mysqli_fetch_assoc($balance_result)["balance"];
				$update_query = "UPDATE mess_account SET balance='" . ($current_balance + $amount) . "' WHERE reg_number='$reg_number'";
				mysqli_query($conn, $update_query);
			}

			echo "Deposit successful";
		}

		// Close the database connection
		mysqli_close($conn);
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Mess Management System</title>
	<link rel="stylesheet" href="styles.css"/>
	<style>
		form {
			margin: 50px auto;
			padding: 20px;
			border: 1px solid #ccc;
			width: 500px;
			background-color: lightgray;
		}
		label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
		input[type="text"], input[type="password"], select {
			padding: 5px;
			border: 1px solid #ccc;
			border-radius: 3px;
			width: 100%;
			box-sizing: border-box;
			margin-bottom: 10px;
		}
		input[type="submit"] {
			background-color: green;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 3px;
			cursor: pointer;
		}
		input[type="submit"]:hover {
			background-color:  seagreen;
			color: black;
		}
		h1{
			text-align: center;
		}
	</style>

</head>
<div class="nav-container">
       <ul>	
       	<li>
        	<div class="logo-container">
        		<img src="images/logo.jpeg">
        	</div>
        </li>	

   <li>
      <div class="dekut-container">
        		<h2><b>Dedan Kimathi university of Technology</b></h2>
        		 <h4 style="text-align: center;color: green"><b><i>Better life Through technology</i></b></h4>
       </div>
    </li>
        	  
    </ul>


    <div class="admin-container">
      <ul>
		<li><a href="MainHomepage.php">Home</a></li>
		<li><a href="student_logout.php">Logout</a></li>
	</ul>  	
	</div>
      </div>
    <div class="nav-container2">
		<div class="nav">
	<a href="students.php">Dashboard</a> 
    <a href="menustudent.php">View Menu</a> 
    <a href="comm.php">comment</a> 
    <a href="pay3.php">Make Purchase</a> 
    <a href="deposit.php">Deposit to your account</a>
	 </div>
	</div>
<body>
	<h1>Deposit Money</h1>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="reg_number">Registration Number:</label>
		<input type="text" name="reg_number" required><br><br>

		<label for="account_number">Account Number:</label>
		<input type="text" name="account_number" required><br><br>

		<label for="amount">Amount:</label>
		<input type="text" name="amount" required><br><br>

		<label for="password">Password:</label>
		<input type="password" name="password" required><br><br>

		<label for="payment_method">Payment Method:</label>
        <select name="payment_method">
		<option value="mpesa">M-PESA</option>
		<option value="bank_deposit">Bank Deposit</option>
	</select><br><br>

	<input type="submit" value="Deposit">
</form>
<a class="back-link" href="students.php"><b>Back to student Home Page</b></a>
</body>
</html>	
