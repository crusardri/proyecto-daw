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
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/custom-elements.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="orders-container">
        <form>
            <section class="search-box">
                <input type="text" placeholder="Buscar órden por ID, Trabajador, Descripción o Cliente" autofocus>
                <input type="submit" value="Buscar">
            </section>
        </form>
        <a class="haptic-button medium new-order" >
            <img src="media/img/new-order.png">
            <div class="label">Nueva Órden</div>
        </a>
        <section class="item-filters">
            <h1>Filtros</h1>
            <label class="boxed-select" id="order-estate-filter">
                <div>Estado</div>
                <select data-class="labeled">
                    <option value="-1"> Todos </option>
                    <option value="0" data-class="pending">Pendiente</option>
                    <option value="1" data-class="working">En proceso</option>
                    <option value="2" data-class="finished">Finalizado</option>
                    <option value="3" data-class="out">Recogido</option>
                    <option value="10" data-class="canceled">Cancelado</option>
                </select>
            </label>
            <label class="boxed-select" id="order-by-filter">
                <div>Ordenar por</div>
                <select data-class="order-by-filter">
                    <option value="0">ID</option>
                    <option value="1">Fecha entrada</option>
                    <option value="2">Fecha inicio</option>
                    <option value="3">Fecha finalizado</option>
                    <option value="4">Fecha salida</option>
                    <option value="5">Fecha cancelado</option>
                    <option value="6">Fecha actualizacion</option>
                    <option value="7">Cliente</option>
                    <option value="8">Trabajador</option>
                    <option value="9">Precio</option>
                    <option value="10">Número prendas</option>
                </select>
            </label>
            <label class="boxed-select" id="order-direction-filter">
                <div>Orden</div>
                <select data-class="order-direction-filter">
                    <option value="0">Ascendente</option>
                    <option value="1">Descendente</option>
                </select>
            </label>
        </section>
        <section class="orders-container">
            <?php showOrdersTable()?>
            <div class="order-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
    
</body>
</html>