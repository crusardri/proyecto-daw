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
    <?php include("./includes/navbar.inc") ?>
    <div class="form-container clothe">  
        <!-- Datos Prenda -->
        <?=showClotheInfoForm()?>
        <!-- Estados -->
        <form id="active-container">
            <h2>Estado</h2>
            <div>
                <label class="boxed-radio active">
                    <input type="radio" name="active" value="1" checked>
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Activado</div>
                        <div class="radio-desc">Aparecerá en los listados y estará disponible para añadir en nuevas órdenes.</div>
                    </div>
                </label>
                <label class="boxed-radio disabled">
                    <input type="radio" name="active" value="0">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Desactivado</div>
                        <div class="radio-desc">No se podrá añadir a nuevas órdenes, pero se mantendrán en órdenes antiguas para consulta.</div>
                    </div>
                </label>
            </div>
            
            <div class="form-buttons">
                <input type="submit" value="Actualizar estado" class="input-submit-button">
            </div>
        </form>
        <!-- Tabla Arreglos -->
        <div id="fixes-table">
            <div class="form-buttons">
                <input type="submit" value="Añadir Arreglo" class="input-submit-button">
            </div>
            <?php showClotheFixes(); ?>
        </div>
    </div>
    
</body>
</html>