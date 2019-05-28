<?php
/**
 * 
 * CONTROLADOR VENTANA ORDENES
 * 
 * 
 */
session_start();
require_once("Controllers/UserController.php");
require_once("Controllers/Controller.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("Classes/Clothe.php");
require_once("Classes/Fix.php");
require_once("Classes/Order.php");
require_once("Classes/Estate.php");
require_once("Classes/OrderItem.php");
require_once("ViewControllers/vistaController.php");

$userController = new UserController();         //Controlador de usuarios
$controller = new Controller();                 //Controlador Prendas, Ordenes...

$client = false;                                //Si es cliente
$employee = false;                              //Si es empleado
$admin = false;                                 //Si es administrador

//Filtros del menu de filtros
$filters = ["ID", "Nombre", "Número Arreglos", "Activo", "Fecha creación", "Fecha actualización"];

//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    //Obtenemos Usuario y Rol
    $sessionUser = $userController->getUser($_SESSION["userID"]); 
    $sessionUserRole = $sessionUser->getRole();
} else {
    //Si no tiene la sesión iniciada, va al login.
    header("location: login.php"); 
    //echo "Not Login in";
}

/*********************************************************
 * 
 * QUITAR LO DE ARRIBA
 * 
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nueva Orden</title>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/main.js"></script>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/header.css">
    <link rel="stylesheet" href="style/single-view.css">
</head>
<body>
    <?php include("./includes/navbar.inc") ?>
    <div class="form-container order">
        
        <form>
            <div class="order-info">
                <h1>Nueva órden</h1>
                <label class="boxed-input" id="username">
                    <div class="text-label"><span>ID</span></div>
                    <div class="input-container">
                        <input type="text" value="000001" disabled>
                    </div>
                </label>
                <label class="boxed-input" id="update-date">
                    <div class="text-label"><span>Fecha de actualizacion</span></div>
                    <div class="input-container">
                        <input type="text" value="13/05/2019 13:03:24" disabled>
                    </div>
                </label>
            </div>      
            <!-- User Info -->
            <div class="client-info">
                <div class="field-set" id="client-infoset">
                <h3>Cliente</h3>
                    <input type="hidden" value="0001" id="client-id" name="client-id" disabled>
                    <div class="info-set">
                        <div class="form-info-title">Usuario</div>
                        <div class="form-info-data"><input type="text" value="Halfonso#0002" id="client-username" name="client-username" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre</div>
                        <div class="form-info-data"><input type="text" value="Halfonso" id="client-name" name="client-name" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Apellidos</div>
                        <div class="form-info-data"><input type="text" value="Fernandez" id="client-surname" name="client-surname" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Correo Electronico</div>
                        <div class="form-info-data"><input type="text" value="gmail@halfonso.com" id="client-email" name="client-email" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Telefono</div>
                        <div class="form-info-data"><input type="number" value="689521302" id="client-phone" name="client-phone" disabled></div>
                    </div>
                    <div class="info-set hidden"></div>
                    <div class="button" id="search-client">Cambiar</div>
                </div>
            </div>
            <div class="employee-info" id="employee-infoset">
                <div class="field-set">
                <h3>Empleado</h3>
                    <input type="hidden" value="0001" id="employee-id" name="employee-id" disabled>
                    <div class="info-set">
                        <div class="form-info-title">Usuario</div>
                        <div class="form-info-data"><input type="text" value="Ivan#0001" id="employee-username" name="employee-username" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre</div>
                        <div class="form-info-data"><input type="text" value="Iván" id="employee-name" name="employee-name" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Apellidos</div>
                        <div class="form-info-data"><input type="text" value="Maldonado" id="employee-surname" name="employee-surname" disabled></div>
                    </div>
                    <div class="button" id="search-employee">Cambiar</div>
                </div>
            </div>
            <!-- Estados -->
            <div class="estate-container">
               <h2>Estado</h2>
                <label class="boxed-radio estate pending">
                    <input type="radio" name="estate" name="1" checked>
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Pendiente</div>
                        <div class="radio-date">13/05/2019 - 23:36:24</div>
                        <div class="radio-desc">La orden ha sido recibida y esta en espera.</div>
                    </div>
                </label>
                <label class="boxed-radio working estate">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">En proceso</div>
                        <div class="radio-date">13/05/2019 - 23:36:24</div>
                        <div class="radio-desc">La orden esta realizandose.</div>
                    </div>
                </label>
                <label class="boxed-radio finished estate">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Finalizado</div>
                        <div class="radio-date">13/05/2019 - 23:36:24</div>
                        <div class="radio-desc">La orden ha sido terminada y esta pendiente de recogida.</div>
                    </div>
                </label>
                <label class="boxed-radio out estate">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Entregado</div>
                        <div class="radio-date">13/05/2019 - 23:36:24</div>
                        <div class="radio-desc">La orden ha sido recogida.</div>
                    </div>
                </label>
                <label class="boxed-radio canceled full-width estate">
                    <input type="radio" name="estate" name="1">
                    <div class="container">
                        <div class="radio-checkbox">&#x2713;</div>
                        <div class="radio-title">Cancelado</div>
                        <div class="radio-date">13/05/2019 - 23:36:24</div>
                        <div class="radio-desc">La orden ha sido cancelada.</div>
                    </div>
                </label>
            </div>
            <!-- Order Items -->
            <div class="order-items-container">
                <h2>Prendas</h2>
                <div class="button" id="new-order-item">Añadir Prenda</div>
                <div class="order-items">
                    <!--<div class="no-order-items">No hay prendas registradas.</div>-->
                    <div class="order-item">
                        <input type="hidden" value="1" name="order-item-id">
                        <input type="hidden" value="1" name="clothe-id">
                        <input type="hidden" value="1" name="fix-id">
                        <label class="boxed-input clothe">
                            <div class="text-label"><span>Prenda</span></div>
                            <div class="input-container">
                                <input type="text" value="Vaquero" disabled>
                            </div>
                        </label>
                        <label class="boxed-input fix">
                            <div class="text-label"><span>Arreglo</span></div>
                            <div class="input-container">
                                <input type="text" value="Bajo" disabled>
                            </div>
                        </label>
                        <label class="boxed-input price">
                            <div class="text-label"><span>Precio</span></div>
                            <div class="input-container">
                                <input type="number" value="10">
                            </div>
                        </label>
                        <label class="description-box order-item-description">
                        <div class="header">Observaciones</div>
                            <textarea name="order-item-description">Descripcion del pedido</textarea>
                        </label>
                    </div>
                    <div class="order-item">
                        <input type="hidden" value="1" name="order-item-id">
                        <input type="hidden" value="1" name="clothe-id">
                        <input type="hidden" value="1" name="fix-id">
                        <label class="boxed-input clothe">
                            <div class="text-label"><span>Prenda</span></div>
                            <div class="input-container">
                                <input type="text" value="Vaquero" disabled>
                            </div>
                        </label>
                        <label class="boxed-input fix">
                            <div class="text-label"><span>Arreglo</span></div>
                            <div class="input-container">
                                <input type="text" value="Bajo" disabled>
                            </div>
                        </label>
                        <label class="boxed-input price">
                            <div class="text-label"><span>Precio</span></div>
                            <div class="input-container">
                                <input type="number" value="10">
                            </div>
                        </label>
                        <label class="description-box order-item-description">
                        <div class="header">Observaciones</div>
                            <textarea name="order-item-description"></textarea>
                        </label>
                    </div>
                </div>
            </div>
            <!-- Descripcion -->
            <div class="order-description-container" id="order-description">
                <h2>Descripción</h2>
                <label class="description-box">
                    <div class="header">Descripción del pedido</div>
                    <textarea name="order-description"></textarea>
                </label>
            </div>
            <!-- Botones -->
            <div class="form-buttons">
                <input type="submit" value="Crear orden" class="input-submit-button">
            </div>
        </form>
    </div>
</body>
</html>