<?php
session_start();
require_once("Funciones/vistaController.php");
require_once("Classes/UserController.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");


$userController = new UserController(); //Controlador de usuarios

/*
* Se comprueba si ya se ha iniciado sesión y si tiene rol cliente, o no ha iniciado sesion, redirecciona a otra pagina.
*/
if(isset($_SESSION["userID"])){
    $user = $userController->getUser($_SESSION["userID"]); //Obtener usuario
    $role = $user->getRole(); //Obtener rol
    if($role->getID() == 0){ //Comprobar rol
        header("location: client.php"); //Si cliente, a client.php
        //echo "Role 0";
    }
} else {
    header("location: login.php"); //Si no tiene sesion iniciada, va al login.
    //echo "Not Login in";
}
$roles = $userController->getRoles();
$users = $userController->getUsers(null,null,null,null);
$totalUsers = $userController->getTotalUsers(null,null,null,null);
if(isset($_GET["page"])){$page = $_GET["page"];}else{$page = 1;}//Declarar página


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
                    <?=showUserRoleFilters($roles)?>
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
            <?php showUsersTable($users)?>
            <div class="users-pag">
                <?php showPaginator("users.php?", $page, 1000, $_GET) ?>
            </div>
        </section>
        
    </div>
</body>
</html>