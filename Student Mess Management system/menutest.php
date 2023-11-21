<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .delete-icon, .update-icon {
  display: inline-block;
  width: 24px;
  height: 24px;
  background-repeat: no-repeat;
  background-position: center;
  background-size: 16px 16px;
  cursor: pointer;
  opacity: 0.5;
  transition: opacity 0.3s ease;
}

td:hover .delete-icon, td:hover .update-icon {
  opacity: 1;
}

.delete-icon {
  background-image: url("delete-icon.png");
}

.update-icon {
  background-image: url("update-icon.png");
}

    </style>
</head>
<body>

    <button type="button">Create New</button>
    
    
   <table>
        <thead>
          <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Date purchased</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <th>ugali</th>
            <td>10</td>
            <th>10:30</th>
            <td>
              <a href="#" class="delete-icon" title="Delete"></a>
              <a href="#" class="update-icon" title="Update"></a>
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>Rice</td>
            <td>20</td>
            <th>10:30</th>
            <td>
              <a href="#" class="delete-icon" title="Delete"></a>
              <a href="#" class="update-icon" title="Update"></a>
            </td>
          </tr>
        </tbody>
    </table>
</body>
</html>