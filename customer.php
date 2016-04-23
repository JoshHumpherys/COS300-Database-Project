<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container">
    <h2>Customers</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Member</th>
                <th>Edit</th>
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

            if(isset($_POST['delete_confirm_button_name'])) {
                $mysqli->query("DELETE FROM customer WHERE CustomerID = ".$_POST['delete_confirm_button_name']);
            }

            $columns = "customer.CustomerID, FirstName, LastName, Email, Address, HasMembership, Phone";
            $query = "SELECT ".$columns." FROM customer LEFT JOIN phone ON customer.CustomerID = phone.CustomerID";
            $CUSTOMER_ID_INDEX = 0;
            $FIRST_NAME_INDEX = 1;
            $LAST_NAME_INDEX = 2;
            $EMAIL_INDEX = 3;
            $ADDRESS_INDEX = 4;
            $HAS_MEMBERSHIP_INDEX = 5;
            $PHONE_INDEX = 6;

            $lastID = -1;
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array()) {
                $id = $row[$CUSTOMER_ID_INDEX];
                $firstName = $row[$FIRST_NAME_INDEX];
                $lastName = $row[$LAST_NAME_INDEX];
                $email = $row[$EMAIL_INDEX];
                $address = $row[$ADDRESS_INDEX];
                $member = $row[$HAS_MEMBERSHIP_INDEX];
                $phone = $row[$PHONE_INDEX];
                $extraPhone = $id == $lastID;
                if($id == $lastID) {
                    $firstName = $lastName = $email = $address = '';
                    $member = -1;
                }
                $lastID = $id;
                echo '
                    <tr>
                        <td>'.$firstName.'</td>
                        <td>'.$lastName.'</td>
                        <td>'.$phone.'</td>
                        <td>'.$email.'</td>
                        <td>'.$address.'</td>
                        <td>'.($member==-1?'':($member==0?'No':'Yes')).'</td>'.(!$extraPhone?'
                        <td>
                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" onclick="javascript:$(\'#delete_confirm_button\').attr(\'value\',\''.$id.'\')">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>':'<td></td><td></td>').'
                    </tr>
                ';
            }
            $mysqli->close();
            ?>
        </table>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #d9534f;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
                </div>
                <div class="modal-body">
                    <div>Are you sure you want to delete this entry?</div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="customer.php">
                        <button id="delete_confirm_button" name="delete_confirm_button_name" type="submit" class="btn btn-danger" value="12345">
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
</div>
</body>
</html>
