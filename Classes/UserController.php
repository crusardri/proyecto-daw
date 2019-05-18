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
        return new User(1, "Iván", "password", "iván@don-dedal.com", new Role(1, "Empleado", "employee"), "918273849", "Iván", "Maldonado Fernández", new DateTime(), new DateTime(), true);
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
    public function getUsers($roleFilter, $estateFilter, $orderByFilter, $orderDirectionFilter, $page = 1, $itemsPerPage = 10){
        $page = $page - 1;
        $users = array(
            new User(1, "Iván", "password", "iván@don-dedal.com", new Role(2, "Administrador", "admin"), "918273849", "Iván", "Maldonado Fernández", new DateTime(), new DateTime(), true),
            new User(2, "Sergio", "password", "gmail@sergio.com", new Role(1, "Empleado", "employee"), "902202122", "Sergio", "Barragán Llorente", new DateTime(), new DateTime(), false),
            new User(3, "Jhoseph", "password", "un@correo.com", new Role(0, "Cliente", "client"), "689412369", "Jhoseph", "Andre García Segovia", new DateTime(), new DateTime(), true)
        );
        return $users;
        //TO DO
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
    public function getTotalUsers($roleFilter, $estateFilter){
        
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
            new Role("0", "Client", "client"),
            new Role("1", "Empleado", "employee"),
            new Role("2", "Administrador", "admin")
        );
        return $roles;
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