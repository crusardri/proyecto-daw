<?php 
/*
*
* CONTROLADOR VISTA VENTANA REGISTRO
*
*/
session_start();
//require("Funciones/vistaController.php");
require_once("Classes/User.php");
require_once("Controllers/UserController.php");

/*
* Se comprueba si ya se ha iniciado sesión
*/
$userController = new UserController(); //Controlador de usuario
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
* Manejador registro
*/
if(isset($_POST["username"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $phone = $_POST["phone"];
    switch ($userController->registerUser($username, $password, $email, $name, $surname, $phone)){
        case 0:
            $_SESSION["registerSuccess"] = true;
            header("location: login.php");
            break;
        case 1:
            $errorMSG = "El nombre de usuario debe tener al menos 4 carácteres.";
            break;
        case 2: 
            $errorMSG = "El nombre de usuario ya esta registrado.";
            break;
        case 3:
            $errorMSG = "La contraseña debe tener al menos 6 carácteres.";
            break;
        case 4:
            $errorMSG = "El correo electrónico no es válido.";
            break;
        case 5: 
            $errorMSG = "El correo electrónico está registrado.";
            break;
        case 6:
            $errorMSG = "No has rellenado el campo \"nombre\".";
            break;
        case -1: 
            $errorMSG = "Algo ha fallado al intentar registrarte. Intentalo de nuevo.";
    }
}
?>