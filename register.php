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
</head>
<body id="user-cp">
    <div class="user-panel" id="register-panel">
       <div class="user-panel-header">
           <h1>Registrate</h1>
           <div class="main-text">Crea una cuenta para ver tus órdenes.</div>
           <div class="sub-text">¿Tienes una cuenta? <a href="login.php">Inicia sesión</a></div>
           <div class="msg error">Se ha producido un error.</div>
       </div>
        <form action="register.php" method="post">
            <div class="input-set" id="sesion-info">
                <div class="label">Datos de inicio de sesión</div>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="username">
                        <div class="text-label mandatory"><span>Usuario</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                        <div class="button"><span>Comprobar</span></div>
                    </label>
                    <div class="input-box-msg success">Nombre de usuario disponible.</div>
                    <div class="input-box-desc">El nombre de tu cuenta nueva de usuario.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="email">
                        <div class="text-label mandatory"><span>Correo Electrónico</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                        <div class="button"><span>Comprobar</span></div>
                    </label>
                    <div class="input-box-msg success">El correo electrónico está disponible.</div>
                    <div class="input-box-desc">Tu correo electronico.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="password">
                        <div class="text-label mandatory"><span>Contraseña</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                    </label>
                    <div class="input-box-msg error">La contraseña debe contener al menos 6 caracteres.</div>
                    <div class="input-box-desc">Contraseña de tu nueva cuenta de usuario.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="password">
                        <div class="text-label mandatory"><span>Confirmar Contr.</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                    </label>
                    <div class="input-box-msg error">La contraseña debe coincidir.</div>
                    <div class="input-box-desc">Confirmar contraseña.</div>
                </label>
            </div>
            
            <div class="input-set" id="personal-info">
                <div class="label">Datos Personales</div>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="name">
                        <div class="text-label mandatory"><span>Nombre</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                    </label>
                    <div class="input-box-desc">Tu nombre.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="surname">
                        <div class="text-label"><span>Apellidos</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                    </label>
                    <div class="input-box-desc">Tus apellidos.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="phone">
                        <div class="text-label"><span>Teléfono</span></div>
                        <div class="input-container">
                            <input type="text">
                        </div>
                    </label>
                    <div class="input-box-desc">Teléfono de contacto.</div>
                </label>
            </div>
            <input type="submit" value="Registrarse" class="input-submit-button" id="register">
        </form>
    </div>
</body>
</html>