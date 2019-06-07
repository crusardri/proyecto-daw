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

$edit = false;                                  //Editando orden
$register = false;                              //Creando orden

$estates;                                        //Estados disponibles de la orden

$order = null;                                  //Orden a consultar
$orderItems = null;                             //Objetos de la orden
$orderClient = null;                            //Cliente de la orden
$orderEmployee = null;                          //Empleado asignado a la orden
$orderState = null;                             //Estado de la órden


//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    //Obtener USuario
    $sessionUser = $userController->getUser($_SESSION["userID"]);
    if(is_null($sessionUser) || !$sessionUser->isActive()){//Si no se encuentra
        session_destroy();
        header("location: login.php");
    }
    $sessionUserRole = $sessionUser->getRole();
}else {
    header("location: login.php");
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

//Obtenemos todos los estados
$states = $controller->getStates();

//Si estamos editando, obtenemos la orden, los orderItems, el cliente y
if($edit){
    try{
        $order = $controller->getOrder($_GET["id"]);
        if(is_null($order)){
            throw new Exception();
        }
        $orderItems = $controller->getOrderItems($_GET["id"]);
        $orderClient = $order->getClient();
        $orderEmployee = $order->getEmployee();
        //Si es cliente y no ha sido pedida por el, a index.php
        if($sessionUser->getID() != $orderClient->getID() && !($admin || $employee)){
            $_SESSION["unauthorized"] = true;
            header("location: index.php");
        }
    }catch(Exception $e){
        $_SESSION["orderNotFound"] = true;
        header("Location: orders.php");
    }
    
}

//Generar generar ordern falsa en caso de que falle al crear la orden
if($register){
    //Generamos los order-items
    if(isset($_POST["orderItemClotheID"])){
        $orderItems = array();
        for($i = 0; $i < sizeof($_POST["orderItemClotheID"]); $i++){
            $clothe = $controller->getClothe($_POST["orderItemClotheID"][$i]);
            $fix = $controller->getFix($_POST["orderItemClotheID"][$i],$_POST["orderItemFixID"][$i]);
            $price = $_POST["orderItemPrice"][$i];
            $description = $_POST["orderItemDescription"][$i];
            $oi = new OrderItem(null, $clothe, $fix, $price, $description);
            array_push($orderItems, $oi);
        }
    }
    //Generamos objeto usuario cliente
    if(isset($_POST["clientID"]) && !empty($_POST["clientID"])){
        $orderClient = $userController->getUser($_POST["clientID"]);
    }
    //Generamos objeto usuario empleado
    if(isset($_POST["employeeID"]) && !empty($_POST["employeeID"])){
        $orderEmployee = $userController->getUser($_POST["employeeID"]);
    }
    //Obtenemos la descripcion
    if(isset($_POST["orderDescription"]) && !empty($_POST["orderDescription"])){
        $description = $_POST["orderDescription"];
    }else{
        $description = "Sin descripción";
    }

    //Obtenemos la descripcion
    if(isset($_POST["orderNotes"]) && !empty($_POST["orderNotes"])){
        $notes = $_POST["orderNotes"];
    }else{
        $notes = "Sin notas";
    }
}
//Obtencion del titulo
if($edit){
    $title = "Orden: ".str_pad($order->getID(), 6, "0", STR_PAD_LEFT). " | ".$orderClient->getName();
}elseif($register){
    $title = "Nueva orden";
}
//Registrar orden
if(isset($_POST["createOrder"]) && ($admin || $employee) && $register){
    if(isset($_POST["clientID"])){
        $clientID = $_POST["clientID"];
    }else{
        $clientID = -1;
    }
    if(isset($_POST["employeeID"])){
        $employeeID = $_POST["employeeID"];
    }else {
        $employeeID = -1;
    }
    switch($controller->createOrder($clientID, $employeeID, $orderItems, $description, $notes)){
        case 0:
            $_SESSION["createOrdernSuccess"] = true;
            $lastOrderID = $controller->getLastOrderID();
            //header("Location: order.php?id=$lastOrderID");
            break;
        case 1:
            $errorMSG = "No se ha especificado un cliente.";
            break;
        case 2:
            $errorMSG = "No se ha especificado un empleado.";
            break;
        case 3:
            $errorMSG = "No se ha encontrado ninguna prenda en la órden.";
            break;
        default:
            $errorMSG = "Se ha producido un error al generar la orden.";
            break;
    };

}

//Registrar orden
if(isset($_POST["editOrder"]) && ($admin || $employee) && $edit){
    $stateID = $_POST["orderState"];
    $notes = $_POST["orderNotes"];
    $orderID = $_POST["orderID"];
    switch($controller->editOrder($orderID, $stateID, $notes)){
        case 0:
            $successMSG = "Se ha modificado la orden con éxito.";
            break;
        default:
            $errorMSG = "Se ha producido un error al editar la orden.";
            break;
    };
}

//Mensaje de crear orden correcto
if(isset($_SESSION["createOrdernSuccess"])){
    $successMSG = "Orden creada con éxito.";
    unset($_SESSION["createOrdernSuccess"]);
}

/**
 * Mostrar cabecera order
 */
function showOrderInfo(){
    global $edit, $register, $client, $admin, $employee, $order;
    if($edit){
    ?>
    <div class="order-info">
        <input type="hidden" name="orderID" value="<?=$order->getID()?>">
        <label class="boxed-input" id="username">
            <div class="text-label"><span>ID</span></div>
            <div class="input-container">
                <input type="text" value="<?=str_pad($order->getID(), 6, "0", STR_PAD_LEFT)?>" disabled>
            </div>
        </label>
        <?php
        if($employee || $admin){
        ?>
        <label class="boxed-input" id="update-date">
            <div class="text-label"><span>Fecha de actualizacion</span></div>
            <div class="input-container">
                <input type="text" value="<?=$order->getUpdateDateString()?>" disabled>
            </div>
        </label>
        <?php
        }
        ?>
    </div>      
    <?php
    }elseif($register){
        ?><div class="order-info"><h1>Nueva orden</h1></div><?php
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
                <div class="user-data">
            <?php if(isset($orderClient) && !is_null($orderClient)){ ?>
                    <input type="hidden" value="<?=$orderClient->getID()?>" name="clientID">
                    <div class="info-set">
                        <div class="form-info-title">Usuario</div>
                        <div class="form-info-data"><input type="text" value="<?=$orderClient->getUsername()?>" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre</div>
                        <div class="form-info-data"><input type="text" value="<?=$orderClient->getName()?>" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Apellidos</div>
                        <div class="form-info-data"><input type="text" value="<?=$orderClient->getSurname()?>" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Correo Electronico</div>
                        <div class="form-info-data"><input type="text" value="<?=$orderClient->getEmail()?>" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Telefono</div>
                        <div class="form-info-data"><input type="number" value="<?=$orderClient->getTelephone()?>" disabled></div>
                    </div>
                    <div class="info-set hidden"></div>
                
                <?php
                }else{
                    ?><div class="no-user">Seleccione un cliente.</div><?php
                }
                
                ?>
                </div>
                <?php
                //Mostrar boton cambiar cliente
                if($register && ($admin || $employee)){
                ?><div class="button" id="search-client">Cambiar</div><?php
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
                <div class="user-data">
            <?php if(isset($orderEmployee) && !is_null($orderEmployee)){ ?>

                    <input type="hidden" value="<?=$orderEmployee->getID()?>" name="employeeID">
                    <div class="info-set">
                        <div class="form-info-title">Usuario</div>
                        <div class="form-info-data"><input type="text" value="<?=$orderEmployee->getUsername()?>" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Nombre</div>
                        <div class="form-info-data"><input type="text" value="<?=$orderEmployee->getName()?>" disabled></div>
                    </div>
                    <div class="info-set">
                        <div class="form-info-title">Apellidos</div>
                        <div class="form-info-data"><input type="text" value="<?=$orderEmployee->getSurname()?>" disabled></div>
                    </div>
                    <?php
                    }else{ 
                         ?><div class="no-user">Seleccione un empleado.</div><?php
                    }
                    ?>
                </div>
                <?php 
                    if($register && ($admin || $employee)){ ?>
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
    if($edit){
    $state = $order->getState();
    ?>
    <div class="estate-container">
        <h2>Estado</h2>
        <?php
        foreach($states as $e){      
                switch($e->getID()){
                    case 1:
                        $date = $order->getEnterDateString();
                        break;
                    case 2:
                        $date = $order->getWorkingDateString();
                        break;
                    case 3:
                        $date = $order->getFinishDateString();
                        break;
                    case 4:
                        $date = $order->getOutDateString();
                        break;
                    case 5:
                        $date = $order->getCancelDateString();
                        break;
                    default:
                        $date = "-";
                        break;
                }
            
            ?>
        <label class="boxed-radio estate <?=$e->getCssClass()?>">
            <input type="radio" name="orderState" value="<?=$e->getId()?>" <?=$state->getID() == $e->getID()?"checked":""?> <?=!($admin||$employee)?"disabled":""?>>
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
        if(!is_null($orderItems) && sizeof($orderItems) > 0){
            foreach($orderItems as $oi){ 
                $clothe = $oi->getClothe();
                $fix = $oi->getFix();
        ?>
        <div class="order-item">
            <input type="hidden" value="<?=$clothe->getID()?>" name="orderItemClotheID[]">
            <input type="hidden" value="<?=$clothe->getID()?>" name="orderItemFixID[]">
            <label class="boxed-input clothe">
                <div class="text-label"><span>Prenda</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$clothe->getName()?>" disabled>
                </div>
            </label>
            <label class="boxed-input fix">
                <div class="text-label"><span>Arreglo</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$clothe->getName()?>" disabled>
                </div>            
            </label>
            <label class="boxed-input price">
                <div class="text-label"><span>Precio</span></div>
                <div class="input-container">
                    <input type="number" value="<?=$oi->getPrice()?>" name="orderItemPrice[]" step=".01" <?=$edit?"disabled":""?>>
                </div>
            </label>
            <label class="description-box order-item-description">
                <div class="header">Observaciones</div>
                <textarea name="orderItemDescription[]" <?=$edit?"disabled":""?>><?=$oi->getDescription()?></textarea>
            </label>
            <?php
            if($register){
                ?>
                <div class="button remove-order-item">Borrar</div>
                <?php
            }
            
            ?>
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
    <?php
    if($edit){
        ?>
        <label class="boxed-input" id="total-price-container">
            <div class="text-label"><span>Precio total</span></div>
            <div class="input-container">
                <input type="text" value="<?=$order->getPrice()?>€" disabled>
            </div>
        </label>
        <?php
    }else {
        ?>
        <label class="boxed-input" id="total-price-container">
            <div class="text-label"><span>Precio total</span></div>
            <div class="input-container">
                <input type="text" value="0.00€" disabled>
            </div>
        </label>
        <?php
    }
    ?>
</div>
    <?php
}
/**
 * Mostrara descripcion orden
 */
function showOrderDescription(){
    global $edit, $register, $order, $client, $admin, $employee, $description;
    if($edit){
        $description = $order->getDescription();
    }
    ?>
    <div class="order-description-container" id="order-description">
        <h2>Descripción</h2>
        <label class="description-box">
            <div class="header">Descripción del pedido</div>
            <textarea name="orderDescription" <?=$edit?"disabled":""?>><?=$description?></textarea>
        </label>
    </div>
    <?php
}
/**
 * Mostrar notas de la orden
 */
function showOrderNotes(){
    global $edit, $register, $order, $client, $admin, $employee, $notes;
    if($edit){
        $notes = $order->getNotes();
    }
    if($admin || $employee){
    ?>
    <div class="order-notes-container" id="order-notes">
        <h2>Notas</h2>
        <label class="description-box">
            <div class="header">Notas de la orden</div>
            <textarea name="orderNotes"><?=$notes?></textarea>
        </label>
    </div>
    <?php
    }
}
/**
 * Mostrar boton enviar/editar orden
 */
function showSubmitOrderButton(){
    global $edit, $register, $client, $admin, $employee;
    if(($admin ||$employee) && $edit){
    ?>
    <div class="form-buttons">
        <input type="submit" name="editOrder" value="Modificar órden" class="input-submit-button">
    </div>
    <?php
    }elseif(($admin ||$employee) && $register){
    ?>
    <div class="form-buttons">
        <input type="submit" name="createOrder" value="Crear órden" class="input-submit-button">
    </div>
    <?php
    }
}