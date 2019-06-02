<?php
/**
 * 
 * CONTROLADOR VENTANA PRENDAS
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
//Obtencion tipo usuario
if($sessionUserRole->getID() == 0){
    $client = true;
}elseif($sessionUserRole->getID() == 1){
    $employee = true;
}elseif($sessionUserRole->getID() == 2){
    $admin = true;
}

//Si no es un empleado o admin, a Client.php
if(!($employee || $admin)){
    $_SESSION["unauthorized"] = true;
    header("location: index.php");
}

//Asignar valores filtros
$page = 1;                          //Página
$search = "";                       //Cadena a buscar
$state = -1;                        //Estado de la prenda (activado/desactivado)
$orderBy = -1;                      //Ordenado por
$orderDirection = -1;               //Ordenado Ascendente o Descendente
//Si alguna de las variables esta asignada, reemplazamos el valor por defecto.
if(isset($_GET["page"]))            {$page = (int) $_GET["page"];}                      //Número Página
if(isset($_GET["search"]))          {$search = $_GET["search"];}                        //Cadena a buscar
if(isset($_GET["state"]))           {$state = (int) $_GET["state"];}                    //Estado Prenda
if(isset($_GET["orderBy"]))         {$orderBy = (int) $_GET["orderBy"];}                //Ordenado por
if(isset($_GET["orderDirection"]))  {$orderDirection = (int) $_GET["orderDirection"];}  //ORden ordenación

//Borrar Filtros
if(isset($_GET["clear"])){
    header("location: clothes.php");
}

//Obtenemos Valores
$totalClothes = $controller->getTotalClothes($search, $state);
$clothes = $controller->getClothes($search, $state, $orderBy, $orderDirection, $page);

//Registrar prenda
if(isset($_POST["createClothe"]) && ($admin || $employee)){
    switch($controller->addClothe($_POST["clotheName"])){
        case 0:
            $successMSG = "Prenda \"$_POST[clotheName]\" registrada con éxito.";
            break;
        case 1:
            $errorMSG = "Debes completar el campo nombre.";
            break;
        default:
            $errorMSG = "Se ha producido un error al registrar la prenda.";
            break;
    }
}

/**
 * Mostrar tabla prendas
 */
function showClothesTable(){
    global $clothes;
    ?>
    <div class="table-container">
        <table class="clothes-table">
           <tr class="header-responsive-mobile">
                <th>Prendas</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Prenda</th>
                <th>Nº Arreglos</th>
                <th>Activo</th>
                <th>Creado</th>
                <th>Actualizado</th>
            </tr>
            <?php 
                foreach($clothes as $clothe){
                    ?>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="clothe.php?<?=http_build_query(array("id" => $clothe->getID()))?>"><?=str_pad($clothe->getID(), 4, "0", STR_PAD_LEFT)?></a></td>
                <td class="clothe"><span class="responsive-label">Prenda</span><a href="clothe.php?<?=http_build_query(array("id" => $clothe->getID()))?>"><?=$clothe->getName()?></a></td>
                <td class="num-fixes a-center"><span class="responsive-label">NºAreglos</span><span><?=$clothe->getNumFixes()?></span></td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="clothes.php?state=<?=$clothe->isActive()?1:0?>" class="label-box <?=$clothe->isActive()?"enabled":"disabled"?>"><?=$clothe->isActive()?"Activado":"Desactivado"?></a></td>
                <td class="date"><span class="responsive-label">Creado</span><span><?=$clothe->getCreationDateString()?></span></td>
                <td class="date"><span class="responsive-label">Actualizado</span> <span><?=$clothe->getUpdateDateString()?></span></td>
            </tr>
                <?php
                }
            ?>     
        </table>
    </div>

    <?php
}