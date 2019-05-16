<?php 
require("Funciones/vistaController.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prendas</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/views.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/custom-elements.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="clothes-container">
        <form>
            <div class="search-box">
                <input type="text" placeholder="Buscar Prenda por ID o nombre">
                <input type="submit" value="Buscar">
            </div>
        </form>
        <a class="haptic-button medium new-clothe" >
            <img src="media/img/new-clothe.png">
            <div class="label">Nueva Prenda</div>
        </a>
        <section class="item-filters">
            <h1>Filtros</h1>
            <label class="boxed-select" id="active-filter">
                <div>Estado</div>
                <select data-class="labeled">
                    <option value="-1"> Todos </option>
                    <option value="0" data-class="enabled" >Activado</option>
                    <option value="1" data-class="disabled">Desactivado</option>
                </select>
            </label>
            <label class="boxed-select" id="order-by-filter">
                <div>Ordenar por</div>
                <select data-class="order-by-filter">
                    <option value="0">ID</option>
                    <option value="1">Nombre</option>
                    <option value="2">Numero Arreglos</option>
                    <option value="3">Activo</option>
                    <option value="4">Fecha creación</option>
                    <option value="5">Fecha actualización</option>
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
        
        <section class="clothes-container">
            <?php showClothesTable()?>
            <div class="clothes-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
</body>
</html>