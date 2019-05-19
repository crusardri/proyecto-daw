<?php require_once("ViewControllers/usersViewController.php")?>
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
        <a class="haptic-button medium new-user" >
            <img src="media/img/add-user.png">
            <div class="label">Nuevo Usuario</div>
        </a>
        <form class="item-filters">
           <label class="boxed-input searchbox">
                <div class="text-label"><span>Buscar</span></div>
                <div class="input-container">
                    <input type="text" placeholder="Buscar usuario por ID, Nombre de usuario, Correo, Nombre, Apellidos, o Teléfono " name="search" value="<?=$search?>">
                </div>
            </label>
            <h1>Filtros</h1>
            <label class="boxed-select" id="role-filter">
                <div>Rol</div>
                    <?=showUserRoleFilters($roles, $userRoleFilter)?>
            </label>
            <label class="boxed-select" id="active-filter">
                <div>Estado</div>
                <select data-class="labeled" name="state">
                    <option value="-1">Todos</option>
                    <option value="0" data-class="enabled" <?=$state == 0 ? "selected" : "" ?>>Activado</option>
                    <option value="1" data-class="disabled" <?=$state == 1 ? "selected" : "" ?>>Desactivado</option>
                </select>
            </label>
            <label class="boxed-select" id="order-by-filter">
                <div>Ordenar por</div>
                <select data-class="order-by-filter" name="orderBy">
                    <option value="-1">Ninguno</option>
                    <option value="0" <?=$orderBy == 0 ? "selected" : ""?>>ID</option>
                    <option value="1" <?=$orderBy == 1 ? "selected" : ""?>>Nombre</option>
                    <option value="2" <?=$orderBy == 2 ? "selected" : ""?>>Numero Arreglos</option>
                    <option value="3" <?=$orderBy == 3 ? "selected" : ""?>>Activo</option>
                    <option value="4" <?=$orderBy == 4 ? "selected" : ""?>>Fecha creación</option>
                    <option value="5" <?=$orderBy == 5 ? "selected" : ""?>>Fecha actualización</option>
                </select>
            </label>
            <label class="boxed-select" id="order-direction-filter">
                <div>Orden</div>
                <select data-class="order-direction-filter" name="orderDirection">
                    <option value="0" <?=$orderDirection == 0 ? "selected" : ""?>>Ascendente</option>
                    <option value="1" <?=$orderDirection == 1 ? "selected" : ""?>>Descendente</option>
                </select>
            </label>
            <input type="submit" class="input-submit-button" value="Filtrar">
        </form>
        <section class="users-container">
            <?php showUsersTable($users)?>
            <div class="users-pag">
                <?php showPaginator("users.php?", $page, $totalUsers, $_GET) ?>
            </div>
        </section>
        
    </div>
</body>
</html>