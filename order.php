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
    ?>
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
                if(isset($_POST['pickup_confirm_button_name'])) {
                    if($mysqli->query("UPDATE `order` SET PickupDate = NOW(), MethodOfPayment = '".$_POST['pickup_payment_method_name']."' WHERE OrderID = ".$_POST['pickup_confirm_button_name'])) {
                        echo '
                        <div class="alert alert-success">
                              <strong>Success!</strong> Order picked up successfully.
                        </div>';
                    } else {
                        echo '
                        <div class="alert alert-danger">
                              <strong>Error!</strong> Failed to pick up order.
                        </div>';
                    };
                }
                if(isset($_POST['delete_confirm_button_name'])) {
                    if($mysqli->query("DELETE FROM `order` WHERE OrderID = '".$_POST['delete_confirm_button_name']."'")) {
                        echo '
                        <div class="alert alert-success">
                              <strong>Success!</strong> Order deleted successfully.
                        </div>';
                    } else {
                        echo '
                        <div class="alert alert-danger">
                              <strong>Error!</strong> Failed to delete order.
                        </div>';
                    };
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
                    $lastCustomerID = $customerID;
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
            ?>
        </table>
    </div>
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
