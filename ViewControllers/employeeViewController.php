<?php 
/*
*
* CONTROLADOR VISTA VENTANA EMPLOYEE
*
*/
session_start(); //Iniciamos la sesion
//Importamos las dependencias
require_once("ViewControllers/vistaController.php");
require_once("Controllers/LoginController.php");
require_once("Controllers/UserController.php");
require_once("Controllers/Controller.php");
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