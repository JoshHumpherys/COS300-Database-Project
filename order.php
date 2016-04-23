<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container">
<?php 
$host = "localhost";
$user = "Jonathan";
$pass = "play4679";
$db = "marciadb";

$mysqli = new mysqli($host, $user, $pass, $db);
$query1 = "select serviceid, description, count(*) as num_row
            from service";
$services=$mysqli->query($query1);
?>
    <form action="order.php" method="post">
        <H1>Add Order</H1>

        First Name: <input type="text" , name="FirstName" size="35">
        Last Name: <input type="text" , name="LastName" , size="35">
        
        <?php
        $select= 'Service: <select name="action_type">';
        while($rs=$services->fetch_array()){
            $select.='<option value="'.$rs[0].'">'.$rs[1].'</option>';
        }
        $select.='</select>';
        echo $select;
        ?>
        Type Of Payment: <select name="payment_type">
            <option value="Credit">Credit</option>
            <option value="Debit">Debit</option>
            <option value="Cash">Cash</option>
            <option value="Check">Check</option>
        </select>
        <input type="submit" , name="addOrder" , value="Add">
    </form>
    <?php
    

    if (mysqli_connect_errno()) {
        die("Unable to connect!");
    }
    if(isset($_POST["addOrder"])){
        $firstName=$_POST["FirstName"];
        $lastName=$_POST["LastName"];
        $service=$_POST["action_type"];
        $payment=$_POST["payment_type"];
        date_default_timezone_set("America/New_York");
        $cur_date=date('Y-m-d-h');
        $query2 = "SELECT customerID 
                    FROM customer 
                    WHERE FirstName = '".$firstName."'
                    and LastName = '".$lastName."'";
        $result = $mysqli->query($query2);
        $query3 ="Select hoursrequired
                from service
                where serviceid = '".$service."'";
        $result2 = $mysqli->query($query3);
        $hourstoadd =$result2->fetch_array();
        $addedTime=$hourstoadd[0]+date('h');
        $promisedtime=new DateTime($cur_date);
        $promisedtime->add(new DateInterval('PT'.$addedTime.'H'));
        $promisedate=$promisedtime->format('Y-m-d-h');
        if(!($row = $result->fetch_array())){
            echo 'Customer does not exist. Please go to customer tab and make an account';
        }
        else{
            $customerID = $row[0];
            $query4 = "insert into `order`(dropdate, promisedate, methodofPayment,customerID) values('$cur_date','$promisedate','$payment','.$customerID.');";  
            $mysqli->query($query4);
        }
    } 
    ?>
</div>
</body>
</html>
