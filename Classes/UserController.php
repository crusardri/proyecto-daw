<?php
require("IConnectable.php");
class UserController implements IConnectable {
    function __construct($User){
        
    }
    /**
    * Devuelve una conexion a la Base de datos
    * @return PDO Conexion a la base de datos completa.
    */
    private static function connect(){
        return new PDO("sqlite:.data/games.db");
    }
    /**
    * Consulta en la base de datos un usuario por ID y devuelve un objeto de clase Usuario
    * @Return User Un usuario completo
    */
    public function getUser($id){
        $db = $this->connect();
        $sql = "SELECT * FROM Users WHERE USER_ID = :userID";
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(':userID', $id);
        if($stmt->execute()){
            if($row = $stmt->fetch()){
               $user = new User();

               return $user;
            }
        } else {
            return null;
        }
    }
    /**
    * Consulta en la base de datos y devuelve todos los usuarios comprendidos en un rango.
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @return User[] Array de usuarios
    */
    public function getUsers($page = 1, $itemsPerPage = 10){
        $users = array();
        $page = $page -1;
        $db = $this->connect();
        $sql = "SELECT * FROM USERS LIMIT :startFromItem, :itemsPerPage";
        $stmt = $db->prepare($sql);

        $startFromItem = $page * $itemsPerPage;
        $stmt->bind_param(":startFromItem", $startFromItem);
        $stmt->bind_param(":itemsPerPage", $itemsPerPage);
        
        if($stmt->execute()){
            if($row = $stmt->fetch()){
                while($row = $stmt->fetch()){
                    $u = new User ();
                    array_push($users, $u);

                    return $users;
                }
            }
        } else {
            return null; 
        }
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
}