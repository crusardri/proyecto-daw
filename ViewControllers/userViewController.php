<?php
/*
*
* CONTROLADOR VENTANA USER
*
*/
session_start();
require_once("Controllers/UserController.php");
require_once("Classes/User.php");
require_once("Classes/Role.php");

$userController = new UserController(); //Controlador de usuarios

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

/**
* Comprueba que este la sesion iniciada y obtiene el usuario y el rol, si no lo esta te devuelve a login.php
*/
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



/**
* Obtiene el tipo de usuario;
*/
if($sessionUserRole->getID() == 0){//Si es un cliente
    $client = true;
}elseif($sessionUserRole->getID() == 1){ //Si es un empleado
    $employee = true;
}elseif($sessionUserRole->getID() == 2){ //Si es administrador
    $admin = true;
}

/**
*  Obtiene el tipo de visualización;
*/
//Setear Modo
if(isset($_GET["id"]) && !empty($_GET["id"])){//Si el parametro ID esta declarado y no es vacio, editara un usuario
    $edit = true;
    $title = "Editar usuario: ";
}elseif(isset($_GET["newUser"])){//Si el parametro newUser esta declarado, creara un usuario
    $register = true;
    $title = "Registrar usuario";
}else { //Si no a empleado.php 
    $_SESSION["unauthorized"] = true;
    header("Location: index.php");
}



/**
* Obtiene el usuario, si es empleado o admin, obtiene cualquier, si es cliente, obtiene solo el suyo.
*/
//Si estas editando, eres empleado o admin, o es tu usuario
if($edit && (($employee || $admin) || $sessionUser->getID() == $_GET["id"])){ 
    $user = $userController->getUser($_GET["id"]);
    $userRole = $user->getRole();
}else {
    $_SESSION["unauthorized"] = true;
    header("location: index.php");
}
//Si el usuario no existe genera un error
if($edit && is_null($user)){//Si el usuario no existe
    $_SESSION["unknownUser"] = true;
    header("location: users.php");
}
//Establece un titulo para la página
if($edit){
    $title = $title . $user->getUsername();
}

//Comprobamos si ha iniciado sesión y el rol que tiene
if(isset($_SESSION["userID"])){
    $sessionUser = $userController->getUser($_SESSION["userID"]); //Obtener usuario
    $sessionUserRole = $sessionUser->getRole(); //Obtener rol
    //Si es un cliente
    
} else {
    header("location: login.php"); //Si no tiene sesion iniciada, va al login.
}



/**
 * Registrar Usuario
 * Solo si eres admin o empleado
 */
if(isset($_POST["registerUser"]) && ($admin || $employee)){
    $username =     isset($_POST["username"]) ?     $_POST["username"] : null;
    $email =        isset($_POST["email"]) ?        $_POST["email"] : null;
    $password =     isset($_POST["password"]) ?     $_POST["password"] : null;
    $name =         isset($_POST["name"]) ?         $_POST["name"] : null;
    $surname =      isset($_POST["surname"]) ?      $_POST["surname"] : "";
    $phone =        isset($_POST["phone"]) ?        $_POST["phone"] : "";
    $role =         isset($_POST["role"]) ?         $_POST["role"] : 0;
    $active =       isset($_POST["active"]) ?       $_POST["active"] : 0;
    switch ($userController->registerUser($username, $password, $email, $name, $surname, $phone, $role, $active)){
        case 0:
            $_SESSION["registerSuccess"] = $username;
            header("location: users.php");
            break;
        case 1:
            $errorMSG = "El nombre de usuario debe tener al menos 4 carácteres y no debe contener especios ni carácteres especiales.";
            break;
        case 2: 
            $errorMSG = "El nombre de usuario ya esta registrado.";
            break;
        case 3:
            $errorMSG = "La contraseña debe tener al menos 6 carácteres.";
            break;
        case 4:
            $errorMSG = "El correo electrónico no es válido.";
            break;
        case 5: 
            $errorMSG = "El correo electrónico está registrado.";
            break;
        case 6:
            $errorMSG = "No has rellenado el campo \"nombre\".";
            break;
        case -1: 
            $errorMSG = "Se ha producido un error al registrar al  usuario.";
    }
}
/**
 * Cambiar correo
 */
if(isset($_POST["changeEmail"])){
    $clientAuthorize = $client && ($sessionUser->getID() == $user->getID());
    $employeeAuthorize = $employee && ($sessionUser->getID() == $user->getID() || $userRole->getID() < $sessionUserRole->getID());
    //Si es un cliente, y es su mismo usuario
    //Si es un empleado, es su usuario o el usuario a editar es de un rol inferior
    //Si eres administrador
    if($clientAuthorize || $employeeAuthorize || $admin){
        switch ($userController->changeEmail($user->getID(), $_POST["email"])){
            case 0:
                $user = $userController->getUser($_GET["id"]);
                $successMSG = "Correo electrónico cambiado con exito";
                break;
            case 1:
                $errorMSG = "El correo electrónico parece no estar bien formado.";
                break;
            case 2: 
                $errorMSG = "El correo electrónico está en uso por otro usuario.";
                break;
            default: 
                $errorMSG = "Se ha producido un error al cambiar el correo electrónico.";
                break;
        }  
    }else {
        $errorMSG = "No estas autorizado para cambiar el correo a este usuario";
    }
}

