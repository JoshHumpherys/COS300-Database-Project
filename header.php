<head>
    <title>Marcia's Dry Cleaners</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<nav class="navbar navbar-inverse navbar-static-top" style="margin-bottom:0; box-shadow: 0 0 8px 0 rgba(0,0,0,.1);">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Marcia's Dry Cleaners</a>
        </div>
        <ul class="nav navbar-nav">
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'customer.php') echo 'class="active"' ?>><a
                    href="customer.php">Customer</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'order.php') echo 'class="active"' ?>><a
                    href="order.php">Order</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'pickup.php') echo 'class="active"' ?>><a
                    href="pickup.php">Pickup</a></li>
            <li <?php if (basename($_SERVER['PHP_SELF']) == 'service.php') echo 'class="active"' ?>><a
                    href="service.php">Service</a></li>
        </ul>
    </div>
</nav>
