<?php 
require("Funciones/vistaController.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="style/style.css">
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
            <img src="media/img/add-user.png">
            <div class="label">Nueva Prenda</div>
        </a>
        <section class="clothes-container">
            <?php showClothesTable()?>
            <div class="clothes-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
</body>
</html>