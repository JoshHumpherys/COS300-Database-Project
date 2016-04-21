<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container">
    <h1 align="center">Marcia's Dry Cleaning Services</h1>
    <br>
    <form action="service.php" method="post">
        <ul style="text-align:left; list-style-type:none; display:block;font-size:20px;">
            <li>Options: 
                <select name="action_type">
                    <option value="add">Add</option>
                    <option value="update">Update</option>
                    <option value="delete">Delete</option>
                </select>
            </li>
            <li>Service ID: <input type="number" , name="serviceID" , min="0" , max="999" , step="1"></li>
            <li>Description: <input type="text" , name="description" size="35"></li>
            <li>Price: <input type="number" , name="price" , size="5"></li>
            <li>Hours Required: <input type="number" , name="hours" , size="5"></li>
        </ul>
        
        <input type="submit" value="Send">
        <input type="button" value="View All">
    </form>
    <?php
    // set server access variables
        $host = "localhost";
        $user = "Hunt";
        $pass = "PW300";
        $db = "marciadb";
        $mysqli = new mysqli($host, $user, $pass, $db);

        // check for connection errors
        if (mysqli_connect_errno()) {
            die("Unable to connect!");
        }

        // create query
        $query = "SELECT * FROM service";

        // execute query
        if ($result = $mysqli->query($query)) {
            // see if any rows were returned
            if ($result->num_rows > 0) {
                // yes
                // print them one after another
                echo "<table cellpadding=10 border=1>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Country</th>";
                echo "<th>Animal</th>";
                echo "</tr>";
                while($row = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<td>".$row[0]."</td>";
                    echo "<td>".$row[1]."</td>";
                    echo "<td>".$row[2]."</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            else {
                // no
                // print status message
                echo "No rows found!";
            }

            // free result set memory
            $result->close();
        }else {
    // print error message
    echo "Error in query: $query. ".$mysqli->error;
}
// close connection
$mysqli->close();
    ?>
</div>
</body>
</html>
