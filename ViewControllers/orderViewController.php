<?php
var_dump($_POST);
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

$edit = false;                                  //Editando orden
$register = false;                              //Creando orden

$estates;                                        //Estados disponibles de la orden

$order = null;                                  //Orden a consultar
$orderItems = null;                             //Objetos de la orden
$orderClient = null;                            //Cliente de la orden
$orderEmployee = null;                          //Empleado asignado a la orden
$orderState = null;                             //Estado de la órden

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

//Obtención tipo usuario
if($sessionUserRole->getID() == 0){
    $client = true;
}elseif($sessionUserRole->getID() == 1){
    $employee = true;
}elseif($sessionUserRole->getID() == 2){
    $admin = true;
}

//Obtener tipo de visualizacion
if(isset($_GET["id"]) && !empty($_GET["id"])){
    $edit = true;
}elseif(isset($_GET["newOrder"])){
    $register = true;
}else {
    header("location: orders.php");
}

//expulsar cliente al intentar registrar
if($client && $register){
    header("location: orders.php");
}

$states = $controller->getStates();

$order = $controller->getOrder(1);
$orderItems = $controller->getOrderItems(1);
$orderClient = $order->getClient();
$orderEmployee = $order->getEmployee();

/**
 * Mostrar cabecera order
 */
function showOrderInfo(){
    global $edit, $register, $client, $admin, $employee;
    if($edit){
    ?>
    <div class="order-info">
                <label class="boxed-input" id="username">
                    <div class="text-label"><span>ID</span></div>
                    <div class="input-container">
                        <input type="text" value="000001" disabled>
                    </div>
                </label>
                <?php
                if($employee || $admin){
                ?>
                <label class="boxed-input" id="update-date">
                    <div class="text-label"><span>Fecha de actualizacion</span></div>
                    <div class="input-container">
                        <input type="text" value="13/05/2019 13:03:24" disabled>
                    </div>
                </label>
                <?php
                }
                ?>
            </div>      
    <?php
    }elseif($register){
        ?><div class="order-info"><h1>Nueva órden</h1></div><?php
    }
}
/**
 * Mostrar campo cliente
 */
