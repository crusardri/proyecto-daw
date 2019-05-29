<?php
/**
 * 
 * CONTROLADOR VENTANA INICIO
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
$filters = ["ID", "Fecha de Entrada", "Fecha de inicio", "Fecha finalizado", "Fecha de salida", "Fecha de cancelación", "Fecha de Actualización", "Cliente", "Trabajador", "Precio", "Número de prendas"];

//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    //Obtenemos Usuario y Rol
    $sessionUser = $userController->getUser($_SESSION["userID"]); 
    $sessionUserRole = $sessionUser->getRole();
} else {
    //Si no tiene la sesión iniciada, va al login.
    header("location: login.php"); 
}
//Obtencion tipo usuario
if($sessionUserRole->getID() == 0){
    $client = true;
}elseif($sessionUserRole->getID() == 1){
    $employee = true;
}elseif($sessionUserRole->getID() == 2){
    $admin = true;
}
var_dump($sessionUser);

//Obtener las órdenes del client
if($client){
    $orders = $controller->getOrders($sessionUser->getUsername(), -1, -1, -1, 0, 5);
}
//Ordenes de empleado
if($employee || $admin){
    $orders = $controller->getOrders("", -1, -1, -1, 0, 5);
    $myOrders = $controller->getOrders($sessionUser->getUsername(), -1, -1, -1, 0, 5);
    $updatedOrders = $controller->getOrders($sessionUser->getUsername(), -1, -1, -1, 0, 5);
}

/**
* Mostrar tabla de ordenes
*/
function showOrdersShowcase($titulo, $orders){
    global $client, $employee, $admin;
    ?>
    <div class="showcase order-showcase">
        <div class="title"><?=$titulo?><a class="button" href="">Ver todas</a></div>
        <div class="order-container">
        <?php
        if(sizeof($orders)){
            foreach($orders as $order){
                $orderState = $order->getState();
                $e = $order->getEmployee();
                $c = $order->getClient();
        ?>
            <a href="order.php?id=<?=$order->getID()?>" class="order-item <?=$orderState->getCssClass()?>">
                <div class="estate <?=$orderState->getCssClass()?>"></div>
                <div class="order-info">
                    <div class="item-id a-center">
                        <span class="label">ID: </span>
                        <span class="content"><?=str_pad($order->getID(), 6, "0", STR_PAD_LEFT)?></span>
                    </div>
                    <div class="item-id">
                        <span class="label">Estado: </span>
                        <span class="content label-box <?=$orderState->getCssClass()?>"><?=$orderState->getName()?></span>
                    </div>
                    <?php 
                    if($admin || $employee) { 
                    ?>
                    <div class="item-id">
                        <span class="label">Asignado a: </span>
                        <span class="content"><?=$e->getName()." ".$e->getSurname()?></span>
                    </div>                    
                    <div class="item-id">
                        <span class="label">Cliente: </span>
                        <span class="content"><?=$c->getName()." ".$c->getSurname()?></span>
                    </div>
                    <?php 
                    } 
                    ?>
                </div>
                <div class="order-fetch">
                    <div class="item-id">
                        <span class="label">Entrada: </span>
                        <span class="content"><?=$order->getEnterDateString()?></span>
                    </div>
                    <?php
                    if(!is_null($order->getWorkingDate())){
                        ?>
                    <div class="item-id">
                        <span class="label">Inicio: </span>
                        <span class="content"><?=$order->getWorkingDateString()?></span>
                    </div>
                        <?php
                    }
                    if(!is_null($order->getFinishDate())){
                        ?>
                    <div class="item-id">
                        <span class="label">Finalizado: </span>
                        <span class="content"><?=$order->getFinishDateString()?></span>
                    </div>
                        <?php
                    }
                    if(!is_null($order->getOutDate())){
                        ?>
                    <div class="item-id">
                        <span class="label">Recogido: </span>
                        <span class="content"><?=$order->getOutDateString()?></span>
                    </div>
                        <?php
                    }if(!is_null($order->getCancelDate())){
                        ?>
                    <div class="item-id">
                        <span class="label">Cancelado: </span>
                        <span class="content"><?=$order->getCancelDateString()?></span>
                    </div>
                        <?php
                    }
                    ?>
                    
                </div>
                <div class="order-desc">
                    <?=$order->getObservations()?>
                </div>
            </a>
        <?php  
            }
        }else{
            ?>
            <a href="" class="order-item">No se han encontrado órdenes.</a>
            <?php
        }
        ?>
        </div>       
    </div>
    <?php
}