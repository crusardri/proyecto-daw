<?php 
require("Funciones/vistaController.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ordenes</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/usercp.css">
</head>
<body>
    <div class="user-panel" id="register-panel">
        <form action="register.php" method="post">
            <h1>Registro</h1>
            <label class="input username">
                <div>Nombre de usuario <span class="mandatory">Obligatorio</span></div>
                <input type="text" placeholder="Nombre de usuario" name="username">
                <div class="description">Nombre de usuario con el que podrás iniciar sesión.</div>
            </label>
            <label class="input password">
                <div>Contraseña <span class="mandatory">Obligatorio</span></div>
                <input type="password" placeholder="Contraseña" name="password">
                <div class="description">Contraseña de tu cuenta.</div>
            </label>
            <label class="input name">
                <div>Nombre <span class="mandatory">Obligatorio</span></div>
                <input type="text" placeholder="Nombre" name="name">
                <div class="description">Tu nombre.</div>
            </label>
            <label class="input surname">
                <div>Apellidos</div>
                <input type="text" placeholder="Apellidos" name="surname">
                <div class="description">Tus apellidos.</div>
            </label>
            <label class="input surname">
                <div>Teléfono</div>
                <input type="text" placeholder="Telefono" name="surname" pattern="[0-9]{9,12}">
                <div class="description">Tu número de teléfono de contacto.</div>
            </label>
            <input type="submit">
        </form>
    </div>
</body>
</html>