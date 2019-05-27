<?php
/*
*
* CONTROLADOR VENTANA USERS
*
*/
session_start();
require_once("Controllers/UserController.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("ViewControllers/vistaController.php");

$userController = new UserController(); //Controlador de usuarios

$sessionUser; //Usuario dueño de la sesion
$sessionUserRole; //Rol del usuario dueño de la sesion

$client = false;
$employee = false;
$admin = false;

//Filtros ventana
$filters = ["ID", "Nombre de Usuario", "Rol", "Nombre", "Apellidos", "Correo", "Activo", "Fecha de registro", "Fecha actualización"];

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
    header("location: client.php");
}

//Asignar valores filtros
$page = 1;
$search = "";
$userRoleFilter = -1;
$state = -1;
$orderBy = -1;
$orderDirection = -1;
if(isset($_GET["page"]))            {$page = (int) $_GET["page"];}
if(isset($_GET["search"]))          {$search = $_GET["search"];}
if(isset($_GET["userRole"]))        {$userRoleFilter = (int) $_GET["userRole"];}
if(isset($_GET["state"]))           {$state = (int) $_GET["state"];}
if(isset($_GET["orderBy"]))         {$orderBy = (int) $_GET["orderBy"];}
if(isset($_GET["orderDirection"]))  {$orderDirection = (int) $_GET["orderDirection"];}
if($page < 1){$page = 1;}//Si la página es menor que 1 la devuelve a 1
//Borrar Filtros
if(isset($_GET["clear"])){
    header("location: users.php");
}
//Obtencion de datos
$roles = $userController->getRoles(); //Obtenemos todos los roles disponibles para los filtros
$users = $userController->getUsers($search, $userRoleFilter,$state,$orderBy,$orderDirection, $page); //Obtenemos los usuarios
$totalUsers = $userController->getTotalUsers($search, $userRoleFilter,$state); //Obtenemos los usuarios totales

//Gestion de errores de User
if(isset($_SESSION["unknownUser"])){
    unset($_SESSION["unknownUser"]);
    $errorMSG = "No se encuentra ese usuario.";
}elseif(isset($_SESSION["registerSuccess"])){
    unset($_SESSION["registerSuccess"]);
    $successMSG = "Usuario registrado con éxito.";
}



/**
* Muestra el Select del filtro order-direction
*/
function showRoleFilter(){
    global $roles; 
    global $userRoleFilter;
    ?>
    <label class="boxed-select" id="role-filter">
        <div>Rol</div>
        <select data-class="labeled role-filter" name="userRole">
            <option value="-1">Todos</option>
        <?php
            foreach($roles as $r){
            ?>
            <option value="<?=$r->getID()?>" data-class="<?=$r->getCssClass()?>" <?=$userRoleFilter == $r->getID() ? "selected" : "" ?>><?=$r->getName()?></option>
            <?php
            }
        ?>
    </select>
    </label>
    <?php
}

/**
* Muestra la tabla de usuarios
*/
function showUsersTable(){
    global $users;
    ?>
    
    <div class="table-container">
        <table class="user-table">
           <tr class="header-responsive-mobile">
                <th>Usuarios</th>
            </tr>
            <tr class="header-responsive-desktop">
                <th>ID</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Registrado</th>
                <th>Activo</th>
                <th>Actualizado</th>
            </tr>
            <?php 
            if(sizeof($users) > 0){
                foreach($users as $user){
                    $role = $user->getRole();
                    ?>
            <tr class="user">
                <td class="id a-center"><span class="responsive-label">ID</span><a href="user.php?<?=http_build_query(array("id" => $user->getID()))?>"><?=str_pad($user->getID(), 4, "0", STR_PAD_LEFT)?></a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href="user.php?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getUsername()?></a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="users.php?<?=http_build_query(array("userRole" => $role->getID()))?>" class="label-box <?=$role->getCssClass()?>"><?=$role->getName()?></a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href="user.php?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getName()?></a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href="user.php?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getSurname()?></a></td>
                <td class="email"><span class="responsive-label">Correo</span><a href="user.php?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getEmail()?></a></td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span><span><?=$user->getRegisteredDateString()?></span></td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="users.php?<?=http_build_query(array("state" => $user->isActive()?1:0))?>" class="label-box <?=$user->isActive()?"enabled":"disabled"?>"><?=$user->isActive()?"Si":"No"?></a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span><span><?=$user->getUpdateDateString()?></span></td>
            </tr>
                    <?php
                }
            }else{
                ?><tr class="user no-items"><td colspan="9">No se han encontrado usuarios</td></tr><?php
            }
            ?>
            
        </table>
    </div>
    
    <?php
}