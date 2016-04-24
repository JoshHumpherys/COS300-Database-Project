<!DOCTYPE html>
<html>
<?php require "header.php"; ?>
<body>
<div id="image" style="width:100%; overflow:hidden;">
    <div id="carousel_text" style="position:absolute; padding-left:15px">
        <h1>Welcome to Marcia's Dry Cleaners Management Software!</h1>
        <h3>Providing functionality for customer, order and service tracking</h3>
        <br/>
        <a href="javascript:smoothScrollTo('#help')">
            <button class="btn btn-primary btn-lg">Click here for help!</button>
        </a>
    </div>
    <img id="img0" src="dryclean.jpg" style="min-width:100%; min-height:100%;"/>
</div>
<div id="help" class="container-fluid text-center" style="background-color:#555; color:#fff">
    <h3>Wondering how to use this software?</h3>
    <p>
        <br/>
        The black navigation bar at the top of the page provides links to data viewing and data management options
        <br/>
        Click on "Customer" to add, edit, delete, or view customer data
        <br/>
        Click on "Order" to add, edit, delete, or view an order
        <br/>
        Click on "Service" to add, edit, delete, or view services
    </p>
</div>
<?php require "footer.php"; ?>

<script type="text/javascript">
    var smoothScrollTo = function (id) {
        $('html, body').animate({scrollTop: $(id).offset().top}, 900, function () {
            window.location.hash = id;
        });
    };
</script>
</body>
</html>