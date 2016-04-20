<head>
    <title>Marica Dry Cleaning Service Maintenance</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <div class="jumbotron" style="margin-bottom: 0;">
        <div class="container">
            <h1>Marcia's Dry Cleaners</h1>
        </div>
    </div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Marcia's Dry Cleaners</a>
            </div>
            <ul class="nav navbar-nav">
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"' ?>><a href="index.php">Customer</a></li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'order.php') echo 'class="active"' ?>><a href="order.php">Order</a></li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'pickup.php') echo 'class="active"' ?>><a href="pickup.php">Pickup</a></li>
                <li <?php if(basename($_SERVER['PHP_SELF']) == 'service.php') echo 'class="active"' ?>><a href="service.php">Service</a></li>
            </ul>
        </div>
    </nav>
</head>
