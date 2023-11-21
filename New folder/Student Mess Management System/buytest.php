<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">  
<script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">  
</script>    
    <link rel="stylesheet" href="style.css"/>
    <style>
    
    body {
    font-family: Arial, sans-serif;
    background-color: lightgray;
    margin: 0;
    padding: 0;
    align-items: center;
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

.nav-container2{
    background: white;
    justify-content:flex-end;
	display: flex;
	/*background: #8A7777;*/
	top:0;
	position: sticky;
	
}.nav-container2 .nav{
    display: flex;
    justify-content: center;
    align-items: center;
}
.nav-container2 .nav a{
    margin: 5px;
    display: block;
			padding: 2px;
			font-size: 1rem;
			text-align: right;
			text-decoration: none;
			transition: background-color 0.2s ease-in-out;
		

}



		h1 {
			text-align: center;
		}
		ul {
			list-style: none;
			padding: 0;
			margin: 2px 0;
			display: flex;
			justify-content: right;
		}
		li {
			margin: 0 10px;
		}
		a {
			display: block;
			padding: 2px;
			color:saddlebrown;
			font-size: 1.2rem;
			text-align: right;
			text-decoration: none;
			transition: background-color 0.2s ease-in-out;
		}
		a:hover {
            background-color:grey;
		
			color: black;
		}
		



 .purchase-container{
    justify-content: center;
    align-items: center;
    display: flex;
  
 } .purchase-container .purchase-content{
    width: 300px;
    background: white;
    width: 600px;
    text-align: center;
    justify-content: center;
    display: flex;
 }
 .content-wrapper{
    width: 400px;
    margin-top: 10px;
 }
 .checkbox{
    margin-right: 15px;
 }
 
 h1{
    text-align: center;
 }
 h2{
    font-size: 2rem;
 }
 h3{
    font-size: 1rem;
 }

</style>
</head>
<body


>
    
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

<div class="purchase-container" >
</div class='purchase-content'>
<h1 >Select Items</h1>
    

    <?php
    // Establish a connection to the database
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mess_management";
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to select items from the menu table
    $sql = "SELECT item_name, price FROM menu";

    $result = mysqli_query($conn, $sql);

    echo "<div class='purchase-container'>";
echo "<div class='purchase-content' >";
echo "<div class='content-wrapper'  >";

    if (mysqli_num_rows($result) > 0) {
        // Display the menu items and a checkbox for selection
        echo "<h2>Menu Items</h2>";
        echo "<form method='post'>";
        echo "<table><tr><th>Item Name</th><th>Price</th><th>Select</th></tr>";

        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["item_name"] . "</td><td>" . $row["price"] . "</td><td><input type='checkbox' name='selected_items[]' value='" . $row["item_name"] . "," . $row["price"] . "' onclick='updateTotalPrice()'></td></tr>";
        }

        echo "</table>";

        // Display the selected items and the total price
        echo "<h2>Selected Items</h2>";
        echo "<table id='selected_items_table'><tr><th>Item Name</th><th>Price</th></tr></table>";
        echo "<p>Total Price: <span id='total_price'></span></p>";

        // Display purchase button and phone number input box
        echo "<label for='phone'>Phone number:</label>";
        echo "<input type='text' id='phone' name='phone' required>";
        echo"<br><br>";
        echo "<button class= 'btn btn-success' type='submit' name='purchase'>Purchase</button>";
        echo "</form>";
    } else {
        echo "No items found in the menu.";
    }

    mysqli_close($conn);
    ?>

    <?php
    
    // Check if purchase button has been clicked and phone number has been inputted
