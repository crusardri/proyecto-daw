<?php
/*
*
* CONTROLADOR VENTANA USER
*
*/
session_start();
require_once("Controllers/LoginController.php");
require_once("Controllers/UserController.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");

$userController = new UserController(); //Controlador de usuarios
$loginControler = new LoginController(); //Controlador de sesion

$sessionUser; //Usuario dueño de la sesion
$sessionUserRole; //Rol del usuario dueño de la sesion

$title; //Titulo de la ventana
$roles = $userController->getRoles(); //Todos los roles

$user; //Usuario a consultar
$userRole; //Rol del usuario a consultar

$client = false; //Es cliente
$employee = false; //Es empleado
$admin = false; //Es admin

$edit = false; //Modo Editar
$register = false; //Modo nuevo registro

echo "<pre>";

/**
* Comprueba que este la sesion iniciada y obtiene el usuario y el rol, si no lo esta te devuelve a login.php
*/
if(isset($_SESSION["userID"])){
    //Obtener USuario
    $sessionUser = $userController->getUser($_SESSION["userID"]);
    $sessionUserRole = $sessionUser->getRole();
}else {
    header("location: login.php");
}



/**
* Obtiene el tipo de usuario;
*/
if($sessionUserRole->getID() == 0){//Si es un cliente
    $client = true;
    echo "Soy un Cliente\n";
}elseif($sessionUserRole->getID() == 1){ //Si es un empleado
    $employee = true;
    echo "Soy un Empleado\n";
}elseif($sessionUserRole->getID() == 2){ //Si es administrador
    $admin = true;
    echo "Soy un Administrador\n";
}

/**
*  Obtiene el tipo de visualización;
*/
//Setear Modo
if(isset($_GET["id"]) && !empty($_GET["id"])){//Si el parametro ID esta declarado y no es vacio, editara un usuario
    echo "Estoy Editando un usuario\n";
    $edit = true;
    $title = "Editar usuario: ";
}elseif(isset($_GET["newUser"])){//Si el parametro newUser esta declarado, creara un usuario
    $register = true;
    $title = "Crear usuario";
    echo "Estoy creando un usuario nuevo\n";
}else { //Si no a empleado.php 
    //header("Location: employee.php");
}



/**
* Obtiene el usuario, si es empleado o admin, obtiene cualquier, si es cliente, obtiene solo el suyo.
*/
if($edit && ($employee || $admin)){ //Si esta editando, y es empleado o admin
    $user = $userController->getUser($_GET["id"]);
    echo "Soy Admin/Empleado y puedo ver cualquier usuario";
}elseif($edit && $client && $sessionUser->getID() == $_GET["id"]){ //Si esta editando, es cliente y esta consultando su misma ID
    $user = $userController->getUser($_GET["id"]);
    echo "Soy cliente, estoy editando, y la ID que estoy consultando es la misma que la mia";
}else {
    //header("location: employee.php");
}
    

if($edit){
    $title = $title . $user->getUsername();
}
echo "</pre>";

//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    $sessionUser = $userController->getUser($_SESSION["userID"]); //Obtener usuario
    $sessionUserRole = $sessionUser->getRole(); //Obtener rol
    //Si es un cliente
    
} else {
    header("location: login.php"); //Si no tiene sesion iniciada, va al login.
}

/*if(isset($_GET["id"]) && empty($_GET["ID"])){
    header("location:users.php"); //Si la ID esta vacia redirije a Users.php
}elseif(isset($_GET["id"]) && empty($_GET["ID"])){
    
}
*/

