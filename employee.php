<?php 
session_start();
require("Funciones/vistaController.php");

?>
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
        <section class="buttons-container">
            <a class="haptic-button medium">
                <img src="media/img/new-order.png">
                <div class="label">Nueva Órden</div>
            </a>
            <a class="haptic-button medium">
                <img src="media/img/see-order.png">
                <div class="label">Ver Órdenes</div>
            </a>
            <a class="haptic-button medium">
                <img src="media/img/add-user.png">
                <div class="label">Registrar Usuario</div>
            </a>
            <a class="haptic-button medium">
                <img src="media/img/see-users.png">
                <div class="label">Ver Usuarios</div>
            </a>
        </section>
        <section class="my-orders orders-container">
           <?php showOrdersShowcase("Órdenes Asignadas a mí."); ?>
        </section>
        <section class="all-orders orders-container">
           <?php showOrdersShowcase("Todas las ordenes."); ?>
        </section>
        <section class="updates orders-container">
           <?php showOrdersShowcase("Actualizaciones."); ?>
        </section>
    </div>
    
</body>
</html>