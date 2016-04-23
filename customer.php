<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container" style="padding-top:15px;">
    <button class="btn btn-success btn-lg" data-title="Add" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-plus"></span> Add Customer</button>
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
            if(isset($_POST['edit_confirm_button_name'])) {
                $query = "UPDATE customer SET FirstName = '".$_POST['first_name']."', LastName = '".$_POST['last_name']."', Email = '".$_POST['email']."', Address = '".$_POST['address']."', HasMembership = ".($_POST['member_yes'] == "on"?'TRUE':'FALSE')." WHERE CustomerID = ".$_POST['edit_confirm_button_name'];
                $mysqli->query($query);
            }
            if(isset($_POST['add_confirm_button_name'])) {
                $mysqli->query("INSERT INTO customer VALUES(DEFAULT, '".$_POST['first_name_add']."', '".$_POST['last_name_add']."', '".$_POST['email_add']."', '".$_POST['address_add']."', ".($_POST['member_yes_add'] == "on"?'TRUE':'FALSE').")");
                $mysqli->query("INSERT INTO phone VALUES(".$mysqli->insert_id.", '".$_POST['phone_add']."')");
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
                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="javascript:$(\'#first_name\').attr(\'value\',\''.$firstName.'\');$(\'#last_name\').attr(\'value\',\''.$lastName.'\');$(\'#phone\').attr(\'value\',\''.$phone.'\');$(\'#email\').attr(\'value\',\''.$email.'\');$(\'#address\').attr(\'value\',\''.$address.'\');document.getElementById(\'member_no\').checked='.$member.'==0;document.getElementById(\'member_yes\').checked=!'.$member.'==0;$(\'#edit_confirm_button\').attr(\'value\',\''.$id.'\');">
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
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#d9534f; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="delete_modal_heading">Delete this entry</h4>
                </div>
                <div class="modal-body">
                    <div>Are you sure you want to delete this entry?</div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="customer.php">
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
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#337ab7; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="edit_modal_heading">Update customer</h4>
                </div>
                <form method="post" action="customer.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter address">
                        </div>
                        <label>Member:</label>
                        <label class="radio-inline">
                            <input type="radio" id="member_yes" name="member_yes">Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="member_no" name="member_no">No
                        </label>
                    </div>
                    <div class="modal-footer">
                            <button id="edit_confirm_button" name="edit_confirm_button_name" type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-ok-sign"></span> Submit
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> Cancel
                            </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#5cb85c; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="add_modal_heading">Add customer</h4>
                </div>
                <form method="post" action="customer.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="first_name_add">First Name:</label>
                            <input type="text" class="form-control" id="first_name_add" name="first_name_add" placeholder="Enter first name">
                        </div>
                        <div class="form-group">
                            <label for="last_name_add">Last Name:</label>
                            <input type="text" class="form-control" id="last_name_add" name="last_name_add" placeholder="Enter last name">
                        </div>
                        <div class="form-group">
                            <label for="phone_add">Phone:</label>
                            <input type="phone" class="form-control" id="phone_add" name="phone_add" placeholder="Enter phone">
                        </div>
                        <div class="form-group">
                            <label for="email_add">Email:</label>
                            <input type="email" class="form-control" id="email_add" name="email_add" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="address_add">Address:</label>
                            <input type="text" class="form-control" id="address_add" name="address_add" placeholder="Enter address">
                        </div>
                        <label>Member:</label>
                        <label class="radio-inline">
                            <input type="radio" id="member_yes_add" name="member_yes_add">Yes
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="member_no_add" name="member_no_add">No
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button id="add_confirm_button" name="add_confirm_button_name" type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-ok-sign"></span> Submit
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
