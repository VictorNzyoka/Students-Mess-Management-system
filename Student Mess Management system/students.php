<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css"/>
    <title>Student Mess Management System - Student Page</title>
    <style>
        body {
            text-align: center;
        }
        h1 {
            margin-top: 50px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            font-size: 18px;
			color: saddlebrown;
			text-decoration: none;
			
        }
        
    </style>
</head>
<body>
    <?php
    session_start();

    // Check if the student is logged in
    if (isset($_SESSION['reg_number'])) {
        $reg_number = $_SESSION['reg_number'];

        // Connect to the database 
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mess_management";
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Check for errors
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        // Get the student's details from the database
        $sql = "SELECT * FROM students WHERE reg_number='$reg_number'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
        ?>
        </form>
        <?php

        // Close the database connection
        mysqli_close($conn);

    } else {
        // The student is not logged in, redirect to the login page
        header("Location: login.php");
        exit();
    }
    ?>
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
    <?php
    // Display the student's welcome message
    echo "<h1>Welcome, " . $row['name'] . "!</h1>";
?>
	<p>Our mess provides nutritious and delicious meals for breakfast, lunch, and dinner every day. We offer a variety of dishes that cater to different dietary needs and preferences, including vegetarian and non-vegetarian options.</p>
	<p>To ensure the safety and hygiene of our food, we follow strict cleanliness and sanitation procedures in our kitchen and dining hall. We also use high-quality ingredients sourced from trusted suppliers.</p>
	<p>You can view the menu for the week and choose your meals in advance using our online platform. You can make payments for your mess dues through the system.</p>
	<p>We are committed to providing a comfortable and enjoyable dining experience for all our students. If you have any feedback or suggestions, please feel free to reach out to us.</p>
	<p>Thank you for choosing our mess, and we hope you enjoy your meals!</p>
</body>
</html>
