<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
	<link rel="stylesheet" href="styles.css"/>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: lightgray;
			margin: 0;
			padding: 0;
		}

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			text-align: center;
		}

		a {
			display: inline-block;
			color: saddlebrown;
			margin-top: 20px;
			text-decoration: none;
			
		}.container{
			justify-content: center;
			align-items: center;
			display: flex;
			
		}.container .container-content{
			width: 600px;
			color: black;
		}
	 #title{
		color: green;
		text-shadow:4px 4px 5px green ;
	 }
	 .div{
		width:400px ;
	 }hr{
		width: 400px;
		color: green;
		box-shadow: 4px 4px 4px black;
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
		<li><a href="admin_logout.php">Logout</a></li>
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
	
	<h1>Welcome to the Admin Dashboard!</h1>

	<div class='container'>
	<div class="container-content">
		<div id="div">
		<h1 id="title"><b>Admin actions</b></h1>
		<hr/>
		</div>
	<h2>Update Menu</h2>
	<div>
	<p>You can update the menu for the week using our online platform. Simply add, edit, or delete dishes as necessary, and the changes will be reflected on the student dashboard immediately.</p>
	</div>

	<h2>View Comments</h2>
	
	<div>
	<p>You can view comments and feedback from students regarding the mess service. This will help you identify areas for improvement and respond to any concerns or issues raised by students.</p>
	</div>

	<h2>View Menu</h2>

	<div>
	<p>You can view the menu for the week to ensure that it is up-to-date and accurate. This will help you respond to any questions or concerns raised by students regarding the menu.</p>
	</div>
	</div>
	</div>
</body>
</html>