if (isset($_POST['purchase']) && isset($_POST['phone'])) {

    // Initialize variables
    //$totalPrice = $_POST['totalPrice'];
        // Retrieve the selected items and the phone number
        $selectedItems = $_POST['selected_items'];
        $phoneNumber = $_POST['phone'];

        // Calculate the total price
        $totalPrice = 0;
        foreach ($selectedItems as $selectedItem) {
            $itemData = explode(",", $selectedItem);
            $totalPrice += floatval($itemData[1]);
        }


   

    //MPESA KEYS
    
    $CUSTOMER_KEY="CpeQbK9e1ChSDAl1W5yc5dIelXfFMAlL";
    $SECRET_KEY="n9xASsHZL4kbdZ0L";
    
    
    //ACCESS TOKEN URL
    $access_token_url="https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
    $headers=['content-Type:application/json; charset=utf8'];
    $curl=curl_init($access_token_url);
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_USERPWD, $CUSTOMER_KEY .':' .$SECRET_KEY);
    $result=curl_exec($curl);
   // echo $result;
    $status=curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $result=json_decode($result);
    $access_token= $result-> access_token;
    curl_close($curl);

    date_default_timezone_set('Africa/Nairobi');
$proccessRequestUrl='https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackUrl="https://drive.google.com/drive/folders/1vSYlciRi_fx-8xxqe0lYtCXbaJcNNlSg";
$pass_key="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$bussiness_short_code= "174379";                    //  "8390596";  
$TimeSetup=date("YmdHis");
$password=base64_encode($bussiness_short_code.$pass_key.$TimeSetup);
$phone=$_POST['phone'];

$amount= $totalPrice;        //$_POST['amount'];
$partyA=$phone;
$partyB='254113730593';
$AccountRefference='DEDAN KIMATHI STUDENT MESS';
$TransactionDesc='"dekutmess';
$Stk_push_header=['Content-Type:application/json', 'Authorization:Bearer ' .$access_token];
$curl=curl_init();
curl_setopt($curl,CURLOPT_URL,$proccessRequestUrl);
curl_setopt($curl,CURLOPT_HTTPHEADER,$Stk_push_header);//setting custom header

$curl_post_data=array(
    //fill all the records properly
    'BusinessShortCode' =>$bussiness_short_code ,
    'Password' => $password,
    'Timestamp' =>$TimeSetup,
    'TransactionType' =>'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $partyA,
    'PartyB' =>$bussiness_short_code ,
    'PhoneNumber' => $partyA,
    'CallBackURL' => $callbackUrl,
    'AccountReference' => $AccountRefference,
    'TransactionDesc' => $TransactionDesc
);

$data_string=json_encode($curl_post_data);
//echo    $data_string;

curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_POST,true);
curl_setopt($curl, CURLOPT_POSTFIELDS,$data_string);
$curl_response=curl_exec($curl);
$data=json_decode($curl_response);
//$CheckoutRequestID=$data->CheckoutRequestID;

//echo  $curl_response;

        // Process the order
        // This is just an example, replace this with your actual order processing code
        echo "<p>Thank you for your purchase!</p>";
        echo "<p>Your total price is: " . number_format($totalPrice, 2) . "</p>";
        echo "<p>Your phone number is: " . $phoneNumber . "</p>";
}
echo "</div>";
echo "</div>";


            
    ?>
<script>
        function updateTotalPrice() {
            // Get the selected items
            const selectedItems = document.getElementsByName("selected_items[]");
            let price=document.getElementById("#total_price");
            // Calculate the total price
            let totalPrice = 0;
            let selectedItemsHtml = "";
            for (let i = 0; i < selectedItems.length; i++) {
                if (selectedItems[i].checked) {
                    const itemData = selectedItems[i].value.split(",");
                    selectedItemsHtml += "<tr><td>" + itemData[0] + "</td><td>" + itemData[1] + "</td></tr>";
                    totalPrice += parseFloat(itemData[1]);
                }
            }

            // Update the selected items table
            const selectedItemsTable = document.getElementById("selected_items_table");
            selectedItemsTable.innerHTML = "<tr><th>Item Name</th><th>Price</th></tr>" + selectedItemsHtml;

            // Update the total price element
           const totalElem = document.getElementById("total_price");
            //const totalElem=document.getElementsByClassName(".price")
            price=document.getElementById("total_price");

            totalElem.innerHTML = totalPrice.toFixed(2);
        }

        function buyItems() {
            // Submit the form
            // Replace "form_id" with the actual ID of your form
            document.getElementById("form_id").submit();
        }
    </script>
</div>
</div>
</div>
</body>
</html>