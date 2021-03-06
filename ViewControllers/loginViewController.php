<?php 
/*
*
* CONTROLADOR VISTA VENTANA LOGINO
*
*/
session_start();
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("Controllers/UserController.php");

$userController = new UserController();//Controlador Usuario

/*
* Se comprueba si ya se ha iniciado sesión
*/
if(isset($_SESSION["userID"])){
    $user = $userController->getUser($_SESSION["userID"]);
    if(is_null($user)){
        session_destroy();
    }
    header("location: index.php");
}
/*
* Comprobar que viene de register
*/
if(isset($_SESSION["registerSuccess"]) && $_SESSION["registerSuccess"]){
    unset($_SESSION["registerSuccess"]);
    $infoMSG = "Se ha registrado con éxito, ahora puede iniciar sesión.";
    $msgCssClass = "success";
}
/**
 * Comprobar que ha cambiado la contraseña desde el panel de control
 */
if(isset($_SESSION["changePasswordSuccess"]) && $_SESSION["changePasswordSuccess"]){
    unset($_SESSION["changePasswordSuccess"]);
    $infoMSG = "Ha cambiado su contraseña con exito.";
    $msgCssClass = "success";
}
/*
* Accion iniciar sesión
*/
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    switch ($userController->login($username, $password)){
        case 0:
            $user = $userController->getUser($_SESSION["userID"]);
            header("Location: index.php");
            break;
        case 1:
            $infoMSG = "Debes completar el campo \"Nombre de usuario\".";
            break;
        case 2:
            $infoMSG = "Debes de completar el campo \"Contraseña\".";
            break;
        case 3:
        case 5:
            $infoMSG = "El nombre de usuario o la contraseña no es correcto.";
            break;
        case 4:
            $infoMSG = "El usuario no está habilitado.";
            break;
        default:
            $infoMSG = "Algo ha fallado al intentar iniciar sesión. Intentalo de nuevo.";
            break;
    }
    $msgCssClass = "error";
}
?>