/**
 * Cambiar contraseña
 */
if(isset($_POST["changePassword"])){
    $sameUser = $sessionUser->getID() == $user->getID();
    $employeeAuthorize = $employee && ($sessionUser->getID() == $user->getID() || $userRole->getID() < $sessionUserRole->getID());
    $password = $_POST["password"];                 //Contraseña nueva
    if(isset($_POST["oldPassword"])){
        $oldPassword = $_POST["oldPassword"];       //Contraseña antigua
    }
    if(isset($_POST["repPassword"])){
        $repeatPassword = $_POST["repPassword"];    //Repetir Contraseña
    }
    //Si eres un cliente o es tu cuenta
    if($client || $user->getID() == $sessionUser->getID()){
        switch ($userController->changePasswordClient($oldPassword, $password, $repeatPassword, $user)){
            case 0:
                session_destroy();
                session_start();
                $_SESSION["changePasswordSuccess"] = true;
                header("location: login.php");
                break;
            case 1:
                $errorMSG = "La contraseña anterior no es correcta.";
                break;
            case 2:
                $errorMSG = "La contraseña debe tener al menos 6 carácteres.";
                break;
            case 3:
                $errorMSG = "Las contraseñas no coinciden.";
                break;
            default: 
                $errorMSG = "Se ha producido un error al al cambiar la contraseña.";
                break;
        }
    //Si eres un empleado autorizado, o Administrador
    }elseif($employeeAuthorize || $admin){
        switch ($userController->changePasswordAdmin($password, $user)){
            case 0:
                $successMSG = "Contraseña del usuario cambiada con éxito.";
                $user = $userController->getUser($_GET["id"]);
                break;
            case 1:
                $errorMSG = "La contraseña debe tener al menos 6 carácteres.";
                break;
            default: 
                $errorMSG = "Se ha producido un error al cambiar la contraseña.";
                break;
        }
    }else {
        $errorMSG = "No estas autorizado para cambiar la contraseña.";
    }
}

/**
 * Cambiar informacion personal
 */
if(isset($_POST["changePersonalInfo"])){
    switch($userController->changePersonalInfo($user->getID(), $_POST["name"], $_POST["surname"], $_POST["phone"])){
        case 0: 
            $successMSG = "Informacion personal actualizada.";
            $user = $userController->getUser($_GET["id"]);
            break;
        case 1: 
            $errorMSG = "\"Nombre\" es un campo obligatorio.";
            break;
        case -1: 
            $errorMSG = "Se ha producido un error al actualizar la informacion de usuario.";
            break;
    }
}
/**
 * Cambiar Rol
 */
if(isset($_POST["changeRole"])){
    //Si eres admin y la ID de usuario a modificar no es la misma que la tuya
    if($admin && $user->getID() != $sessionUser->getID()){
        switch($userController->changeRole($user->getID(), $_POST["role"])){
            case 0: 
                $successMSG = "Rol de usuario actualizado.";
                $user = $userController->getUser($_GET["id"]);
                break;
            default: 
                $errorMSG = "Se ha producido un error al cambiar el rol del usuario.";
                break;
        }
    }else {
        $errorMSG = "No estas autorizado para cambiar el rol de este usuario.";
    }
    
}
/**
 * Cambiar Rol
 */
