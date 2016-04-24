<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container" style="padding-top:15px;">
    <button style="margin-bottom:15px" class="btn btn-success btn-lg" data-title="Add" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-plus"></span> Add Order</button>
    <h2>Active Orders</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Drop Date</th>
                <th>Promise Date</th>
                <th>Pick Up</th>
                <th>View Details</th>
                <th>Delete</th>
            </tr>
            <?php
                $host = "localhost";
                $user = "Hunt";
                $pass = "PW300";
                $db = "marciadb";
                $mysqli = new mysqli($host, $user, $pass, $db);
                if (mysqli_connect_errno()) {
                    die("Unable to connect!");
                }

                if(isset($_POST['pickup_confirm_button_name'])) {
                    // TODO write query
                }
                if(isset($_POST['add_confirm_button_name'])) {
                    // TODO write query
                }

                $columns = "order.CustomerID, OrderID, FirstName, LastName, DropDate, PromiseDate, PickupDate";
                $query = "SELECT ".$columns." FROM `order` LEFT JOIN customer ON customer.CustomerID = order.CustomerID";
                $CUSTOMER_ID_INDEX = 0;
                $ORDER_ID_INDEX = 1;
                $FIRST_NAME_INDEX = 2;
                $LAST_NAME_INDEX = 3;
                $DROP_DATE_INDEX = 4;
                $PROMISE_DATE_INDEX = 5;
                $PICKUP_DATE_INDEX = 6;

                $lastCustomerID = -1;
                $result = $mysqli->query($query);
                while ($row = $result->fetch_array()) {
                    $pickupDate = $row[$PICKUP_DATE_INDEX];
                    if($pickupDate != '') {
                        continue;
                    }
                    $customerID = $row[$CUSTOMER_ID_INDEX];
                    $orderID = $row[$ORDER_ID_INDEX];
                    $firstName = $row[$FIRST_NAME_INDEX];
                    $lastName = $row[$LAST_NAME_INDEX];
                    $dropDate = $row[$DROP_DATE_INDEX];
                    $promiseDate = $row[$PROMISE_DATE_INDEX];
                    $extraOrder = $customerID == $lastCustomerID;
                    if($customerID == $lastCustomerID) {
                        $firstName = $lastName = '';
                    }
                    $lastID = $customerID;
                    echo '
                        <tr>
                            <td>'.$firstName.'</td>
                            <td>'.$lastName.'</td>
                            <td>'.$dropDate.'</td>
                            <td>'.$promiseDate.'</td>
                            <td>
                                <button class="btn btn-success btn-xs" data-title="Pickup" data-toggle="modal" data-target="#pickup" onclick="javascript:$(\'#pickup_confirm_button\').attr(\'value\',\''.$orderID.'\');">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-xs" data-title="Info" data-toggle="modal" data-target="#info">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" onclick="javascript:$(\'#delete_confirm_button\').attr(\'value\',\''.$orderID.'\')">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    ';
                }
                $mysqli->close();
            ?>
        </table>
    </div>
    <h2>Order History</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Drop Date</th>
                <th>Promise Date</th>
                <th>Pick-Up Date</th>
                <th>Method of Payment</th>
                <th>View Details</th>
                <th>Delete</th>
            </tr>
            <?php
            $host = "localhost";
            $user = "Hunt";
            $pass = "PW300";
            $db = "marciadb";
            $mysqli = new mysqli($host, $user, $pass, $db);
            if (mysqli_connect_errno()) {
                die("Unable to connect!");
            }

            if(isset($_POST['pickup_confirm_button_name'])) {
                // TODO write query
            }
            if(isset($_POST['add_confirm_button_name'])) {
                // TODO write query
            }

            $columns = "order.CustomerID, OrderID, FirstName, LastName, DropDate, PromiseDate, PickupDate, MethodOfPayment";
            $query = "SELECT ".$columns." FROM `order` LEFT JOIN customer ON customer.CustomerID = order.CustomerID";
            $CUSTOMER_ID_INDEX = 0;
            $ORDER_ID_INDEX = 1;
            $FIRST_NAME_INDEX = 2;
            $LAST_NAME_INDEX = 3;
            $DROP_DATE_INDEX = 4;
            $PROMISE_DATE_INDEX = 5;
            $PICKUP_DATE_INDEX = 6;
            $METHOD_OF_PAYMENT_INDEX = 7;

            $lastCustomerID = -1;
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array()) {
                $pickupDate = $row[$PICKUP_DATE_INDEX];
                if($pickupDate == '') {
                    continue;
                }
                $customerID = $row[$CUSTOMER_ID_INDEX];
                $orderID = $row[$ORDER_ID_INDEX];
                $firstName = $row[$FIRST_NAME_INDEX];
                $lastName = $row[$LAST_NAME_INDEX];
                $dropDate = $row[$DROP_DATE_INDEX];
                $promiseDate = $row[$PROMISE_DATE_INDEX];
                $methodOfPayment = $row[$METHOD_OF_PAYMENT_INDEX];
                $extraOrder = $customerID == $lastCustomerID;
                if($customerID == $lastCustomerID) {
                    $firstName = $lastName = '';
                }
                $lastID = $customerID;
                echo '
                        <tr>
                            <td>'.$firstName.'</td>
                            <td>'.$lastName.'</td>
                            <td>'.$dropDate.'</td>
                            <td>'.$promiseDate.'</td>
                            <td>'.$pickupDate.'</td>
                            <td>'.$methodOfPayment.'</td>
                            <td>
                                <button class="btn btn-primary btn-xs" data-title="Info" data-toggle="modal" data-target="#info">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" onclick="javascript:$(\'#delete_confirm_button\').attr(\'value\',\''.$orderID.'\')">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    ';
            }
            $mysqli->close();
            ?>
        </table>
    </div>
    <!--
<?php
$host = "localhost";
$user = "Hunt";
$pass = "PW300";
$db = "marciadb";

$mysqli = new mysqli($host, $user, $pass, $db);
$query1 = "select serviceid, description
            from service";
$services=$mysqli->query($query1);
?>
    <form action="order.php" method="post">
        <H1>Add Order</H1>

        First Name: <input type="text" , name="FirstName" size="35">
        Last Name: <input type="text" , name="LastName" , size="35">

        <?php
        $select= 'Service: <select name="action_type">';
        while($rs=mysqli_fetch_array($services)){
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
    -->
</div>
</body>
</html>
