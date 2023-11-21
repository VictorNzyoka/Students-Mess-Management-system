<!DOCTYPE html>
<html>
<head>
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="styles.css"/>
    <style>
    /* Apply a background color to the body */
body {
  background-color: lightgray;
}

/* Center the login form horizontally */
form {
  max-width: 400px;
  margin: 0 auto;
}

/* Style the input fields and labels */
label, input[type="text"], input[type="password"] {
  display: block;
  width: 100%;
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: bold;
}

input[type="text"], input[type="password"] {
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
  background-color: whitesmoke;
  box-shadow: inset 0 1px 3px rgba(0,0,0,.1);
}

/* Style the login button */
input[type="submit"] {
  display: block;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: none;
  background-color:green;
  color: whitesmoke;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: seagreen;
  color: black;
}

/* Style the back links */
.back-link {
  display: block;
  margin-top: 20px;
  font-size: 14px;
  font-weight: bold;
  color: black;
  text-align: center;
  text-decoration: underline;
}

.back-link:hover {
  text-decoration: underline;
  color: green;

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
    
    <h1>Admin Login</h1>
   
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
        $id_number = $_POST['id_number'];
        $password = $_POST['password'];

        // Check if the admin exists in the database
        $sql = "SELECT * FROM admin WHERE id_number= '$id_number' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // The admin has successfully logged in
            session_start();
            $_SESSION['id_number'] = $id_number;
            header("Location: admin.php");
            exit();
        } else {
            // The admin has entered incorrect login details
            echo "<p>Incorrect identification number or password. Please try again.</p>";
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>
            <label for="id_number">Identification Number:</label>
            <input type="text" name="id_number" required>
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
