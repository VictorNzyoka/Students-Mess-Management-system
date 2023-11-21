<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles.css"/>
	<title>Comments Page</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			font-size: 16px;
			background-color: #f1f1f1;
			padding: 20px;
		}
		h1 {
			text-align: center;
			margin-top: 0;
			margin-bottom: 30px;
		}
		form {
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
		}
		label {
			display: block;
			margin-bottom: 10px;
			font-weight: bold;
		}
		input[type="text"], textarea {
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			margin-bottom: 20px;
			font-size: 16px;
		}
		input[type="submit"] {
			background-color: #4CAF50;
			color: #fff;
			padding: 10px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
		}
		input[type="submit"]:hover {
			background-color: #45a049;
		}
		.comments {
			background-color: #fff;
			padding: 20px;
			border-radius: 5px;
			margin-top: 30px;
		}
		.comment {
			margin-bottom: 20px;
		}
		.comment .header {
			font-weight: bold;
			margin-bottom: 10px;
		}
		.comment .content {
			margin-left: 20px;
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
    <a href="buytest.php">Make Purchase</a>
	 </div>
	</div>
	<h1>Write your comments and suggestions here</h1>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		<!--<label for="reg_number">Registration Number:</label>
		<input type="text" name="reg_number" id="reg_number" required>-->

		<label for="comment">Comment:</label>
		<textarea name="comment" id="comment" required></textarea>

		<input type="submit" value="Submit">
	</form>

	<div class="comments">
		<?php
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
        

		// insert new comment into database
		if (isset($_POST['comment']))
        {
        //    $reg_number = $_POST['reg_number'];
            $comment = $_POST['comment'];
            $date_posted = date('Y-m-d H:i:s');
    
            $query = "INSERT INTO comments (comment, date_posted) VALUES ( '$comment', '$date_posted')";
            $result = mysqli_query($conn, $query);
    
            if ($result) {
                echo '<div class="success"><b>Your comment has been posted successfully.</b></div>';
            } else {
                echo '<div class="error">Error adding comment.</div>';
            }
        }
    
        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>    