/**
* Muestra el campo UserID si esta editando, y es Empleado o Administrador
*/
function showIDField(){
    global $edit;
    global $client;
    global $employee;
    global $admin;
    global $user;
    
    if($edit && ($employee || $admin)){
        ?>
        <label class="boxed-input" id="username">
            <div class="text-label"><span>ID</span></div>
            <div class="input-container">
                <input type="text" value="<?=$user->getID()?>" disabled>
            </div>
        </label>
        <?php
    }
}
/**
* Muestra el campo de Fecha de registro si esta editando, y es Empleado o Administrador
*/
function showRegisterDateField(){
    global $edit;
    global $client;
    global $employee;
    global $admin;
    global $user;
    ?>
    <label class="boxed-input" id="register-date">
        <div class="text-label"><span>Fecha de registro</span></div>
        <div class="input-container">
            <input type="text" value="<?=$user->getRegisteredDateString()?>" disabled>
        </div>
    </label>
    <?php
}
/**
* Muestra el campo Fecha Actualizacion si esta editando, y es Empleado o Administrador
*/
function showUpdateDateField(){
    global $edit;
    global $client;
    global $employee;
    global $admin;
    global $user;
    if($employee || $admin){
    ?>
    <label class="boxed-input" id="update-date">
        <div class="text-label"><span>Fecha de actualización</span></div>
        <div class="input-container">
           <input type="text" value="<?=$user->getUpdateDateString()?>" disabled>
        </div>
    </label>
    <?php
    }
}
/**
* Muestra el formulario informacion de la cuenta
*/
function showAccountDataForm(){
    global $edit;
    global $client;
    global $register;
    global $employee;
    global $admin;
    global $user;
    
    if($edit){
    ?>
    <form id="account-info-container" method="post" action="user.php?id=<?=$user->getID()?>">
        <input type="hidden" name="id" value="<?=$user->getID()?>">
        <input type="hidden" name="changeEmail">
        <div class="field-set" id="client-infoset">
        <h3>Datos Cuenta</h3>
            <label class="boxed-input" id="username">
                <div class="text-label"><span>Nombre de usuario</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$user->getUsername()?>" disabled>
                </div>
            </label>
            <label class="boxed-input" id="email">
                <div class="text-label"><span>Correo Electronico</span></div>
                <div class="input-container">
                    <input type="text" value="<?=$user->getEmail()?>" name="email">
                </div>
            </label>
            <div class="form-buttons">
                <input type="submit" value="Cambiar Correo" class="input-submit-button">
            </div>
        </div>   
    </form>
        <?php
    }elseif($register){
        ?>
        <div class="field-set" id="client-infoset">
        <h3>Datos Cuenta</h3>
            <label class="boxed-input" id="username">
                <div class="text-label"><span>Nombre de usuario</span></div>
                <div class="input-container">
                    <input type="text" name="">
                </div>
            </label>
            <label class="boxed-input" id="email">
                <div class="text-label"><span>Correo Electronico</span></div>
                <div class="input-container">
                    <input type="text" name="email">
                </div>
            </label>
            <label class="boxed-input" id="password">
                <div class="text-label"><span>Contraseña</span></div>
                <div class="input-container">
                    <input type="password" name="password">
                </div>
            </label>
        </div>   
        <?php
    }
}

/**
* Muestra formulario sobre la contraseña
*/
function showPasswordForm(){
    global $edit;
    global $register;
    global $register;
    global $client;
    global $employee;
    global $admin;
    global $user;
    
    if($edit){
    ?>
        <form id="change-password-container" method="user.php?id=<?=$user->getID()?>">
            <div class="field-set" id="change-password">
            <input type="hidden" name="id" value="<?=$user->getID()?>">
            <input type="hidden" name="changePassword">
            <h3>Cambiar contraseña</h3>
                <?php 
                if($client){ //Si es un cliente, require el campo "Contraseña antigua"
                    ?>
                <label class="boxed-input mandatory" id="old-password">
                    <div class="text-label"><span>Contraseña actual</span></div>
                    <div class="input-container">
                        <input type="password" name="oldPassword"> 
                    </div>
                </label>
                    <?php
                }
                
                ?>
                <label class="boxed-input mandatory" id="password">
                    <div class="text-label"><span>Contraseña nueva</span></div>
                    <div class="input-container">
                        <input type="password" name="password">
                    </div>
                </label>
                <?php 
                if($client){ //Si es un cliente, require el campo "Repetir contraseña;
                    ?>
                <label class="boxed-input mandatory" id="repeatPassword">
                    <div class="text-label"><span>Repetir Contraseña</span></div>
                    <div class="input-container">
                        <input type="password" name="repPassword"> 
                    </div>
                </label>
                    <?php
                }
                ?>
                <div class="form-buttons">
                    <input type="submit" value="Cambiar contraseña" class="input-submit-button">
                </div>
            </div>
        </form>
    <?php
    }
}

