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
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/custom-elements.js"></script>
    <script src="js/main.js"></script>
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
        <section class="item-filters">
            <h1>Filtros</h1>
            <label class="boxed-select" id="role-filter">
                <div>Rol</div>
                    <?=showUserRoleFilters()?>
            </label>
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
        <section class="users-container">
            <?php showUsersTable()?>
            <div class="users-pag">
                <?php showPaginator() ?>
            </div>
        </section>
        
    </div>
</body>
</html>