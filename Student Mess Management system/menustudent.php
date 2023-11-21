<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles.css"/>
	<title>Menu</title>
	<style>
		body{
			background-color: lightgray;
		}
		table {
			border-collapse: collapse;
			width: 100%;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		th, td {
			padding: 10px;
			text-align: left;
			border: 1px solid black;
		}
		th {
			background-color: whitesmoke;
		}
		h1 {
			text-align: center;
		}
		
	</style>
</head>
<body>
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
	<h1>Menu</h1>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
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

			// Select data from menu table
			$result = mysqli_query($conn, "SELECT item_name, price FROM menu");
			// Display data in table
			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "<tr><td>" . $row["item_name"]. "</td><td>" . $row["price"]. "</td></tr>";
			    }
			} else {
			    echo "<tr><td colspan='2'>0 results</td></tr>";
			}

			// Close database connection
			mysqli_close($conn);
			?>
		</tbody>
	</table>
</body>
</html>
