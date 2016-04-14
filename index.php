<html>
<head>
<title>Marica Dry Cleaning Service Maintenance</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<H1>Marica Dry Cleaning Customer Maintenance</H1>
<ul>
<li><a href="CustomerForm.php">Customer</a></li>
<li><a href="OrderForm.php">Order</a></li>
<li><a href="PickUp.php">Pick Up</a></li>
<li><a href="ServiceMaintForm.php">Service</a></li>
</ul>
<br>
<form action="index.php" method="post">
<select name="action_type">
<option value="add">Add</option>
<option value="update">Update</option>
<option value="delete">Delete</option>
</select>
Cust Id: <input type="number", name="CustId", min="0", max="999", step="1">
First Name: <input type="text", name="FirstName" size="35">
Last Name: <input type="text", name="LastName", size="35">
<br>
Address: <input type="text", name="Address", size="35">
City: <input type="text", name="City", size="15">
Zip: <input type="text", name="Zip", size="5">
Phone: <input type="text", name="Phone", size="10">
<input type="submit" value="Send">
</form>
<?php
// set server access variables

?>
</body>
</html>
