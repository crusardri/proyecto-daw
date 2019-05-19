<?php 
/*
*
* CONTROLADOR VISTA VENTANA LOGINO
*
*/
session_start();
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("Controllers/LoginController.php");
require_once("Controllers/UserController.php");

$loginController = new LoginController();//Controlador Login
$userController = new UserController();//Controlador Usuario

/*
* Se comprueba si ya se ha iniciado sesión
*/
if(isset($_SESSION["userID"])){
    $user = $userController->getUser($_SESSION["userID"]); //Obtener usuario
    $role = $user->getRole(); //Obtener rol
    if($role->getID() == 0){ //Comprobar rol
        header("location: client.php"); //Si cliente, a client.php
    }elseif($role->getID() == 1 || $role->getID() == 2){
        header("location: employee.php"); //Si empleado o administrador, a employee.php
    }
}
/*
* Comprobar que viene del login
*/
if(isset($_GET["success"])){
    $infoMSG = "Se ha registrado con éxito, ahora puede iniciar sesión.";
    $msgCssClass = "success";
}
/*
* Accion iniciar sesión
*/
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    switch ($loginController->login($username, $password)){
        case 0:
            $user = $userController->getUser($_SESSION["userID"]);
            $role = $user->getRole();
            if($role->getID() == 0){
                header("location: client.php");
            }elseif($role->getID() == 1 || $role->getID() == 2){
                header("location: employee.php");
            }
            break;
        case 1:
        case 2:
            $infoMSG = "El nombre de usuario o la contraseña no es correcto.";
            break;
        case -1:
            $infoMSG = "Algo ha fallado al intentar iniciar sesión. Intentalo de nuevo.";
            break;
    }
    $msgCssClass = "error";
}
?>