<?php 
require("Funciones/vistaController.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Arreglos</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="fixes-container">
        <form>
            <div class="search-box">
                <input type="text" placeholder="Buscar arreglo por ID o Nombre">
                <input type="submit" value="Buscar">
            </div>
        </form>
        <a class="haptic-button medium new-fix" >
            <img src="media/img/add-user.png">
            <div class="label">Nuevo Arreglo</div>
        </a>
        <section class="fixes-container">
            <?php showFixesTable()?>
            <div class="fixes-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
</body>
</html>