<?php
/*
*
* CONTROLADOR VENTANA USERS
*
*/
session_start();
require_once("Controllers/LoginController.php");
require_once("Controllers/UserController.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");
require_once("ViewControllers/vistaController.php");

$userController = new UserController(); //Controlador de usuarios
$loginControler = new LoginController(); //Controlador de sesion

$sessionUser; //Usuario dueño de la sesion
$sessionUserRole; //Rol del usuario dueño de la sesion

$client = false;
$employee = false;
$admin = false;
//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    $sessionUser = $userController->getUser($_SESSION["userID"]); //Obtener usuario
    $sessionUserRole = $sessionUser->getRole(); //Obtener rol
    
} else {
    header("location: login.php"); //Si no tiene sesion iniciada, va al login.
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

//Si no es un empleado o admin, a Client.php
if(!($employee || $admin)){
    header("location: client.php");
}

if($sessionUserRole->getID() == 0){ //Comprobar rol
    header("location: client.php"); //Si cliente, a client.php
    //echo "Role 0";
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
//Borrar Filtros
if(isset($_GET["clear"])){
    header("location: users.php");
}
//Obtencion de datos
$roles = $userController->getRoles(); //Obtenemos todos los roles disponibles para los filtros
$users = $userController->getUsers($userRoleFilter,$state,$orderBy,$orderDirection, $page); //Obtenemos los usuarios
$totalUsers = $userController->getTotalUsers($userRoleFilter,$state,$orderBy,$orderDirection); //Obtenemos los usuarios totales


function showOrderByFilter(){
    global $orderBy;
    ?>
    <label class="boxed-select" id="order-by-filter">
        <div>Ordenar por</div>
        <select data-class="order-by-filter" name="orderBy">
            <option value="-1">Ninguno</option>
            <option value="0" <?=$orderBy == 0 ? "selected" : ""?>>ID</option>
            <option value="1" <?=$orderBy == 1 ? "selected" : ""?>>Nombre</option>
            <option value="2" <?=$orderBy == 2 ? "selected" : ""?>>Numero Arreglos</option>
            <option value="3" <?=$orderBy == 3 ? "selected" : ""?>>Activo</option>
            <option value="4" <?=$orderBy == 4 ? "selected" : ""?>>Fecha creación</option>
            <option value="5" <?=$orderBy == 5 ? "selected" : ""?>>Fecha actualización</option>
        </select>
    </label>
    <?php
}
/**
* Muestra el Select del filtro de estado
*
* @param integer $orderDirection            Tipo de filtro
*/
function showStateFilter(){
    global $state;
    ?>
    <label class="boxed-select" id="active-filter">
        <div>Estado</div>
        <select data-class="labeled" name="state">
            <option value="-1">Todos</option>
            <option value="0" data-class="enabled" <?=$state == 0 ? "selected" : "" ?>>Activado</option>
            <option value="1" data-class="disabled" <?=$state == 1 ? "selected" : "" ?>>Desactivado</option>
        </select>
    </label>
    <?php
}
/**
* Muestra el Select del filtro order-direction
*
* @param integer $orderDirection            Tipo de filtro
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
* Muestra el Select del filtro order-direction
*
* @param integer $orderDirection            Tipo de filtro
*/
function showOrderDirectionFilter(){
    global $orderDirection;
    ?>
    <label class="boxed-select" id="order-direction-filter">
        <div>Orden</div>
        <select data-class="order-direction-filter" name="orderDirection">
            <option value="0" <?=$orderDirection == 0 ? "selected" : ""?>>Ascendente</option>
            <option value="1" <?=$orderDirection == 1 ? "selected" : ""?>>Descendente</option>
        </select>
    </label>
    <?php
}
/**
* Muestra la tabla de usuarios
*
* @param $users Users[]             Array de usuarios
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
                foreach($users as $user){
                    $role = $user->getRole();
                    ?>
            <tr class="user">
                <td class="id a-center"><span class="responsive-label">ID</span><a href="user.php?<?=http_build_query(array("id" => $user->getID()))?>"><?=str_pad($user->getID(), 4, "0", STR_PAD_LEFT)?></a></td>
                <td class="username"><span class="responsive-label">Usuario</span> <a href="user.php?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getUsername()?></a></td>
                <td class="role a-center"><span class="responsive-label">Rol</span><a href="" class="label-box <?=$role->getCssClass()?>"><?=$role->getName()?></a></td>
                <td class="name"><span class="responsive-label">Nombre</span> <a href="user?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getName()?></a></td>
                <td class="surname"><span class="responsive-label">Apellidos</span> <a href="user?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getSurname()?></a></td>
                <td class="email"><span class="responsive-label">Correo</span><a href="user?<?=http_build_query(array("id" => $user->getID()))?>"><?=$user->getEmail()?></a></td>
                <td class="registration-date date a-center"><span class="responsive-label">Registro</span><span><?=$user->getRegisteredDateString()?></span></td>
                <td class="active a-center"><span class="responsive-label">Activo</span><a href="" class="label-box <?=$user->isActive()?"enabled":"disabled"?>"><?=$user->isActive()?"Si":"No"?></a></td>
                <td class="update-date date a-center"><span class="responsive-label">Actualizado</span><span><?=$user->getUpdateDateString()?></span></td>
            </tr>
                    <?php
                }
            ?>
            
        </table>
    </div>
    
    <?php
}