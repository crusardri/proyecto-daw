<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Usuario</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/single-view.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="form-container user">
        <div id="user-info-container">
            <h1>Usuario</h1>
            <div>
            <label class="boxed-input" id="username">
                <div class="text-label"><span>ID</span></div>
                <div class="input-container">
                    <input type="text" value="000001" disabled>
                </div>
            </label>
            <label class="boxed-input" id="register-date">
                <div class="text-label"><span>Fecha de registro</span></div>
                <div class="input-container">
                    <input type="text" value="13/05/2019 13:03:24" disabled>
                </div>
            </label>
            <label class="boxed-input" id="update-date">
                <div class="text-label"><span>Fecha de actualizacion</span></div>
                <div class="input-container">
                    <input type="text" value="13/05/2019 13:03:24" disabled>
                </div>
            </label>
            </div>
        </div>   
        <!-- Datos Cuenta -->
        <form id="account-info-container">
            <div class="field-set" id="client-infoset">
            <h3>Datos Cuenta</h3>
                <label class="boxed-input" id="username">
                    <div class="text-label"><span>Nombre de usuario</span></div>
                    <div class="input-container">
                        <input type="text" value="Ivan" disabled>
                    </div>
                </label>
                <label class="boxed-input" id="email">
                    <div class="text-label"><span>Correo Electronico</span></div>
                    <div class="input-container">
                        <input type="text" value="ivanmaldonado@dondedal.es">
                    </div>
                </label>
                <div class="form-buttons">
                    <input type="submit" value="Cambiar Correo" class="input-submit-button">
                </div>
            </div>
            
        </form>
        <!-- Datos Usuario -->
        <form id="change-password-container">
            <div class="field-set" id="change-password">
            <h3>Cambiar contraseña</h3>
                <label class="boxed-input" id="password">
                    <div class="text-label"><span>Contraseña nueva</span></div>
                    <div class="input-container">
                        <input type="password">
                    </div>
                </label>
                <label class="boxed-input" id="repeat-password">
                    <div class="text-label"><span>Repetir contraseña</span></div>
                    <div class="input-container">
                        <input type="password">
                    </div>
                </label>
                <div class="form-buttons">
                    <input type="submit" value="Cambiar contraseña" class="input-submit-button">
                </div>
            </div>
            
        </form>
        <!-- Datos Personales -->
        <form id="personal-info-container">
            <div class="field-set" id="personal-info-infoset">
                <h3>Datos personales</h3>
                <label class="boxed-input" id="username">
                    <div class="text-label"><span>Nombre</span></div>
                    <div class="input-container">
                        <input type="text" name="name" value="Iván">
                    </div>
                </label>
                <label class="boxed-input" id="surname">
                    <div class="text-label"><span>Apellidos</span></div>
                    <div class="input-container">
                        <input type="text" name="surname" value="Maldonado Fernández">
                    </div>
                </label>
                <label class="boxed-input" id="phone">
                    <div class="text-label"><span>Teléfono</span></div>
                    <div class="input-container">
                        <input type="number" name="phone" value="689364758">
                    </div>
                </label>
                <div class="form-buttons">
                    <input type="submit" value="Cambiar datos" class="input-submit-button">
                </div>
            </div>
            
        </form>
        <!-- Estados -->
        <form id="active-form">
            <h2>Estado</h2>
            <div>
                <label class="boxed-radio active">
                    <input type="radio" name="active" value="1" checked>
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Activado</div>
                        <div class="radio-desc">El usuario puede iniciar sesión y utilizar la aplicación con normalidad, aparecerá en las listas</div>
                    </div>
                </label>
                <label class="boxed-radio disabled">
                    <input type="radio" name="active" value="0">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Desactivado</div>
                        <div class="radio-desc">El usuario esta desactivado, no podrá iniciar sesión, ni aparecerá en las listas, pero se mantendrá en la Base de datos para consulta.</div>
                    </div>
                </label>
            </div>
            <div class="form-buttons">
                <input type="submit" value="Cambiar estado" class="input-submit-button">
            </div>
        </form>
        <!-- Estados -->
        <form id="role-form">
            <h2>Rol</h2>
            <div>
                <label class="boxed-radio client">
                    <input type="radio" name="role" checked>
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Cliente</div>
                        <div class="radio-desc">El usuario puede ver sus órdenes.</div>
                    </div>
                </label>
                <label class="boxed-radio employee">
                    <input type="radio" name="role" >
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Empleado</div>
                        <div class="radio-desc">El usuario puede generar y modificar órdenes, como registrar y modificar clientes.</div>
                    </div>
                </label>
                <label class="boxed-radio admin">
                    <input type="radio" name="role" >
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">administrador</div>
                        <div class="radio-desc">El usuario puede generar y modificar órdenes, y registrar y modificar usuarios de cualquier rol.</div>
                    </div>
                </label>
            </div>
            <div class="form-buttons">
                <input type="submit" value="Cambiar Rol" class="input-submit-button">
            </div>
        </form>
    </div>
</body>
</html>