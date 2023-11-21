<!DOCTYPE html>
<html>
<head>
<link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">  
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">  
</script>    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="styles.css"/>

    <title>Student Mess Management System - Student Page</title>
    <style>
        th{
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
        .container{
            display: flex;
            align-items: center;
            justify-content: center;  
            width: 100%; 
        }
        
        .container .content{
            text-align: center;
            padding: 20px;
            width: 800px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
        }.container .menu-shedule{
            justify-content: space-between;
            align-items: center;
            display: flex;
        }#menu-schedule{
            font-size: 2rem;
            color:green;
        }
        #Time{
            font-size: 2.4rem;
            color:green;
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
    <a href="buytest.php">Make Purchase</a> 
	 </div>
	</div>
    <?php
    // Display the student's welcome message
    echo "<h1>Welcome, " . $row['name'] . "!</h1>";
?>
  <div class='container'   style="margin-top: 20px;">
    <div>
     <div class='menu-shedule'>
        <div>
        <b>  <span id="menu-schedule"></span></b>
        </div>
        <div>
       <b> <span id="Time"></span></b>
        </div>
     </div>
     <div>

<table class = "table table-hover table-bordered table-striped" style="margin-top: 20px;">  
<thead>  
<tr>
<th colspan="3" style="font-size: 1.8rem;"><b>Our menu schedules</b></th>     
    
</tr>  
<tr>
   <th colspan="2" style="font-size: 1.4rem;"><b>Time</b></th>   
   <th><b style="font-size: 1.4rem;">Type of meal</b></th>
</tr>  
<tr>
   <th style="font-size: 1rem;"><b>Starts</b></th>   
   <th style="font-size: 1rem;"><b>Ends</b></th>
</tr>
</thead>  
<tbody>  
<tr> 
     
     <td> 6:00 AM </td>
     <td> 11:00 AM </td>
     <td> Breakfast Menu </td>
    </tr>
    <tr> 
     
     <td> 12:00 AM </td>
     <td> 2:00 PM </td>
     <td> Lunch Menu </td>
    </tr>
    <tr> 
     
     <td> 4:00 AM </td>
     <td> 8:00 PM </td>
     <td> Breakfast Menu </td>
    </tr>  
</tbody>  
</table> 


     </div>
     <div class='content'>
	
    </div>
 </div>
 <script src="mess.js"></script>
</body>
</html>
