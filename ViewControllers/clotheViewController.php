<?php
/*
*
* CONTROLADOR VENTANA CLOTHE
*
*/
session_start();
require_once("Controllers/UserController.php");
require_once("Controllers/Controller.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("Classes/Clothe.php");
require_once("Classes/Fix.php");

$userController = new UserController();     //Controlador de usuarios
$controller = new Controller();             //Controlador general

$sessionUser;                               //Usuario dueño de la sesion
$sessionUserRole;                           //Rol del usuario dueño de la sesion


$client = false;                            //Si es cliente
$employee = false;                          //Si es empleado
$admin = false;                             //Si es administrador

$clothe;                                    //Prenda a editar

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


//var_dump($_POST);
//Obtención tipo usuario
if($sessionUserRole->getID() == 0){
    $client = true;
}elseif($sessionUserRole->getID() == 1){
    $employee = true;
}elseif($sessionUserRole->getID() == 2){
    $admin = true;
}

//Si no es un empleado o admin, a Client.php
if(!($employee || $admin)){
    header("location: client.php");
}

//Comprobamos si estamos editando o creando
if(!isset($_GET["id"]) && empty($_GET["id"])){
    header("Location: clothes.php");
}

//Obtener prenda
if(!$clothe = $controller->getClothe($_GET["id"])){
    header("Location: clothes.php");
};

// Titulo
$title = "Prenda: ".$clothe->getName();

//Cambiar nombre prenda
if(isset($_POST["changeClotheName"])){
    switch($controller->changeClotheName((int)$_POST["clotheID"], $_POST["clotheName"])){
        case 0:
            $successMSG = "Nombre de la prenda cambiado a \"$_POST[clotheName]\".";
            break;
        case 1:
            $errorMSG = "Debes poner un nombre a la prenda";
            break;
        default:
            $errorMSG = "Algo ha fallado al modificar la prenda.";
            break;
    }
}
//activar/desactivar prenda
if(isset($_POST["toggleClothe"])){
    switch($controller->toggleClothe($_POST["clotheID"], $_POST["active"])){
        case 0:
            if($_POST["active"] == 0){
                $successMSG = "Prenda \"".$clothe->getName()."\" activado con éxito.";
            }else{
                $successMSG = "Prenda \"".$clothe->getName()."\" desactivado con éxito.";
            }
            break;
        default:
            if($_POST["active"] == 0){
                $errorMSG = "Algo ha fallado al activar la prenda.";
            }else{
                $errorMSG = "Algo ha fallado al desactivar la prenda.";
            }
            break;
    }
}
//Registrar arreglo prenda
if(isset($_POST["registerFix"])){
    switch($controller->addFix($_POST["clotheID"], $_POST["fixName"], $_POST["fixPrice"], $_POST["active"])){
        case 0:
            $successMSG = "Arreglo registrado con éxito.";
            break;
        case 1:
            $errorMSG = "El ID de la prenda no especificado.";
            break;
        case 2:
            $errorMSG = "El nombre del arreglo no esta especificado.";
            break;
        case 3:
            $errorMSG = "El precio del arreglo no esta especificado.";
            break;
        default:
            $errorMSG = "Algo ha fallado al registrar el arreglo.";
            break;
    }
}
//Modificar Prenda
if(isset($_POST["editFix"])){
    switch($controller->editFix($_POST["fixID"], $_POST["fixName"], $_POST["fixPrice"])){
        case 0:
            $successMSG = "Arreglo \"$_POST[fixName]\" modificado con éxito.";
            break;
        case 1:
            $errorMSG = "El ID de la prenda no especificado.";
            break;
        case 2:
            $errorMSG = "El nombre del arreglo no esta especificado.";
            break;
        case 3:
            $errorMSG = "El precio del arreglo no esta especificado.";
            break;
        default:
            $errorMSG = "Algo ha fallado al modificar el arreglo.";
            break;
    }
}
//activar/desactivar arreglo
if(isset($_POST["toggle"])){
    switch($controller->toggleFix($_POST["clotheID"], $_POST["fixID"], $_POST["active"])){
        case 0:
            if($_POST["active"] == 0){
                $successMSG = "Arreglo \"$_POST[fixName]\" activado con éxito.";
            }else{
                $successMSG = "Arreglo \"$_POST[fixName]\" desactivado con éxito.";
            }
            break;
        default:
            if($_POST["active"] == 0){
                $errorMSG = "Algo ha fallado al activar el arreglo.";
            }else{
                $errorMSG = "Algo ha fallado al desactivar el arreglo.";
            }
            break;
    }
}
/**
 * Mostrar Datos Prenda
 */
function showClotheInfoForm(){
    global $errorMSG;
    global $successMSG;
    global $clothe;
    global $title;
    ?>
    <form id="clothe-info-container" method="post" action="clothe.php?id=<?=$clothe->getID()?>">
        <h1><?=$title?></h1>
        <?php
        if(isset($errorMSG)){
            ?><div class="msg error"><?=$errorMSG?></div><?php
        }elseif(isset($successMSG)){
            ?><div class="msg success"><?=$successMSG?></div><?php
        }
        ?>
        <div class="field-set" id="clothe-infoset">
        <h3>Datos Prenda</h3>
            <label class="boxed-input" id="clotheID">
                <div class="text-label"><span>ID</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$clothe->getID()?>" disabled>
                </div>
            </label>
            <label class="boxed-input" id="clothe-name">
                <div class="text-label"><span>Nombre Prenda</span></div>
                <div class="input-container">
                    <input type="text" name="clotheName" value="<?=$clothe->getName()?>">
                </div>
            </label>
            <label class="boxed-input" id="create-date">
                <div class="text-label"><span>Fecha de creacion</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$clothe->getCreationDateString()?>" disabled>
                </div>
            </label>
            <label class="boxed-input" id="update-date">
                <div class="text-label"><span>Fecha de actualizacion</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$clothe->getUpdateDateString()?>" disabled>
                </div>
            </label>
            <input type="hidden" name="clotheID" value="<?=$clothe->getID()?>">
            <div class="form-buttons">
                <input type="submit" value="Cambiar Nombre" name="changeClotheName" class="input-submit-button">
            </div>
        </div> 
    </form>
    <?php
}

function showClotheFixes(){
    global $clothe;
    $fixes = $clothe->getFixes();
    ?>
    <div class="table-like-container fixes">
        <div class="item header fixes">
            <div class="elem id">ID</div>
            <div class="elem name">Nombre Arreglo</div>
            <div class="elem price">Precio</div>
            <div class="elem active">Estado</div>
            <div class="elem creation-date">Fecha de creación</div>
            <div class="elem update-date">Fecha de actualización</div>
            <div class="elem buttons"></div>
        </div>
    <?php
    if(sizeof($fixes) <= 0){

    
    ?>
        <div class="item no-items">
            <div>No hay arreglos para esta prenda.</div>
        </div>
    <?php
    }else{
        foreach($fixes as $fix){
    ?>
        <form class="item" method="post" action="clothe.php?id=<?=$clothe->getId()?>">
            <input type="hidden" name="clotheID" value="<?=$clothe->getId()?>">
            <input type="hidden" name="fixID" value="<?=$fix->getId()?>">
            <input type="hidden" name="active" value="<?=$fix->isActive()?1:0?>">
            <div class="elem id"><input type="number" value="<?=$fix->getId()?>" disabled></div>
            <div class="elem name"><input type="text" name="fixName" value="<?=$fix->getName()?>"></div>
            <div class="elem price"><input type="number" name="fixPrice" value="<?=$fix->getPrice()?>">€</div>
            <div class="elem active"><span class="label-box <?=$fix->isActive() ? "enabled": "disabled"?>"><?=$fix->isActive() ? "Activado": "Desactivado"?></span></div>
            <div class="elem creation-date"><?=$fix->getCreationDateString()?></div>
            <div class="elem update-date"><?=$fix->getUpdateDateString()?></div>
            <div class="elem buttons">
            <?php
                if($fix->isActive()){
                    ?><button class="table-button disable" name="toggle"><div class="hint-box">Desactivar arreglo</div></button><?php
                }else {
                    ?><button class="table-button enable" name="toggle"><div class="hint-box">Activar arreglo</div></button><?php
                }
            ?>
                <button class="table-button edit" name="editFix"><div class="hint-box">Editar arreglo</div></button>
            </div>
        </form>
        <?php
        }          
    }
    ?>
    </div>
    <?php
}
function showStateForm(){
    global $clothe;
    ?>
    <form id="active-container" method="post" action="clothe.php?id=<?=$clothe->getID()?>">
        <h2>Estado</h2>
        <div>
            <label class="boxed-radio active">
                <input type="radio" name="active" value="1" <?=$clothe->isActive()?"checked":""?>>
                <div class="container">
                    <div class="radio-checkbox">&#x2713;</div>
                    <div class="radio-title">Activado</div>
                    <div class="radio-desc">Aparecerá en los listados y estará disponible para añadir en nuevas órdenes.</div>
                </div>
            </label>
            <label class="boxed-radio disabled">
                <input type="radio" name="active" value="0" <?=!$clothe->isActive()?"checked":""?>>
                <div class="container">
                    <div class="radio-checkbox">&#x2713;</div>
                    <div class="radio-title">Desactivado</div>
                    <div class="radio-desc">No se podrá añadir a nuevas órdenes, pero se mantendrán en órdenes antiguas para consulta.</div>
                </div>
            </label>
        </div>
        <input type="hidden" name="clotheID" value="<?=$clothe->getID()?>">
        <div class="form-buttons">
            <input type="submit" value="Actualizar estado" class="input-submit-button" name="toggleClothe">
        </div>
    </form>
    <?php
}