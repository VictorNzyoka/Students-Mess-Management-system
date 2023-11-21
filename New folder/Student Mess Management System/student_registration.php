<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css"/>
    <title>Student Mess Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 15px;
            color: black;
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
        }
        h1 {
        text-align: center;
        margin-top: 50px;
    }
    .container{
			text-align: center;
			color: red;
		}
		.container form{
			color: black;
		}

    form {
        width: 450px;
        margin: auto;
        background-color: lightgrey;
        color: black;
        border-radius: 5px;
        padding: 2px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        margin: auto;
    }

    input[type="text"],
    input[type="password"] {
        width: 95%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 16px;
        margin-bottom: 20px;
        margin: auto;
    }
    .container{
			text-align: center;
			color: red;
		}
		.container form{
			color: black;
		}

    input[type="submit"] {
        background-color: green;
        color: whitesmoke;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        font-size: 16px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: seagreen;
        color: black;
    }

    p.error {
        color: red;
        margin-bottom: 20px;
    }

    p.success {
        color: blue;
        margin-bottom:20px;
    }
 a{
    display: inline-block;
			padding: 10px 20px;
			margin-top: 20px;
			text-decoration: none;
		
 }
 .back-link{
    align-items: center;
			display: inline-block;
			color: saddlebrown;
            text-decoration: underline;
			margin-top: 20px;
		}
        
        .student{
            color: green;
        }
        .student_regform{
background-color: whitesmoke;
justify-content: center;
align-items: center;
display: flex;
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

      
    <h1><span class= student>Student</span> Registration Form</h1>


    <div class="container">
    <?php
        // Set the URL of the target page
$registration_page_url = "student_registration.php";
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
        $name = $_POST['name'];
        $reg_number = $_POST['reg_number'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check if the password and confirm password match
        if ($password !== $confirm_password) {
            echo "<p>Passwords do not match. Please try again.</p>";
            // Generate the link HTML code
          $link_html = "<a href='$registration_page_url'>Back</a>";
          // Output the link HTML code
      echo $link_html;
            exit();
        }

        // Check if the student is already registered
        $sql = "SELECT * FROM students WHERE reg_number='$reg_number'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<p>This registration number is already registered.</p>";
            // Generate the link HTML code
          $link_html = "<a href='$registration_page_url'>Back</a>";
          // Output the link HTML code
      echo $link_html;
            exit();
        }

        // Insert the student's details into the database
        $sql = "INSERT INTO students (name, reg_number, password) VALUES ('$name', '$reg_number', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "<p>Registration successful!</p>";
            header("Location: student_login.php");
        } else {
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?><div class="student_regform">
        <div>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
        </p>
        <p>
            <label for="reg_number">Registration Number:</label>
            <input type="text" name="reg_number" required>
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </p>
        <p>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required>
        </p>
        <p>
            <input type="submit" name="submit" value="Register">
        </p>
    </form>
    <div><a class="back-link" href="student_login.php"><b>Login</b></a></div>
    </div>
    </div>

        </div>
</body>
</html>
