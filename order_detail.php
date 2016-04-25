<?php
    if(!isset($_POST['view_details_name'])) {
        header('Location: order.php');
    }
?>
<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container" style="padding-top:15px;">
    <?php require "connect.php"; ?>
    <?php
        $mysqli = new mysqli($host, $user, $pass, $db);
        if (mysqli_connect_errno()) {
            echo '
                        <div class="alert alert-danger">
                              <strong>Error!</strong> Unable to connect to database.
                        </div>';
            die();
        }
        if(isset($_POST['view_details_name'])) {
            $orderID = $_POST['view_details_name'];
            $columns = "order.CustomerID, OrderID, FirstName, LastName, DropDate, PromiseDate, PickupDate";
            $query = "SELECT ".$columns." FROM `order` LEFT JOIN customer ON customer.CustomerID = order.CustomerID WHERE OrderID = '".$orderID."'";
            $CUSTOMER_ID_INDEX = 0;
            $ORDER_ID_INDEX = 1;
            $FIRST_NAME_INDEX = 2;
            $LAST_NAME_INDEX = 3;
            $DROP_DATE_INDEX = 4;
            $PROMISE_DATE_INDEX = 5;
            $PICKUP_DATE_INDEX = 6;

            $result = $mysqli->query($query);
            $rows = array();
            while ($row = $result->fetch_array()) {
                array_push($rows, $row);
            }

            if($rows[0][$PICKUP_DATE_INDEX] == null) {
                echo '
                    <button class="btn btn-success btn-lg" data-title="Pickup" data-toggle="modal" data-target="#pickup" onclick="javascript:$(\'#pickup_confirm_button\').attr(\'value\',\'' . $orderID . '\');">
                        <span class="glyphicon glyphicon-ok"></span> Pick Up
                    </button>';
            }
            echo '
                <button class="btn btn-danger btn-lg" data-title="Delete" data-toggle="modal" data-target="#delete" onclick="javascript:$(\'#delete_confirm_button\').attr(\'value\',\''.$orderID.'\')">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button>';
    ?>
    <h2>Order details</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Drop Date</th>
                <th>Promise Date</th>
                <?php
                    if($rows[0][$PICKUP_DATE_INDEX] != null) {
                        echo '<th>Pick-Up Date</th>';
                    }
                ?>
            </tr>
            <?php
                $lastCustomerID = -1;
                $result = $mysqli->query($query);
                foreach($rows as $row) {
                    $customerID = $row[$CUSTOMER_ID_INDEX];
                    $orderID = $row[$ORDER_ID_INDEX];
                    $firstName = $row[$FIRST_NAME_INDEX];
                    $lastName = $row[$LAST_NAME_INDEX];
                    $dropDate = $row[$DROP_DATE_INDEX];
                    $promiseDate = $row[$PROMISE_DATE_INDEX];
                    $pickupDate = $row[$PICKUP_DATE_INDEX];
                    echo '
                            <tr>
                                <td>'.$firstName.'</td>
                                <td>'.$lastName.'</td>
                                <td>'.$dropDate.'</td>
                                <td>'.$promiseDate.'</td>';
                            if($pickupDate != null) {
                                echo '<td>'.$pickupDate.'</td>';
                            }
                    echo '  </tr>
                        ';
                }
            ?>
        </table>
    </div>
    <?php
        $columns = 'Description, Quantity, (Quantity * Price) AS Price, (Quantity * HoursRequired) AS Hours, Instructions';
        $query = "SELECT " . $columns . " FROM order_item LEFT JOIN service ON order_item.ServiceID = service.ServiceID WHERE OrderID = '" . $orderID . "'";
        $DESCRIPTION_INDEX = 0;
        $QUANTITY_INDEX = 1;
        $PRICE_INDEX = 2;
        $HOURS_INDEX = 3;
        $INSTRUCTIONS_INDEX = 4;

        $result = $mysqli->query($query);

        $rows = array();
        while ($row = $result->fetch_array()) {
            array_push($rows, $row);
        }

        $result = $mysqli->query('SELECT FirstName, LastName FROM customer, `order` WHERE OrderID = \''.$orderID.'\' AND `order`.CustomerID = customer.CustomerID');
        if($row = $result->fetch_array()) {
//                echo '<h3>'.$row[0].' '.$row[1].'</h3>';
        }
        echo '<h3>Order items</h3>';
    ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Hours</th>
                <th>Instructions</th>
            </tr>
            <?php
                foreach($rows as $row) {
                    echo '<tr>';
                    echo '<td>'.$row[$DESCRIPTION_INDEX].'</td>';
                    echo '<td>'.$row[$QUANTITY_INDEX].'</td>';
                    echo '<td>'.$row[$PRICE_INDEX].'</td>';
                    echo '<td>'.$row[$HOURS_INDEX].'</td>';
                    echo '<td>'.$row[$INSTRUCTIONS_INDEX].'</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
    <?php
        }
    ?>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#d9534f; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="delete_modal_heading">Delete this order</h4>
                </div>
                <div class="modal-body">
                    <div>Are you sure you want to delete this order?</div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="order.php">
                        <button id="delete_confirm_button" name="delete_confirm_button_name" type="submit" class="btn btn-danger">
                            <span class="glyphicon glyphicon-ok-sign"></span> Yes
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> No
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pickup" tabindex="-1" role="dialog" aria-labelledby="pickup" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#5cb85c; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="pickup_modal_heading">Pick Up Order</h4>
                </div>
                <form method="post" action="order.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pickup_payment_method">Payment method:</label>
                            <input type="tel" class="form-control" id="pickup_payment_method" name="pickup_payment_method_name" placeholder="Enter payment method">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="pickup_confirm_button" name="pickup_confirm_button_name" type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-ok-sign"></span> Yes
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> No
                        </button>
                </form>
            </div>
        </div>
    </div>
    <?php
        $mysqli->close();
    ?>
</div>
</body>
</html>
