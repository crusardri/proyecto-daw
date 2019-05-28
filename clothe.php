<?php include("ViewControllers/clotheViewController.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuario</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/single-view.css">
</head>
<body>
    <?php include("./includes/navbar.inc");?>
    <div class="form-container clothe">  
        <!-- Datos Prenda -->
        <?=showClotheInfoForm()?>
        <!-- Estados -->
        <?=showStateForm()?>
        <!-- Tabla Arreglos -->
        <div id="fixes-table">
            <div class="form-buttons">
                <input type="submit" value="Añadir Arreglo" class="input-submit-button" id="add-fix">
            </div>
            <?php showClotheFixes(); ?>
        </div>
    </div>
</body>
</html>