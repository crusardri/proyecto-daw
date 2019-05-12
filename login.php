<?php 
require("Funciones/vistaController.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Cuenta</title>
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
           <div class="sub-text">¿No tienes una cuenta? <a href="login.php">Registrate</a></div>
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