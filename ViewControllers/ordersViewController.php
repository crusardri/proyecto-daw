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
$filters = ["ID", "Fecha de Entrada", "Fecha de inicio", "Fecha finalizado", "Fecha de salida", "Fecha de cancelación", "Fecha de Actualización", "Cliente", "Trabajador", "Precio", "Número de prendas"];

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
//Obtencion tipo usuario
if($sessionUserRole->getID() == 0){
    $client = true;
}elseif($sessionUserRole->getID() == 1){
    $employee = true;
}elseif($sessionUserRole->getID() == 2){
    $admin = true;
}

//Asignar valores filtros
$page = 1;                          //Página
$search = "";                       //Cadena a buscar
$stateFilter = -1;                        //Estado de la prenda (activado/desactivado)
$orderBy = -1;                      //Ordenado por
$orderDirection = -1;               //Ordenado Ascendente o Descendente
//Si alguna de las variables esta asignada, reemplazamos el valor por defecto.
if(isset($_GET["page"]))            {$page = (int) $_GET["page"];}                      //Número Página
if(isset($_GET["search"]))          {$search = $_GET["search"];}                        //Cadena a buscar
if(isset($_GET["state"]))           {$stateFilter = (int) $_GET["state"];}                    //Estado Prenda
if(isset($_GET["orderBy"]))         {$orderBy = (int) $_GET["orderBy"];}                //Ordenado por
if(isset($_GET["orderDirection"]))  {$orderDirection = (int) $_GET["orderDirection"];}  //ORden ordenación

//Borrar Filtros
if(isset($_GET["clear"])){
    header("location: users.php");
}

//Inicializamos variables
$totalOrders = 1000;
$states = $controller->getStates();
$orders = $controller->getOrders($search, $stateFilter, $orderBy, $orderDirection, $page, 10);
/**
 * Tabla ordenes
 */
function showOrdersTable(){
    global $orders;
    ?>
    <div class="table-container">
        <table class="orders-table">
           <tr class="header-responsive-mobile">
                <th>Órdenes</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Estado</th>
                <th>Prendas</th>
                <th>Precio</th>
                <th>Asignado a</th>
                <th>Cliente</th>
                <th>Entrada</th>
                <th>Inicio</th>
                <th>Terminado</th>
                <th>Entregado</th>
                <th>Actualizado</th>
                <th>Descripción</th>
            </tr>
            <?php
            if(sizeOf($orders) > 0){
                foreach($orders as $order){
                    $client = $order->getClient();
                    $employee = $order->getEmployee();
                    $orderState = $order->getState();
                    ?>
            <tr class="order pending">
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="order?id=<?=$order->getID()?>"><?=str_pad($order->getID(), 6, "0", STR_PAD_LEFT)?></a></td>
                <td><span class="responsive-label">Estado</span> <a href="" class="label-box <?=$orderState->getCssClass()?>"><?=$orderState->getName()?></a></td>
                <td class="a-center"><span class="responsive-label">Nº Prendas</span><?=$order->getTotalOrderItems()?></td>
                <td class="a-center"><span class="responsive-label">Precio</span> 10€</td>
                <td><span class="responsive-label">Asignado a</span> <a href="orders.php?search=<?=$employee->getUsername()?>"><?=$employee->getName()." ".$employee->getSurname()?></a></td>
                <td><span class="responsive-label">Cliente</span> <a href="orders.php?search=<?=$client->getUsername()?>"><?=$client->getName()." ".$client->getSurname()?></a></td>
                <td class="date"><span class="responsive-label">Entrada</span> <span><?=$order->getEnterDateString()?></span></td>
                <td class="date"><span class="responsive-label">Inicio</span><span><?=$order->getWorkingDateString()?></span></td>
                <td class="date hidden"><span class="responsive-label">Terminado</span><span><?=$order->getFinishDateString()?></span></td>
                <td class="date hidden"><span class="responsive-label">Entregado</span><span><?=$order->getOutDateString()?></span></td>
                <td class="date"><span class="responsive-label">Actualizado</span><span><?=$order->getUpdateDateString()?></span></td>
                <td class="desc"><span class="desc-cont"><?=$order->getObservations()?></span></td>
            </tr>
                    <?php
                }
            }else {
                ?>
                <tr class="order no-items"><td colspan="12">No se han encontrado órdenes.</td></tr>
                <?php
            }
            ?>
        </table>
    </div>
    
    <?php
}
/**
* Muestra el Select del filtro estados
*/
function showOrderStateFilter(){
    global $states; 
    global $stateFilter;
    ?>
    <label class="boxed-select" id="order-estate-filter">
        <div>Estado</div>
        <select data-class="labeled role-filter" name="stateFilter">
            <option value="-1">Todos</option>
        <?php
            foreach($states as $s){
            ?>
            <option value="<?=$s->getID()?>" data-class="<?=$s->getCssClass()?>" <?=$stateFilter == $s->getID() ? "selected" : "" ?>><?=$s->getName()?></option>
            <?php
            }
        ?>
    </select>
    </label>
    <?php
}