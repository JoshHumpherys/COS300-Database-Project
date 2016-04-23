<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div class="container">
    <h2>Customers</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Member</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <tr>
                    <td>Josh</td>
                    <td>Humpherys</td>
                    <td>800-555-1234</td>
                    <td>joshua.humpherys@gmail.com</td>
                    <td>256 Hello World St</td>
                    <td>Yes</td>
                    <td>
                        <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>David</td>
                    <td>Reed</td>
                    <td>706-555-8882</td>
                    <td>david.reed@foobarbaz.com</td>
                    <td>128 Asdf Rd</td>
                    <td>No</td>
                    <td>
                        <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Josh</td>
                    <td>Humpherys</td>
                    <td>800-555-1234</td>
                    <td>joshua.humpherys@gmail.com</td>
                    <td>1024 Binary Dr</td>
                    <td>Yes</td>
                    <td>
                        <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
