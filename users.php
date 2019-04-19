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
    <div class="orders-container">
        <form>
            <div class="search-box">
                <input type="text" placeholder="Buscar prenda por ID o Nombre">
                <input type="submit" value="Buscar">
            </div>
        </form>
        <a class="haptic-button medium new-order" >
            <img src="media/img/new-order.png">
            <div class="label">Nueva Usuario</div>
        </a>
        <section class="orders-container">
            <?php showUsersTable()?>
            <div class="order-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
</body>
</html>