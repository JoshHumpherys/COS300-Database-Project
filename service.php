<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container" style="padding-top:15px">
    <button style="margin-bottom:15px" class="btn btn-success btn-lg" data-title="Add" data-toggle="modal" data-target="#add"><span class="glyphicon glyphicon-plus"></span> Add Service</button>
    <h2>Services</h2>
    <table class="table table-bordered table-striped">
        <tr>
            <th>Description</th>
            <th>Price</th>
            <th>Hours Required</th>
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

        if(isset($_POST['add_confirm_button_name'])){
            $description = $_POST['description_add_name'];
            $price = $_POST['price_add_name'];
            $hours = $_POST['hours_add_name'];

            $query = "INSERT INTO service VALUES (DEFAULT, '".$description."', '".$price."','".$hours."')";

             if ($mysqli->query($query) === TRUE) {
                 echo '
                <div class="alert alert-success">
                      <strong>Success!</strong> New record created successfully.
                </div>';
             } else {
                 echo '
                <div class="alert alert-danger">
                      <strong>Error!</strong> Failed to create new record.
                </div>';
             }
        } else if(isset($_POST['edit_confirm_button_name'])) {
            $id = $_POST['edit_confirm_button_name'];
            $description = $_POST['description_edit_name'];
            $price = $_POST['price_edit_name'];
            $hours = $_POST['hours_edit_name'];

            $query = "UPDATE service SET Description = '".$description."', Price = '".$price."', HoursRequired = '".$hours."' WHERE ServiceID = '".$id."'";

            if ($mysqli->query($query) === TRUE) {
                echo '
                <div class="alert alert-success">
                      <strong>Success!</strong> Record updated successfully.
                </div>';
            } else {
                echo '
                <div class="alert alert-danger">
                      <strong>Error!</strong> Failed to update record.
                </div>';
            }
        } else if (isset($_POST['delete_confirm_button_name'])) {
            $id = $_POST['delete_confirm_button_name'];

            $query = "DELETE FROM service WHERE ServiceID=".$id."";

            if ($mysqli->query($query) === TRUE) {
                echo '
                <div class="alert alert-success">
                      <strong>Success!</strong> Record deleted successfully.
                </div>';
            } else {
                echo '
                <div class="alert alert-danger">
                      <strong>Error!</strong> Failed to delete record.
                </div>';
            }
        }

        $query = "SELECT ServiceID, Description, Price, HoursRequired FROM service";
        $SERVICE_ID_INDEX = 0;
        $DESCRIPTION_INDEX = 1;
        $PRICE_INDEX = 2;
        $HOURS_REQUIRED_INDEX = 3;
        if ($result = $mysqli->query($query)) {
            if ($result->num_rows > 0) {
                while($row = $result->fetch_array()) {
                    $id = $row[$SERVICE_ID_INDEX];
                    $description = $row[$DESCRIPTION_INDEX];
                    $price = $row[$PRICE_INDEX];
                    $hours = $row[$HOURS_REQUIRED_INDEX];
                    echo '
                        <tr>
                            <td>'.$description.'</td>
                            <td>'.$price.'</td>
                            <td>'.$hours.'</td>
                            <td>
                                <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" onclick="javascript:$(\'#edit_confirm_button\').attr(\'value\',\''.$id.'\');$(\'#description_edit\').attr(\'value\',\''.$description.'\');$(\'#price_edit\').attr(\'value\',\''.$price.'\');$(\'#hours_edit\').attr(\'value\',\''.$hours.'\');">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" onclick="javascript:$(\'#delete_confirm_button\').attr(\'value\',\''.$id.'\');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    ';
                }
            }
            $result->close();
        }
        $mysqli->close();
    ?>
    </table>
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#5cb85c; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="add_modal_heading">Add service</h4>
                </div>
                <form method="post" action="service.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description_add">Description:</label>
                            <input type="text" class="form-control" id="description_add" name="description_add_name" placeholder="Enter description">
                        </div>
                        <div class="form-group">
                            <label for="price_add">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="price_add" name="price_add_name" placeholder="Enter price">
                        </div>
                        <div class="form-group">
                            <label for="hours_add">Hours required:</label>
                            <input type="number" class="form-control" id="hours_add" name="hours_add_name" placeholder="Enter hours required">
                        </div>
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
    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#337ab7; color:#fff;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                    <h4 class="modal-title custom_align" id="edit_modal_heading">Edit service</h4>
                </div>
                <form method="post" action="service.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="description_edit">Description:</label>
                            <input type="text" class="form-control" id="description_edit" name="description_edit_name" placeholder="Enter description">
                        </div>
                        <div class="form-group">
                            <label for="price_edit">Price:</label>
                            <input type="number" step="0.01" class="form-control" id="price_edit" name="price_edit_name" placeholder="Enter price">
                        </div>
                        <div class="form-group">
                            <label for="hours_edit">Hours required:</label>
                            <input type="number" class="form-control" id="hours_edit" name="hours_edit_name" placeholder="Enter hours required">
                        </div>
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
                    <form method="post" action="service.php">
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
</div>
</body>
</html>
