<?php
// Establish a connection to the database
$host = "localhost";
$username = "root";
$password = "";
$dbname = "mess_management";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
$message = "";
if (isset($_POST['submit'])) {
  $item_name = $_POST['item_name'];
  $price = $_POST['price'];

  // Check if item already exists
  $sql = "SELECT * FROM menu WHERE item_name='$item_name'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $message = "Item already exists.";
  } else {
    // Add new item
    $sql = "INSERT INTO menu (item_name, price) VALUES ('$item_name', '$price')";
    if ($conn->query($sql) === TRUE) {
      $message = "Item added successfully.";
    } else {
      $message = "Error adding item: " . $conn->error;
    }
  }
}

// Handle update or delete
if (isset($_POST['action'])) {
  $action = $_POST['action'];
  $id = $_POST['id'];
  if ($action === 'update') {
    $item_name = $_POST['item_name'];
    $price = $_POST['price'];
    $sql = "UPDATE menu SET item_name='$item_name', price='$price' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
      $message = "Item updated successfully.";
    } else {
      $message = "Error updating item: " . $conn->error;
    }
  } else if ($action === 'delete') {
    $sql = "DELETE FROM menu WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
      $message = "Item deleted successfully.";
    } else {
      $message = "Error deleting item: " . $conn->error;
    }
  }
}

// Get menu items
$sql = "SELECT * FROM menu";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Menu</title>
  <link rel="stylesheet" href="styles.css"/>
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
    
  <h1>Menu</h1>
  <p>Add new items to the menu</p>
  <form method="post">
    <label>Item Name:</label>
    <input type="text" name="item_name" required>
    <label>Price:</label>
    <input type="number" name="price" required>
    <button type="submit" name="submit">Add Item</button>
  </form>
  <p><?php echo $message; ?></p>
  <table>
    <thead>
      <tr>
        <th>Item Name</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <form method="post">
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
              <td><input type="text" name="item_name" value="<?php echo $row['item_name']; ?>" required></td>
               <td><input type="number" name="price" value="<?php echo $row['price']; ?>" required></td>
          <td>
            <button type="submit" name="action" value="update">Update</button>
            <button type="submit" name="action" value="delete">Delete</button>
          </td>
        </form>
      </tr>
      <?php
    }
  } else {
    ?>
    <tr>
      <td colspan="3">No items found.</td>
    </tr>
    <?php
  }
  ?>
</tbody>

