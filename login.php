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
            break;
            header("location: employee.php");
        case 1:
        case 2:
            $infoMSG = "El nombre de usuario o la contraseña no es correcto";
            break;
        case -1:
            $infoMSG = "Algo ha fallado al intentar iniciar sesión. Intentalo de nuevo.";
            break;
    }
    $msgCssClass = "error";
}
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
            <?php 
            if(isset($infoMSG)){
                ?><div class="msg <?=$msgCssClass?>"><?=$infoMSG?></div><?php
            }
            ?>
        </div>
        <form action="login.php" method="post" id="login-form">
            <div class="input-set" id="login-info">
                <div class="label">Datos de inicio de sesión</div>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="username">
                        <div class="text-label mandatory"><span>Usuario</span></div>
                        <div class="input-container">
                            <input type="text" name="username" value="<?=isset($username)?$username:""?>">
                        </div>
                    </label>
                    <div class="input-box-desc">Tu nombre de usuario.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="password">
                        <div class="text-label mandatory"><span>Contraseña</span></div>
                        <div class="input-container">
                            <input type="password" name="password">
                        </div>
                    </label>
                    <div class="input-box-desc">Tu contraseña.</div>
                </label>
            </div>
            <input type="submit" value="Iniciar Sesión" class="input-submit-button" id="login" name="login">
        </form>
    </div>
</body>
</html>