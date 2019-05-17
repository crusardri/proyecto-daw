<?php 
session_start();
require("Funciones/vistaController.php");
require("classes/LoginController.php");
require("classes/UserController.php");
$loginController = new LoginController();
$Controller = new UserController();
/*
* Se comprueba si ya se ha iniciado sesión
*/
if(isset($SESSION["userID"])){
    $user = $UserController->getUser($_SESSION["userID"]); //Obtiene el usuario
    //Redirecciona al usuario a su panel correspondiente dependiendo del rol
    $role = $user->getRole();
    if($role->getId() == 1 || $role->getId() == 2){
        header("location: employee.php");
    }else {
        header("location: client.php");
    }
}
if(isset($_POST[""]))
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/usercp.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/user-cp.js"></script>
</head>
<body id="user-cp">
    <div class="user-panel" id="login-panel">
       <div class="user-panel-header">
           <h1>Iniciar sesión</h1>
           <div class="main-text">Inicia sesión para ver tus órdenes.</div>
           <div class="sub-text">¿No tienes una cuenta? <a href="register.php">Registrate</a></div>
           <div class="msg error">Usuario o contraseña incorrecta.</div>
       </div>
        <form action="login.php" method="post" id="login-form">
            <div class="input-set" id="login-info">
                <div class="label">Datos de inicio de sesión</div>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="username">
                        <div class="text-label mandatory"><span>Usuario</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                    </label>
                    <div class="input-box-desc">Tu nombre de usuario.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="password">
                        <div class="text-label mandatory"><span>Contraseña</span></div>
                        <div class="input-container">
                            <input type="password">
                        </div>
                    </label>
                    <div class="input-box-desc">Tu contraseña.</div>
                </label>
            </div>
            <input type="submit" value="Iniciar Sesión" class="input-submit-button" id="login">
        </form>
    </div>
</body>
</html>