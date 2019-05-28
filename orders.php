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
        <a class="haptic-button medium new-order" >
            <img src="media/img/new-order.png">
            <div class="label">Nueva Órden</div>
        </a>
        <form class="item-filters">
            <label class="boxed-input searchbox">
                <div class="text-label"><span>Buscar</span></div>
                <div class="input-container">
                    <input type="text" placeholder="Buscar ordenes por ID, Cliente, Empleado o Descripción" name="search" value="<?=$search?>" autofocus>
                </div>
            </label>
            <h1>Filtros</h1>
            <?=showOrderStateFilter()?>
            <?=showOrderByFilter($filters)?>
            <?=showOrderDirectionFilter();?>
            <input type="submit" class="input-submit-button" value="Filtrar" name="filter">
            <input type="submit" class="input-submit-button" value="Borrar filtros" name="clear" style="margin-left: 0;">
        </form>
        <section class="orders-container">
            <?php showOrdersTable()?>
            <div class="order-pag">
                <?php showPaginator("orders.php?", $page, $totalOrders, $_GET) ?>
            </div>
        </section>
        
    </div>
    
</body>
</html>