function showClientInfo(){
    global $edit, $register, $client, $admin, $employee, $orderClient, $order;
    ?>
        <div class="client-info" style="<?=$client?"grid-column: 1/3;":""?>">
            <div class="field-set" id="client-infoset" >
            <h3>Cliente</h3>
                <input type="hidden" value="<?=isset($order) && !is_null($order)?$orderClient->getID():""?>" id="client-id" name="client-id" disabled>
                <div class="info-set">
                    <div class="form-info-title">Usuario</div>
                    <div class="form-info-data"><input type="text" value="<?=isset($order) && !is_null($order)?$orderClient->getUsername():""?>" id="client-username" name="client-username" disabled></div>
                </div>
                <div class="info-set">
                    <div class="form-info-title">Nombre</div>
                    <div class="form-info-data"><input type="text" value="<?=isset($order) && !is_null($order)?$orderClient->getName():""?>" id="client-name" name="client-name" disabled></div>
                </div>
                <div class="info-set">
                    <div class="form-info-title">Apellidos</div>
                    <div class="form-info-data"><input type="text" value="<?=isset($order) && !is_null($order)?$orderClient->getSurname():""?>" id="client-surname" name="client-surname" disabled></div>
                </div>
                <div class="info-set">
                    <div class="form-info-title">Correo Electronico</div>
                    <div class="form-info-data"><input type="text" value="<?=isset($order) && !is_null($order)?$orderClient->getEmail():""?>" id="client-email" name="client-email" disabled></div>
                </div>
                <div class="info-set">
                    <div class="form-info-title">Telefono</div>
                    <div class="form-info-data"><input type="number" value="<?=isset($order) && !is_null($order)?$orderClient->getTelephone():""?>" id="client-phone" name="client-phone" disabled></div>
                </div>
                <?php
                if($register && ($admin || $employee)){
                ?>
                    <div class="button" id="search-client">Cambiar</div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
}
/**
 * Mostrar campo empleado
 */
function showEmployeeInfo(){
    global $edit, $register, $client, $admin, $employee, $orderEmployee, $order;
    if($admin || $employee){
    ?>
        <div class="employee-info" id="employee-infoset" >
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
                
                <?php
                if($register && ($admin || $employee)){
                ?>
                    <div class="button" id="search-employee">Cambiar</div>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
}
/**
 * Contenedor estado orden
 */
function showOrderState(){
    global $edit, $register, $client, $admin, $employee, $order, $states;
    $state = $order->getState();
    
    ?>
    <div class="estate-container">
        <h2>Estado</h2>
        <?php
        foreach($states as $e){      
            if($edit){
                switch($e->getID()){
                    case 0:
                        $date = $order->getEnterDateString();
                        break;
                    case 1:
                        $date = $order->getWorkingDateString();
                        break;
                    case 2:
                        $date = $order->getFinishDateString();
                        break;
                    case 3:
                        $date = $order->getOutDateString();
                        break;
                    case 4:
                        $date = $order->getCancelDateString();
                        break;
                }
            }else{
                $date = "";
            }
            
            ?>
        <label class="boxed-radio estate <?=$e->getCssClass()?>">
            <input type="radio" name="estate" value="<?=$e->getId()?>" <?=$state->getID()==$e->getID()?"checked":""?> <?=!($admin||$employee)?"disabled":""?>>
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title"><?=$e->getName()?></div>
                <div class="radio-date"><?=$date?></div>
                <div class="radio-desc"><?=$e->getDescription()?></div>
            </div>
        </label>
            <?php
        }
        ?>
    </div>
    <?php
}

/**
 * Muestra las order items
 */
function showOrderItems(){
    global $edit, $register, $admin, $employee, $client, $order, $orderItems;
    ?>
<div class="order-items-container">
    <h2>Prendas</h2>
    <?php
    if($register){
    ?>  <div class="button" id="new-order-item">Añadir Prenda</div> <?php
    }
    ?>
    <div class="order-items">
        <?php
        if($edit && sizeof($orderItems) > 0){
            foreach($orderItems as $oi){ 
                $clothe = $oi->getClothe();
                $fix = $oi->getFix();
        ?>
        <div class="order-item">
            <input type="hidden" value="<?=$oi->getID()?>" name="order-item-id">
            <input type="hidden" value="<?=$clothe->getID()?>" name="clothe-id">
            <input type="hidden" value="<?=$fix->getID()?>" name="fix-id">
            <label class="boxed-input clothe">
                <div class="text-label"><span>Prenda</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$clothe->getName()?>" disabled>
                </div>
            </label>
            <label class="boxed-input fix">
                <div class="text-label"><span>Arreglo</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$fix->getName()?>" disabled>
                </div>
            </label>
            <label class="boxed-input price">
                <div class="text-label"><span>Precio</span></div>
                <div class="input-container">
                    <input type="number" value="<?=$oi->getPrice()?>" <?=!($admin||$employee)?"disabled":""?>>
                </div>
            </label>
            <label class="description-box order-item-description">
            <div class="header">Observaciones</div>
                <textarea name="order-item-description" <?=!($admin||$employee)?"disabled":""?>><?=$oi->getDescription()?></textarea>
            </label>
        </div>
        <?php
            }
        }else{
            ?>
            <div class="no-order-items">No hay prendas registradas.</div>
            <?php
        }
        ?>
    </div>
</div>
    <?php
}
/**
 * Mostrara descripcion orden
 */
function showOrderDescription(){
    global $edit, $register, $order, $client, $admin, $employee;
    ?>
    <div class="order-description-container" id="order-description">
        <h2>Descripción</h2>
        <label class="description-box">
            <div class="header">Descripción del pedido</div>
            <textarea name="order-description" <?=!($admin || $employee)?"disabled":""?>><?=$order->getObservations()?></textarea>
        </label>
    </div>
    <?php
}
/**
 * Mostrar boton enviar/editar orden
 */
function showSubmitOrderButton(){
    global $edit, $register, $client, $admin, $employee;
    if(($admin ||$employee) && $edit){
    ?>
    <div class="form-buttons">
        <input type="submit" value="Modificar órden" class="input-submit-button">
    </div>
    <?php
    }elseif($register){
    ?>
    <div class="form-buttons">
        <input type="submit" value="Crear órden" class="input-submit-button">
    </div>
    <?php
    }
}