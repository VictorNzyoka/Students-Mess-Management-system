<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css"/>
    <title>Student Mess Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: whitesmoke;
        }
        h1 {
        text-align: center;
        color: black;
    }

    form {
        margin: 0 auto;
        max-width: 400px;
        padding: 20px;
        background-color: lightgray;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }

    input[type="text"],
    input[type="password"] {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: none;
        border-radius: 3px;
        background-color: whitesmoke;
    }

    input[type="submit"] {
        display: block;
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 3px;
        background-color: green;
        color: whitesmoke;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: seagreen;
        color: black;
    }

    p.error-message {
        color: red;
        font-weight: bold;
        text-align: center;
    }
    .back-link{
			display: inline-block;
			background-color: green;
			color: white;
			padding: 10px 20px;
			margin-top: 20px;
			text-decoration: none;
			border-radius: 5px;
		}
        a:hover {
			background-color: seagreen;
			color: black;
		}
        .student{
            color: green
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
	</ul>  	
 </div>
      </div>
    <h1><span class=student>Student</span> Login</h1>

    <?php
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {
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

        // Get the form data
        $reg_number = $_POST['reg_number'];
        $password = $_POST['password'];

        // Check if the student exists in the database
        $sql = "SELECT * FROM students WHERE reg_number='$reg_number' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // The student has successfully logged in
            session_start();
            $_SESSION['reg_number'] = $reg_number;
            header("Location: students.php");
            exit();
        } else {
            // The student has entered incorrect login details
            echo "<p>Incorrect registration number or password. Please try again.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>
            <label for="reg_number">Registration Number:</label>
            <input type="text" name="reg_number" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </p>
        <p>
            <input type="submit" name="submit" value="Login">
        </p>
    </form>
    
</body>
</html>