if(isset($_POST["changeState"])){
    //Si eres admin y la ID de usuario a modificar no es la misma que la tuya
    $newState = $_POST["active"];
    if($newState == 0){
        $newState = true;
    }else{
        $newState = false;
    }
    if($admin && $user->getID() != $sessionUser->getID()){
        switch($userController->changeState($user->getID(), $newState)){
            case 0: 
                $user = $userController->getUser($_GET["id"]);
                $successMSG = "Estado de usuario actualizado.";
                break;
            default: 
                $errorMSG = "Se ha producido un error al cambiar el estado del usuario.";
                break;
        }
    }else {
        $errorMSG = "No estas autorizado para cambiar el estado de este usuario.";
    }
    
}
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
    global $edit, $client, $employee, $admin, $user;
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
    global $edit, $client, $employee, $admin, $user;
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
    global $edit, $client, $register, $employee, $admin, $user;
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
        global $username, $email;
        ?>
        <div class="field-set" id="account-info">
        <h3>Datos Cuenta</h3>
            <label class="boxed-input" id="username">
                <div class="text-label"><span>Nombre de usuario</span></div>
                <div class="input-container">
                    <input type="text" name="username" value="<?=isset($username)?$username:""?>">
                </div>
            </label>
            <label class="boxed-input" id="email">
                <div class="text-label"><span>Correo Electronico</span></div>
                <div class="input-container">
                    <input type="text" name="email" value="<?=isset($email)?$email:""?>">
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
    global $edit, $register, $register, $client, $employee, $admin, $user, $sessionUser;
    
    if($edit){
    ?>
        <form id="change-password-container" method="post" action="user.php?id=<?=$user->getID()?>">
            <div class="field-set" id="change-password">
            <input type="hidden" name="id" value="<?=$user->getID()?>">
            <input type="hidden" name="changePassword">
            <h3>Cambiar contraseña</h3>
                <?php 
                if($client || $user->getID() == $sessionUser->getID()){ //Si es un cliente o es tu cuenta, require el campo "Contraseña antigua"
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
                if($client || $user->getID() == $sessionUser->getID()){ //Si es un cliente o es tu cuenta, require el campo "Repetir contraseña"
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
    global $edit, $register, $register, $client, $employee, $admin, $user, $sessionUser;
    
    //Si editas, y eres admin, empleado o Cliente y tu ID es igual a la del usuario a consultar
    if($edit && ($admin || $employee ||($client || $user->getID() == $sessionUser->getID()))){
    ?>
    <form id="personal-info-container" action="user.php?id=<?=$user->getID()?>" method="post">
        <input type="hidden" name="changePersonalInfo">
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
    //Si estas registrando y eres admin o empleado
    }elseif($register && ($admin || $employee)){
        global $name, $surname, $phone;
    ?>
    <div class="field-set" id="personal-info">
        <h3>Datos personales</h3>
        <label class="boxed-input" id="username">
            <div class="text-label"><span>Nombre</span></div>
            <div class="input-container">
                <input type="text" name="name" value="<?=isset($name)?$name:""?>">
            </div>
        </label>
        <label class="boxed-input" id="surname">
            <div class="text-label"><span>Apellidos</span></div>
            <div class="input-container">
                <input type="text" name="surname" value="<?=isset($surname)?$surname:""?>">
            </div>
        </label>
        <label class="boxed-input" id="phone">
            <div class="text-label"><span>Teléfono</span></div>
            <div class="input-container">
                <input type="number" name="phone" value="<?=isset($phone)?$phone:""?>">
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
    global $edit, $register, $register, $client, $employee, $admin, $user, $roles, $userRole, $sessionUser;
    if($userRole){
        $userRole = $user->getRole();
    }
    
    
    if($edit && ($admin || $employee) && $user->getID() != $sessionUser->getID()){
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
        if($admin && $user->getID() != $sessionUser->getID()){
            ?>
        <div class="form-buttons">
            <input type="submit" value="Cambiar Rol" class="input-submit-button" name="changeRole">
        </div>
            <?php
        }
        ?>
        
    </form>
    <?php
    }elseif($register && ($admin || $employee)){
        global $role;
        if(isset($role)){
            $activeRole = $role;
        }else {
            $activeRole = 0;
        }
        ?>
    <div id="role-form">
        <h2>Rol</h2>
        <div> 
        <?php
            if($admin){
                foreach($roles as $role){
                ?>
        <label class="boxed-radio <?=$role->getCssClass()?>">
            <input type="radio" name="role" value="<?=$role->getID()?>" <?=$role->getID() == $activeRole ? "checked" : ""?>>
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
    </div>
            <?php
        }
    }
}

/**
* Muestra el formulario de estado de usuario
*/
function showUserStateForm(){
    global $edit, $register, $register, $client, $employee, $admin, $sessionUser, $user, $sessionUserRole, $userRole;
    //Es editar, eres empleado o admin, 
    //el rango de usuario de la sesion sea igual o superior al rango del usuario a editar 
    //y no es tu cuenta
    if($edit && ($employee || $admin) && $user->getID() != $sessionUser->getID()){
    ?>
    <form id="active-form" method="post" action="user.php?id=<?=$user->getID()?>">
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
        <?php 
        //El rol del usuario que edita es mayor o igual
        //y un empleado no esta editando a otro empleado
        if($sessionUserRole->getID() >= $userRole->getID() &&
        !($sessionUserRole->getID() == 0 && $userRole->getID() == 0)){
            ?>
        <div class="form-buttons">
            <input type="submit" value="Cambiar Estado" class="input-submit-button" name="changeState">
        </div>
            <?php
        }
        ?>
        
    </form>
    <?php
    }elseif($register && ($employee || $admin)){
        global $active;
        if(!isset($active) || !empty($active)){
            $active = 1;
        }
        ?>
    <div id="active-form">
        <h2>Estado</h2>
        <div>
            <label class="boxed-radio active">
                <input type="radio" name="active" value="1" <?=$active == 1 ? "checked" : ""?>>
                <div class="container">
                    <div class="radio-checkbox">&#x2713;</div>
                    <div class="radio-title">Activado</div>
                    <div class="radio-desc">El usuario puede iniciar sesión y utilizar la aplicación con normalidad, aparecerá en las listas</div>
                </div>
            </label>
            <label class="boxed-radio disabled">
                <input type="radio" name="active" value="0" <?=$active == 0 ? "checked" : ""?>>
                <div class="container">
                    <div class="radio-checkbox">&#x2713;</div>
                    <div class="radio-title">Desactivado</div>
                    <div class="radio-desc">El usuario esta desactivado, no podrá iniciar sesión, ni aparecerá en las listas, pero se mantendrá en la Base de datos para consulta.</div>
                </div>
            </label>
        </div>
    </div>
    <?php
    }
    
}