/**
* Muestra formulario datos personales
*/
function showPersonalInfoForm(){
    global $edit;
    global $register;
    global $register;
    global $client;
    global $employee;
    global $admin;
    global $user;
   
    
    if($edit){
    ?>
    <form id="personal-info-container">
        <div class="field-set" id="personal-info-infoset">
            <h3>Datos personales</h3>
            <label class="boxed-input" id="username">
                <div class="text-label"><span>Nombre</span></div>
                <div class="input-container">
                    <input type="text" name="name" value="<?=$user->getName()?>">
                </div>
            </label>
            <label class="boxed-input" id="surname">
                <div class="text-label"><span>Apellidos</span></div>
                <div class="input-container">
                    <input type="text" name="surname" value="<?=$user->getSurname()?>">
                </div>
            </label>
            <label class="boxed-input" id="phone">
                <div class="text-label"><span>Teléfono</span></div>
                <div class="input-container">
                    <input type="number" name="phone" value="<?=$user->getTelephone()?>">
                </div>
            </label>
            <div class="form-buttons">
                <input type="submit" value="Cambiar datos" class="input-submit-button">
            </div>
        </div>
    </form>
    <?php
    }elseif($register){
    ?>
    <div class="field-set" id="personal-info-infoset">
        <h3>Datos personales</h3>
        <label class="boxed-input" id="username">
            <div class="text-label"><span>Nombre</span></div>
            <div class="input-container">
                <input type="text" name="name">
            </div>
        </label>
        <label class="boxed-input" id="surname">
            <div class="text-label"><span>Apellidos</span></div>
            <div class="input-container">
                <input type="text" name="surname">
            </div>
        </label>
        <label class="boxed-input" id="phone">
            <div class="text-label"><span>Teléfono</span></div>
            <div class="input-container">
                <input type="number" name="phone">
            </div>
        </label>
    </div>
    <?php    
    }
}
/**
* Muestra los roles de usuario
*/
function showRoleForm(){
    global $edit;
    global $register;
    global $register;
    global $client;
    global $employee;
    global $admin;
    global $user;
    global $roles;
    $userRole = $user->getRole();
    
    if($edit && ($admin || $employee)){
    ?>
    <form id="role-form" action="user.php?id=<?=$user->getID()?>" method="post">
        <h2>Rol</h2>
        <div>
            
            <?php
            if($admin){
                foreach($roles as $role){
                ?>
        <label class="boxed-radio <?=$role->getCssClass()?>">
            <input type="radio" name="role" value="<?=$role->getID()?>" <?=$userRole->getID() == $role->getID() ? "checked" : ""?>>
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title"><?=$role->getName()?></div>
                <div class="radio-desc"><?=$role->getDescription()?></div>
            </div>
        </label>
                <?php
                }
            }elseif($employee){
                ?>
        <label class="boxed-radio <?=$userRole->getCssClass()?>">
            <input type="radio" name="role" value="<?=$userRole->getID()?>" checked>
            <div class="container">
                <div class="radio-checkbox">&#x2713;</div>
                <div class="radio-title"><?=$userRole->getName()?></div>
                <div class="radio-desc"><?=$userRole->getDescription()?></div>
            </div>
        </label>
                <?php
            }
            ?>
        </div>
        <?php 
        if($admin){
            ?>
        <div class="form-buttons">
            <input type="submit" value="Cambiar Rol" class="input-submit-button">
        </div>
            <?php
        }
        ?>
        
    </form>
    <?php
    }
}
/**
* Muestra el formulario de estado de usuario
*/
function showUserStateForm(){
    global $edit;
    global $register;
    global $register;
    global $client;
    global $employee;
    global $admin;
    global $user;
    
    if($edit && ($employee || $admin)){
    ?>
    <form id="active-form">
        <h2>Estado</h2>
        <div>
            <label class="boxed-radio active">
                <input type="radio" name="active" value="1" <?=$user->isActive()?"checked":""?>>
                <div class="container">
                    <div class="radio-checkbox">&#x2713;</div>
                    <div class="radio-title">Activado</div>
                    <div class="radio-desc">El usuario puede iniciar sesión y utilizar la aplicación con normalidad, aparecerá en las listas</div>
                </div>
            </label>
            <label class="boxed-radio disabled">
                <input type="radio" name="active" value="0" <?=!$user->isActive()?"checked":""?>>
                <div class="container">
                    <div class="radio-checkbox">&#x2713;</div>
                    <div class="radio-title">Desactivado</div>
                    <div class="radio-desc">El usuario esta desactivado, no podrá iniciar sesión, ni aparecerá en las listas, pero se mantendrá en la Base de datos para consulta.</div>
                </div>
            </label>
        </div>
        <div class="form-buttons">
            <input type="submit" value="Cambiar estado" class="input-submit-button">
        </div>
    </form>
    <?php
    }
    
}
