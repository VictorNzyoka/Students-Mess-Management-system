<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<style>
		body {
 			 /*background-color: lightgray;*/
          background-image:url(images/MESS_PHOTO.jpg);
          background-repeat: none;
         
		    }

.nav-container{
	justify-content: space-between;
	display: flex;
	background: white;
	/*background: #8A7777;*/
	top:0;
	position: sticky;
	box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}







		h1 {
			text-align: center;
		}
		ul {
			list-style: none;
			padding: 0;
			margin: 20px 0;
			display: flex;
			justify-content: right;
		}
		li {
			margin: 0 10px;
		}
		a {
			display: block;
			padding: 10px;
			background-color: green;
			color: white;
			font-size: 2rem;
			text-align: right;
			text-decoration: none;
			border-radius: 5px;
			transition: background-color 0.2s ease-in-out;
		}
		a:hover {
			box-shadow: 4px 4px 8px green;
			background-color: seagreen;
			color: black;
		}
	.features {
	background-color: #f2f2f2;
	padding: 100px 0;
}

.feature {
	margin: 0 auto;
	max-width: 500px;
	text-align: center;
	padding: 20px;
	border-radius: 5px;
	background-color: #fff;
	box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.feature img {
	max-width: 300px;
	margin-bottom: 20px;
}

.feature h3 {
	font-size: 24px;
	margin-bottom: 10px;
}

.feature p {
	font-size: 16px;
	line-height: 1.5;
	margin-bottom: 20px;
}
.container{
width: 100%;
max-height: 90%;
justify-content: center;
align-items: center;
display: flex;	
}
.home1,.home2{
	width: 50%;
	height: 100%;
}
marquee{
	font-size: 2.5rem;
	color: green;
}
	</style>

</head>
<body>
	<body style="min-height: 90vh ">
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
		<li><a href="admin_registration.php">Admin</a></li>
		<li><a href="student_registration.php">Student</a></li>
		<li><a href="cashier_registration.php">Cashier</a></li>
	</ul>  	
 </div>
      </div>
    


<div class="container">
<section class="features">
		
		<div class="feature">
			
<marquee direction = "horizintal"><b>WELCOME TO MAANKULI CENTER</b></marquee>
		<hr/>



		</div>
			<div class="feature">
				<img src="images/food1.jpeg" alt="Feature 1">
				<h1>Healthy Meals</h1>
				
				<p>Our meals are prepared with fresh and healthy ingredients to keep our students fit and active.</p>
			</div>
			<div class="feature">
				<img src="images/food-order.jpg" alt="Feature 2">

				<h1>Customizable Menu</h1>
				
				<p>We offer a customizable menu so that our students can choose their meals as per their preferences.</p>
			</div>
			<div class="feature">
				<img src="images/food1.jpeg" alt="Feature 1">
				
				<h1>Online Ordering</h1>
				
				<p>Our students can easily order their meals online and track their orders in real-time.</p>
			
		</div>
	</section>
</div>	
</body>
</html>