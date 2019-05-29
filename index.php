<?php require_once("ViewControllers/indexViewController.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabajador</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/views.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="worker-container">
        <?php showIndexButtons();?>
        <section class="my-orders orders-container">
           <?php showOrdersShowcase("Órdenes Asignadas a mí.", $orders); ?>
        </section>
        <section class="all-orders orders-container">
           <?php showOrdersShowcase("Todas las ordenes.", $orders); ?>
        </section>
        <section class="updates orders-container">
           <?php showOrdersShowcase("Actualizaciones.", $orders); ?>
        </section>
    </div>
    
</body>
</html>