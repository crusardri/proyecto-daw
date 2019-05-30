<?php 
require_once("ViewControllers/ordersViewController.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ordenes</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/views.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/custom-elements.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="orders-container">
        <?php showNewOrderButton();?>
        <?php showOrderFilters();?>
        <section class="orders-container">
            <?php showOrdersTable()?>
            <div class="order-pag">
                <?php showPaginator("orders.php?", $page, $totalOrders, $_GET) ?>
            </div>
        </section>
        
    </div>
    
</body>
</html>