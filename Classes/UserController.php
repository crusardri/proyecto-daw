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
        return null;
    }
    /**
    * Consulta en la base de datos y devuelve todos los usuarios comprendidos en un rango.
    * @param int $role              Especifica que usuarios mostrar por rol
    * @param int
    * @param int $page              Especifica la pagina que se va a visualizar
    *
    * @param int $itemsPerPage      Especifica la cantidad de usuarios por pagina
    * @return User[]                Array de usuarios
    */
    public function getUsers($page = 1, $itemsPerPage = 10){
        $page = $page - 1;
        //TO DO
    }
    /**
    * Consulta en la base de datos y devuelve todos los usuarios comprendidos en un rango.
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @param String $name Especifica la cantidad de usuarios por pagina
    * @return User[] Array de usuarios
    */
    public function getUsersByName($page = 1, $itemsPerPage = 10, $name){
        $db = $this::connect();
        $page = $page - 1;
        //TO DO
    }
    /**
    * Consulta en la base de datos si el nombre de usuario esta disponible
    *
    * @param String $username   Nombre de usuario
    *
    * @return boolean           Devuelve true si esta disponible, false si esta registrado
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
    * @param String $email      Nombre de usuario
    *
    * @return boolean           Devuelve true si esta disponible, false si esta registrado
    */
    public function checkEmail($email){
        $result = rand(0,1);
        if($result == 0) {
            return false;
        }
        return true;
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