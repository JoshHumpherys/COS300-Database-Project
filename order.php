<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<form action="order.php" method="post">
    <select name="action_type">
        <option value="add">Add</option>
        <option value="update">Update</option>
        <option value="delete">Delete</option>
    </select>
    <H1>Add Orders</H1>

    First Name: <input type="text" , name="FirstName" size="35">
    Last Name: <input type="text" , name="LastName" , size="35">
    <select name="action_type">
        <option value="dry clean">Dry Clean</option>
        <option value="wash shirt">Wash Shirt</option>
        <option value="sew button">Sew Button</option>
        <option value="Press Pants">Press Pants</option>
        <option value="Iron Shirt">Iron Shirt</option>
        <input type="submit" , name="addOrder" , value="Add">
    </select>
</form>
<?php

?>
</body>
</html>
