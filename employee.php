<?php 
session_start(); //Iniciamos la sesion
//Importamos las dependencias
require_once("controladorVista/vistaController.php");
require_once("Classes/LoginController.php");
require_once("Classes/UserController.php");
require_once("Classes/Controller.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("Classes/Order.php");
require_once("Classes/OrderItem.php");
require_once("Classes/Estate.php");
require_once("Classes/Fix.php");
require_once("Classes/Clothe.php");

//Iniciamos los controladores 
$userController = new UserController(); //Controlador de usuario
$loginController = new LoginControlleR(); //Controlador de Login
$controller = new Controller(); //El controlador principal
//Cerramos sesion
if(isset($_GET["logout"])){
    $loginController->logout();
}
//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    $user = $userController->getUser($_SESSION["userID"]); //Obtener usuario
    $role = $user->getRole(); //Obtener rol
    if($role->getID() == 0){ //Comprobar rol
        header("location: client.php"); //Si rol es cliente, a client.php
    }
} else {
    header("location: login.php"); //Si no tiene sesion iniciada, va al login.
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trabajador</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/views.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="worker-container">
        <section class="buttons-container">
            <a class="haptic-button medium">
                <img src="media/img/new-order.png">
                <div class="label">Nueva Órden</div>
            </a>
            <a class="haptic-button medium">
                <img src="media/img/see-order.png">
                <div class="label">Ver Órdenes</div>
            </a>
            <a class="haptic-button medium">
                <img src="media/img/add-user.png">
                <div class="label">Registrar Usuario</div>
            </a>
            <a class="haptic-button medium">
                <img src="media/img/see-users.png">
                <div class="label">Ver Usuarios</div>
            </a>
        </section>
        <section class="my-orders orders-container">
           <?php showOrdersShowcase("Órdenes Asignadas a mí."); ?>
        </section>
        <section class="all-orders orders-container">
           <?php showOrdersShowcase("Todas las ordenes."); ?>
        </section>
        <section class="updates orders-container">
           <?php showOrdersShowcase("Actualizaciones."); ?>
        </section>
    </div>
    
</body>
</html>