<html>
<head>
<title>Marica Dry Cleaning Service Maintenance</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<H1>Marica Dry Cleaning Order Form</H1>
<ul>
<li><a href="index.php">Customer</a></li>
<li><a href="OrderForm.php">Order</a></li>
<li><a href="PickUp.php">Pick Up</a></li>
<li><a href="ServiceMaintForm.php">Service</a></li>
</ul>
<br>
<form action="OrderForm.php" method="post">
</select>
<H1>Add Orders</H1>

First Name: <input type="text", name="FirstName" size="35">
Last Name: <input type="text", name="LastName", size="35">
<select name="action_type">
<option value="dry clean">Dry Clean</option>
<option value="wash shirt">Wash Shirt</option>
<option value="sew button">Sew Button</option>
<option value="Press Pants">Press Pants</option>
<option value="Iron Shirt">Iron Shirt</option>
<input type="submit", name= "addOrder", value="Add">
</form>
<?php

?>
</body>
</html>
