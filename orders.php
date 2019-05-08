<?php 
require("Funciones/vistaController.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ordenes</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/views.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="orders-container">
        <form>
            <div class="search-box">
                <input type="text" placeholder="Buscar órden por ID, Trabajador, Descripción o Cliente">
                <input type="submit" value="Buscar">
            </div>
        </form>
        <a class="haptic-button medium new-order" >
            <img src="media/img/new-order.png">
            <div class="label">Nueva Órden</div>
        </a>
        <section class="orders-container">
            <?php showOrdersTable()?>
            <div class="order-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
    
</body>
</html>