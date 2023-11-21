<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css"/>
  <title>Comments List</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: lightgray;
      padding: 5px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .comment {
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }

    .comment h3 {
      margin-top: 0;
    }

    .comment p {
      margin-bottom: 0;
    }

    .no-comments {
      text-align: center;
      font-weight: bold;
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
		<li><a href="admin_logout.php.php">Logout</a></li>
	</ul>  	
	</div>
      </div>
    <div class="nav-container2">
		<div class="nav">
    <a href="admin.php">Dashboard</a> <br> <br>
     <a href="updatemenu.php">Update Menu</a><br> <br>
        <a href="menu.php">View Menu</a> <br> <br>
		<a href="comments.php">View Comments</a> <br> <br>
	 </div>
	</div>
  <h1>Comments List</h1>

  <?php
        // Connect to the database (you'll need to fill in your own details)
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mess_management";
        $conn = mysqli_connect($host, $username, $password, $dbname);


    // Check the connection.
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Select all comments from the database.
    $query = "SELECT id, comment, date_posted FROM comments";
    $result = mysqli_query($conn, $query);

    // Check if there are any comments.
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        // Output data of each row.
        while ($row = mysqli_fetch_assoc($result)) {
            // Display the comment and date posted.
            echo "<div class='comment'>";
            echo "<h3>Comment #" . $i . "</h3>";
            echo "<p>" . $row["comment"] . "</p>";
            echo "<p>Date Posted: " . $row["date_posted"] . "</p>";
            echo "</div>";
            $i++;
        }
    } else {
        // Display a message if there are no comments.
        echo "<p class='no-comments'>No comments found.</p>";
    }

    // Close the database connection.
    mysqli_close($conn);
  ?>
   <a class="back-link" href="admin.php">Back to Admin Home Page</a>
</body>
</html>
