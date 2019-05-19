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
            <?=showRoleFilter($role, $userRoleFilter);?>
            <?=showStateFilter($state);?>
            <?=showOrderByFilter($orderBy);?>
            <?=showOrderDirectionFilter($orderDirection);?>
            <input type="submit" class="input-submit-button" value="Borrar filtros" name="clear">
            <input type="submit" class="input-submit-button" value="Filtrar" style="margin-left: 0;">
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