<?php
/*
*
* CONTROLADOR VENTANA USERS
*
*/
session_start();
require_once("ViewControllers/vistaController.php");
require_once("Controllers/LoginController.php");
require_once("Controllers/UserController.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");


$userController = new UserController(); //Controlador de usuarios
$loginControler = new LoginController(); //Controlador de sesion

//Comprobamos si ha iniciado sesión y el rol que tiene
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
//Asignar valores filtros
$page = 1;
$search = "";
$userRoleFilter = -1;
$state = -1;
$orderBy = -1;
$orderDirection = -1;
if(isset($_GET["page"]))            {$page = (int) $_GET["page"];}
if(isset($_GET["search"]))          {$search = $_GET["search"];}
if(isset($_GET["userRole"]))        {$userRoleFilter = (int) $_GET["userRole"];}
if(isset($_GET["state"]))           {$state = (int) $_GET["state"];}
if(isset($_GET["orderBy"]))         {$orderBy = (int) $_GET["orderBy"];}
if(isset($_GET["orderDirection"]))  {$orderDirection = (int) $_GET["orderDirection"];}

//Obtencion de datos
$roles = $userController->getRoles(); //Obtenemos todos los roles disponibles para los filtros
$users = $userController->getUsers($userRoleFilter,$state,$orderBy,$orderDirection, $page); //Obtenemos los usuarios
$totalUsers = $userController->getTotalUsers($userRoleFilter,$state,$orderBy,$orderDirection); //Obtenemos los usuarios totales



?>