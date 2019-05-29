<?php
require_once("ViewControllers/orderViewController.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Orden</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/custom-elements.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/single-view.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="form-container order">
        
        <form>
            <?php showOrderInfo()?>  
            <!-- User Info -->
            
            <?php showClientInfo();?>
            <?php showEmployeeInfo();?>
        
            <!-- Estados -->
            <?php showOrderState()?>
            <!-- Order Items -->
            <?php showOrderItems()?>
            <!-- Descripcion -->
            <?php showOrderDescription()?>
            <!-- Botones -->
            <?php showSubmitOrderButton()?>
        </form>
    </div>
</body>
</html>