<?php

class UserController {
    /**
    * Devuelve una conexion a la Base de datos
    * @return PDO Conexion a la base de datos completa.
    */
    private function connect(){
        return new PDO("sqlite:.data/data.db");
    }
    /**
    * Consulta en la base de datos un usuario por ID y devuelve un objeto de clase Usuario
    * @Return User  Un usuario completo
    */
    public function getUser($id){
        //TO DO
        $roles = $this->getRoles();
        $genericTimestamp = new DateTime();
        $genericTimestamp = $genericTimestamp->getTimeStamp();
        return new User(1, "Iván", "password", "iván@don-dedal.com", $roles[2], "918273849", "Iván", "Maldonado Fernández", $genericTimestamp, $genericTimestamp, true);
        //return null;
    }
    /**
    * Consulta en la base de datos y devuelve todos los usuarios comprendidos en un rango.
    * @param int $roleFilter                Especifica que usuarios mostrar por rol
    * @param int $estateFilter              Especifica el estado del usuario
    * @param int $orderByFilter             Especifica el tipo de ordenacion de usuarios
    * @param int $orderDirectionFilter      Especifica la direccion de ordenacion
    * @param int $page                      Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage              Especifica la cantidad de usuarios que apareceran por página.
    *
    * @return User[]                        Array de usuarios
    */
    public function getUsers($roleFilter, $stateFilter, $orderByFilter, $orderDirectionFilter, $page = 1, $itemsPerPage = 20){
        $page = $page - 1;
        $genericTimestamp = new DateTime();
        $genericTimestamp = $genericTimestamp->getTimeStamp();
        $users = array(
            new User(1, "Iván", "password", "iván@don-dedal.com", new Role(2, "Administrador", "admin", "El usuario puede generar y modificar órdenes, y registrar y modificar usuarios de cualquier rol."), "918273849", "Iván", "Maldonado Fernández", $genericTimestamp, $genericTimestamp, true),
            new User(2, "Sergio", "password", "gmail@sergio.com", new Role(1, "Empleado", "employee", "El usuario puede generar y modificar órdenes, como registrar y modificar clientes."), "902202122", "Sergio", "Barragán Llorente", $genericTimestamp, $genericTimestamp, false),
            new User(3, "Jhoseph", "password", "un@correo.com", new Role(0, "Cliente", "client", "El usuario puede ver sus órdenes y editar su perfil."), "689412369", "Jhoseph", "Andre García Segovia", $genericTimestamp, $genericTimestamp, true)
        );
        return $users;
        //TO DO
    }
    /**
    * Consulta en la base de datos y devuelve el total de usuarios que coincida con los filtros.
    * @param int $roleFilter                Especifica que usuarios mostrar por rol
    * @param int $estateFilter              Especifica el estado del usuario
    *
    * @return int                           Numero total de usuarios segun filtros
    */
    public function getTotalUsers($roleFilter = -1, $estateFilter = -1){
        return 1000;
    }
    /**
    * Consulta en la base de datos si el nombre de usuario esta disponible
    *
    * @param String $username       Nombre de usuario
    *
    * @return boolean               Devuelve true si esta disponible, false si esta registrado
    */
    public function checkUsername($username){
        $result = rand(0,1);
        if($result == 0) {
            return false;
        }
        return true;
    }
    
    /**
    * Consulta en la base de datos si el correo electronico esta disponible
    *
    * @param String $email          Nombre de usuario
    *
    * @return boolean               Devuelve true si esta disponible, false si esta registrado
    */
    public function checkEmail($email){
        $result = rand(0,1);
        if($result == 0) {
            return false;
        }
        return true;
    }
    /**
    * Consulta en la base de datos y devuelve un array de usuarios
    *
    * @return Role[] Roles       Array de roles de usuario
    */
    public function getRoles(){
        $roles = array(
            new Role("0", "Client", "client", "El usuario puede ver sus órdenes y editar su perfil."),
            new Role("1", "Empleado", "employee", "El usuario puede generar y modificar órdenes, como registrar y modificar clientes."),
            new Role("2", "Administrador", "admin", "El usuario puede generar y modificar órdenes, y registrar y modificar usuarios de cualquier rol.")
        );
        return $roles;
    }
    /**
    * Registra un usuario en la base de datos desde el panel de control
    * @param String $username Nombre de usuario
    * @param String $password Contraseña del usuario (Se debe crear el Hash de la contraseña)
    * @param String $email El email del usuario
    * @param String $name El nombre del usuario
    * @param String $surname El apellido del usuario
    * @param String $phone El telefono del usuario
    * @param int $role El ID del Rol del usuario
    * @param int $active Si el usuario esta activado
    *
    * @return int 0 Si todo ha ido bien
    * @return int 1 Si el nombre de usuario tiene menos de 4 caracteres
    * @return int 2 si el nombre de usuario ya esta registrado
    * @return int 3 si la contraseña tiene menos de 6 caracteres
    * @return int 4 si el correo no es valido
    * @return int 5 si el correo ya esta registrado
    * @return int 6 si falta el nombre
    * @return int -1 si algo ha fallado
    */
    public function registerUserAdminPanel($userName, $password, $email, $name, $surname = "", $phone = "", $role = 0, $active = 0){
        return -1;
    }  
}
//Ajax Get Username
if(isset($_GET["check_username"])){
    $uc = new UserController();
    if($uc->checkUsername($_GET["check_username"])){
        echo "DISPONIBLE";
    }else {
        echo "NO DISPONIBLE";
    }
}
//Ajax Get Email
if(isset($_GET["check_email"])){
    $uc = new UserController();
    if($uc->checkUsername($_GET["check_email"])){
        echo "DISPONIBLE";
    }else {
        echo "NO DISPONIBLE";
    }
}
/*$test = new UserController();
echo "<pre>";
var_dump($test->getUser(0));
echo "</pre>";*/