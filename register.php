<?php require("ViewControllers/registerViewController.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title>Nueva Cuenta</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/usercp.css">
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/user-cp.js"></script>
</head>
<body id="user-cp">
    <div class="user-panel" id="register-panel">
       <div class="user-panel-header">
           <h1>Crear cuenta.</h1>
           <div class="main-text">Crea una cuenta para ver tus órdenes.</div>
           <div class="sub-text">¿Tienes una cuenta? <a href="login.php">Inicia sesión</a></div>
           <?php 
           if(isset($errorMSG)){
               ?><div class="msg error"><?=$errorMSG?></div><?php
           }
           ?>
       </div>
        <form action="register.php" method="post" id="register-form">
            <div class="input-set" id="sesion-info">
                <div class="label">Datos de inicio de sesión</div>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="username">
                        <div class="text-label mandatory"><span>Nombre de usuario</span></div>
                        <div class="input-container">
                            <input type="text" name="username" value="<?=isset($username)?$username:""?>">
                        </div>
                        <div class="button"><span>Comprobar</span></div>
                    </label>
                    <div class="input-box-desc">El nombre de tu cuenta nueva de usuario.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="email">
                        <div class="text-label mandatory"><span>Correo Electrónico</span></div>
                        <div class="input-container">
                            <input type="text" name="email" value="<?=isset($email)?$email:""?>">
                        </div>
                        <div class="button"><span>Comprobar</span></div>
                    </label>
                    <div class="input-box-desc">Tu correo electronico.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="password">
                        <div class="text-label mandatory"><span>Contraseña</span></div>
                        <div class="input-container">
                            <input type="password" name="password">
                        </div>
                    </label>
                    <div class="input-box-desc">Contraseña de tu nueva cuenta de usuario.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="repeat-password">
                        <div class="text-label mandatory"><span>Confirmar Contr.</span></div>
                        <div class="input-container">
                            <input type="password">
                        </div>
                    </label>
                    <div class="input-box-desc">Confirmar contraseña.</div>
                </label>
            </div>
            
            <div class="input-set" id="personal-info">
                <div class="label">Datos Personales</div>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="name">
                        <div class="text-label mandatory"><span>Nombre</span></div>
                        <div class="input-container">
                            <input type="text" name="name" value="<?=isset($name)?$name:""?>">
                        </div>
                    </label>
                    <div class="input-box-desc">Tu nombre.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="surname">
                        <div class="text-label"><span>Apellidos</span></div>
                        <div class="input-container">
                            <input type="text" name="surname" value="<?=isset($surname)?$surname:""?>">
                        </div>
                    </label>
                    <div class="input-box-desc">Tus apellidos.</div>
                </label>
                <label class="boxed-input-description">
                    <label class="boxed-input" id="phone">
                        <div class="text-label"><span>Teléfono</span></div>
                        <div class="input-container">
                            <input type="number" name="phone" value="<?=isset($phone)?$phone:""?>">
                        </div>
                    </label>
                    <div class="input-box-desc">Teléfono de contacto.</div>
                </label>
            </div>
            <input type="submit" value="Registrarse" class="input-submit-button" id="register" name="register" >
        </form>
    </div>
</body>
</html>