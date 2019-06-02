<?php require_once("ViewControllers/indexViewController.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.png" type="image/png">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title><?=$title?></title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/views.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="worker-container">
        <?php
        if(isset($errorMSG)){
            ?><div class="msg error"><?=$errorMSG?></div><?php
        }elseif(isset($successMSG)){
            ?><div class="msg success"><?=$successMSG?></div><?php
        }
        ?>
        <?php showIndexButtons();
        if($admin || $employee){
            ?>
        <section class="my-orders orders-container">
           <?php showOrdersShowcase("Órdenes Asignadas a mí.", $orders, "orders.php?search=".$sessionUser->getUsername()); ?>
        </section>
        <section class="all-orders orders-container">
           <?php showOrdersShowcase("Todas las ordenes.", $orders)?>
        </section>
        <section class="updates orders-container">
           <?php showOrdersShowcase("Actualizaciones.", $orders, "orders.php?orderBy=6"); ?>
        </section>
            <?php
        }else{
            ?>
        <section class="client-orders orders-container">
           <?php showOrdersShowcase("Mis órdenes", $orders, "orders.php?search=".$sessionUser->getUsername()); ?>
        </section>
            <?php
        }
        ?>
    </div>
    
</body>
</html>