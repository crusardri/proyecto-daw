<?php 
/*
*
* CONTROLADOR VISTA VENTANA EMPLOYEE
*
*/
session_start(); //Iniciamos la sesion
//Importamos las dependencias
require_once("ViewControllers/vistaController.php");
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
$userController = new UserController();     //Controlador de usuario
$controller = new Controller();             //El controlador principal
//Comprobamos si ha iniciado sesión y el rol que tiene
$sessionUser;                               //Usuario dueño de la sesion
$sessionUserRole;                           //Rol del usuario dueño de la sesion
//Variables
$client = false;                            //Si es cliente
$employee = false;                          //Si es empleado
$admin = false;                             //Si es administrador


//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    //Obtener USuario
    $sessionUser = $userController->getUser($_SESSION["userID"]);
    if(is_null($sessionUser) || !$sessionUser->isActive()){//Si no se encuentra
        session_destroy();
        header("location: login.php");
    }
    $sessionUserRole = $sessionUser->getRole();
}else {
    header("location: login.php");
}
//Obtenemos rol
if($sessionUserRole->getID() == 0){//Si es un cliente
    $client = true;
    //echo "Soy un Cliente\n";
}elseif($sessionUserRole->getID() == 1){ //Si es un empleado
    $employee = true;
    //echo "Soy un Empleado\n";
}elseif($sessionUserRole->getID() == 2){ //Si es administrador
    $admin = true;
    //echo "Soy un Administrador\n";
}

//Si es un cliente, a Client.php
if($client){
    header("location: client.php");
}

?>