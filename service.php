<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container">
    <h1 align="center">Marcia's Dry Cleaning Services</h1>
    <br>
    <form action="service.php" method="post">
        <ul style="text-align:left; list-style-type:none; display:block;font-size:20px; ">
            <li>Options: 
                <select name="action_type">
                    <option value="add">Add</option>
                    <option value="update">Update</option>
                    <option value="delete">Delete</option>
                </select>
            </li>
            <li>Service ID: <input type="number" , name="serviceID" , min="0" , max="999999" , step="1",></li>
            <li>Description: <input type="text" , name="description" size="35"></li>
            <li>Price: <input type="number" , name="price" , size="5", step="any"></li>
            <li>Hours Required: <input type="number" , name="hours" , size="5"></li>
        </ul>
        <div style="margin:auto;"> 
            <input type="submit" value="Send" name="submit">
        </div>
        
    </form>
    <br>
    <?php
    // server variables set to default
        $host = "localhost";
        $user = "Hunt";
        $pass = "PW300";
        $db = "marciadb";
        $mysqli = new mysqli($host, $user, $pass, $db);

        // check for connection errors
        if (mysqli_connect_errno()) {
            die("Unable to connect!");
        }

        if(isset($_POST['submit']) )
        {
            $response = $_POST['action_type'];
            if($response == 'add'){
                $description = $_POST['description'];
                $price = $_POST['price'];
                $hours = $_POST['hours'];
                
                $randomID = rand(0,200);
                $query = "insert into service (ServiceID, Description, Price, HoursRequired) values ('".$randomID."', '".$description."', '".$price."','".$hours."')";
                
                 if ($mysqli->query($query) === TRUE) {
                     echo "New record created successfully";
                 } 
            } else if ($response == 'update') {
                $id = $_POST['serviceID']; 
                $description = $_POST['description']; 
                $price = $_POST['price']; 
                $hours = $_POST['hours']; 
                
                $query = "SELECT * FROM service where ServiceID = '".$id."'";

                $result = $mysqli->query($query);
                $row = $result->fetch_array();
                
                //Checks for nulls in other fields
                if ($description == null){
                    $description = $row[1];
                }
                if ($price == null){
                    $price = $row[2];
                }
                if ($hours == null){
                    $hours = $row[3];
                }
                
                $sql = "Update Service Set Description = '".$description."', Price = '".$price."', HoursRequired = '".$hours."' where ServiceID = '".$id."'";

                if ($mysqli->query($sql) == TRUE) {
                        echo "Record updated successfully";
                } 
            } else if ($response == 'delete') {
                $find = $_POST['serviceID']; 
                
                $sql = "DELETE FROM service WHERE ServiceID=".$find."";

                
                if ($mysqli->query($sql) == TRUE) {
                        echo "Record deleted successfully";
                } 
            }
            // - - - snip - - - 
        }
    
        //if(isset($_POST['view'])) 
            // create query
            $query = "SELECT * FROM service order by serviceID asc";
            echo "<br>";
            echo '<H3 style="text-align:center;">Services Provided</H3>';
            // execute query
            if ($result = $mysqli->query($query)) {
                // see if any rows were returned
                if ($result->num_rows > 0) {
                    // yes
                    // print them one after another
                    echo '<table cellpadding=10 border=3 style="text-align:center;font-size:20px; margin:auto; padding:40px;">';
                    echo "<tr>";
                    echo "<th>Service ID</th>";
                    echo "<th>Description</th>";
                    echo "<th>Price</th>";
                    echo "<th>Hours Required</th>";

                    echo "</tr>";
                    while($row = $result->fetch_array()) {
                        echo "<tr>";
                        echo "<td>".$row[0]."</td>";
                        echo "<td>".$row[1]."</td>";
                        echo "<td>".$row[2]."</td>";
                        echo "<td>".$row[3]."</td>";
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
            }   else {
                // print error message
                echo "Error in query: $query. ".$mysqli->error;
            }
                // close connection
                $mysqli->close();
        

    ?>
</div>
</body>
</html>
