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

$edit;                                      //Si estas editando una prenda
$create;                                    //Si estas creando una prenda nueva

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


var_dump($_POST);
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
if(isset($_GET["id"]) && !empty($_GET["id"])){
    $edit = true;
}elseif(isset($_GET["newClothe"])){
    $create = true;
}else {
    header("Location: clothes.php");
}

//Obtener prenda
if(!$clothe = $controller->getClothe($_GET["id"])){
    header("Location: clothes.php");
};

/**
 * Mostrar Datos Prenda
 */
function showClotheInfoForm(){
    
    ?>
    <form id="clothe-info-container">
        <h1>Prenda</h1>
        <div class="field-set" id="clothe-infoset">
        <h3>Datos Prenda</h3>
            <label class="boxed-input" id="clothe-id">
                <div class="text-label"><span>ID</span></div>
                <div class="input-container">
                    <input type="text" value="000001" disabled>
                </div>
            </label>
            <label class="boxed-input" id="clothe-name">
                <div class="text-label"><span>Nombre Prenda</span></div>
                <div class="input-container">
                    <input type="text" value="Vaqueros">
                </div>
            </label>
            <label class="boxed-input" id="create-date">
                <div class="text-label"><span>Fecha de creacion</span></div>
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
            <div class="form-buttons">
                <input type="submit" value="Cambiar Nombre" class="input-submit-button">
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
            <input type="hidden" name="clothe-id" value="<?=$clothe->getId()?>">
            <input type="hidden" name="fix-id" value="<?=$fix->getId()?>">
            <div class="elem id"><input type="number" value="<?=$fix->getId()?>" name="fix-id" disabled></div>
            <div class="elem name"><input type="text" name="name" value="<?=$fix->getName()?>"></div>
            <div class="elem price"><input type="number" name="price" value="<?=$fix->getPrice()?>">€</div>
            <div class="elem active"><span class="label-box <?=$fix->isActive() ? "enabled": "disabled"?>"><?=$fix->isActive() ? "Activado": "Desactivado"?></span></div>
            <div class="elem creation-date"><?=$fix->getCreationDateString()?></div>
            <div class="elem update-date"><?=$fix->getUpdateDateString()?></div>
            <div class="elem buttons">
            <?php
                if($fix->isActive()){
                    ?><button class="table-button disable" name="disable"><div class="hint-box">Desactivar arreglo</div></button><?php
                }else {
                    ?><button class="table-button enable" name="disable"><div class="hint-box">Activar arreglo</div></button><?php
                }
            ?>
                <button class="table-button edit" name="edit"><div class="hint-box">Editar arreglo</div></button>
            </div>
        </form>
        <?php
        }          
    }
    ?>
    </div>
    <?php
}


/*function showFixesTable(){
    ?>
    <div class="table-container">
        <table class="fixes-table">
           <tr class="header-responsive-mobile">
                <th>Arreglos</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Arreglo</th>
                <th>Precio</th>
                <th>Activo</th>
                <th>Creado</th>
                <th></th>
            </tr>
            <tr>
                <td class="id a-center"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="toogle"><a href="" class="label-box disabled">Desactivar</a></td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="toogle"><a href="" class="label-box enabled">Activar</a></td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="toogle"><a href="" class="label-box disabled">Desactivar</a></td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box disabled">No</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="toogle"><a href="" class="label-box enabled">Activar</a></td>
            </tr>
            <tr>
                <td class="id"><span class="responsive-label">ID</span> <a href="">000001</a></td>
                <td><span class="responsive-label">Arreglo</span>Bajo pantalon</td>
                <td class="price a-center"><span class="responsive-label">Precio</span>10€</td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box enabled">Si</a></td>
                <td class="date"><span class="responsive-label">Creado</span> 17/04/2019 13:00</td>
                <td class="toogle"><a href="" class="label-box disabled">Desactivar</a></td>
            </tr>           
        </table>
    </div>
    
    <?php
}*/