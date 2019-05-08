<?php 
require("Funciones/vistaController.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/views.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="users-container">
        <form>
            <div class="search-box">
                <input type="text" placeholder="Buscar Usuario por ID o Nombre">
                <input type="submit" value="Buscar">
            </div>
        </form>
        <a class="haptic-button medium new-user" >
            <img src="media/img/add-user.png">
            <div class="label">Nuevo Usuario</div>
        </a>
        <section class="users-container">
            <?php showUsersTable()?>
            <div class="users-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
</body>
</html>