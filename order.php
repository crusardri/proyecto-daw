<?php
require_once("ViewControllers/orderViewController.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
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
        <?php
        if($edit){
            ?>
            <form method="post" action="order.php?id=<?=$order->getID()?>">
            <?php
        }elseif($register){
            ?>
            <form method="post" action="order.php?newOrder">
            <?php
        }
        ?>
        
            <?php
            if(isset($errorMSG)){
                ?><div class="msg error"><?=$errorMSG?></div><?php
            }elseif(isset($successMSG)){
                ?><div class="msg success"><?=$successMSG?></div><?php
            }
            ?>
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
            <!-- Notas -->
            <?php showOrderNotes()?>
            <!-- Botones -->
            <?php showSubmitOrderButton()?>
        </form>
    </div>
</body>
</html>