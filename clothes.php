<?php require("ViewControllers/clothesViewController.php"); ?>
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
    <?php
        if(isset($errorMSG)){
            ?><div class="msg error"><?=$errorMSG?></div><?php
        }elseif(isset($successMSG)){
            ?><div class="msg success"><?=$successMSG?></div><?php
        }    
    ?>
        <a class="haptic-button medium new-clothe" id="add-clothe">
            <img src="media/img/new-clothe.png">
            <div class="label">Nueva Prenda</div>
        </a>
        <form method="get" action="clothes.php" class="item-filters">
            <h1>Filtros</h1>
            <label class="boxed-input searchbox">
                <div class="text-label"><span>Buscar</span></div>
                <div class="input-container">
                    <input type="text" placeholder="Buscar usuario por ID, Nombre de usuario, Correo, Nombre, Apellidos, o Teléfono " name="search" value="<?=$search?>" autofocus>
                </div>
            </label>
            <?=showStateFilter()?>
            <?=showOrderByFilter($filters)?>
            <?=showOrderDirectionFilter();?>
            <input type="submit" class="input-submit-button" value="Filtrar" name="filter">
            <input type="submit" class="input-submit-button" value="Borrar filtros" name="clear" style="margin-left: 0;">
        </form>
        
        <section class="clothes-container">
            <?php showClothesTable()?>
            <div class="clothes-pag">
                <?php showPaginator("clothes.php?", $page, $totalClothes, $_GET) ?> 
            </div>
        </section>
        
    </div>
</body>
</html>