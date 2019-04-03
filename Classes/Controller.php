<?php
require("IConnectable.php");
class Controller implements IConnectable {
    /**
    * Devuelve una conexion a la Base de datos
    * @return PDO Conexion a la base de datos completa.
    */
    private static function connect(){
        return new PDO("sqlite:.data/games.db");
    }
    /**
    * Devuelve una unica orden
    * @param int orderId ID de la orden
    *
    * @return Order si la ha encontrado
    * @return null si no existe
    */
    public static function getOrder($orderID){
        //TO DO
    }
    /**
    * Devuelve todas las ordenes limitado por pagina
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrders($page = 1, $itemsPerPage = 10){
        $page = $page -1;
        //TO DO
        
    }
    /**
    * Devuelve todas las ordenes que coincida parte de la descripcion
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @param String $description Descripcion a buscar
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrdersByDescription($page = 1, $itemsPerPage = 10, $description){
        $page = $page -1;
        //TO DO
        
    }
    /**
    * Devuelve todas las ordenes que coincida con parte del nombre de un cliente
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @param String $clientName Nombre del cliente
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrdersByClientName($page = 1, $itemsPerPage = 10, $clientName){
        $page = $page -1;
        //TO DO
        
    }
    /**
    * Devuelve todas las ordenes de un cliente
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @param int $clientId El ID de usuario del cliente
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrdersByClientId($page = 1, $itemsPerPage = 10, $clientId){
        $page = $page -1;
        //TO DO
        
    }
    /**
    * Devuelve todas las ordenes en un estado concreto
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @param int $estate Estado de la orden
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrdersByEstate($page = 1, $itemsPerPage = 10, $estate){
        $page = $page -1;
        //TO DO
        
    }
    /**
    * Devuelve todas las ordenes de un trabajador
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @param int $workerId ID del trabajador
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrdersByAssignedWorkerId($page = 1, $itemsPerPage = 10, $workerId){
        $page = $page -1;
        //TO DO
        
    }
    /**
    * Devuelve todas las ordenes que coincida con el nombre de un trabajador
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    * @param String $workerName
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrdersByAssignedWorkerName($page = 1, $itemsPerPage = 10, $workerName){
        $page = $page -1;
        //TO DO
        
    }
    /**
    * Devuelve una prenda
    * @param int $prendaId ID de la prenda
    *
    * @return Prenda 
    */
    public static function getPrenda($prendaId){
        //TO DO
        
    }
    /**
    * Devuelve todas las prendas limitadas por pagina
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de usuarios por pagina
    *
    * @return Prenda[]  
    */
    public static function getPrendas($page = 1, $itemsPerPage = 10){
        $page = $page -1;
        //TO DO
    }
    /**
    * Devuelve todas las prendas que coincidan con un nombre
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de arreglos por pagina
    * @param String $prendaName Nombre de la prenda a buscar
    *
    * @return Prenda[]  
    */
    public static function getPrendasByName($page = 1, $itemsPerPage = 10, $prendaName){
        $page = $page -1;
        //TO DO
    }
    /**
    * Devuelve un arreglo por ID
    * 
    * @return Arreglo
    */
    public static function getArreglo($arregloId){
        //TO DO
    }
    /**
    * Devuelve todos los arreglos de una prenda por ID
    * @param int $page Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage Especifica la cantidad de arreglos por pagina
    * @param int $prendaId ID de una prenda
    *
    * @return Arreglos[]  
    */
    public static function getArreglosByPrendaId($page = 1, $itemsPerPage = 10, $prendaId){
        $page = $page -1;
        //TO DO
    }
    /**
    * Registra una nueva orden
    * @param Order $order La orden 
    *
    * @return int 0 Si todo ha ido bien
    * @return int -1 Si algo ha fallado
    */
    public static function createOrder($order){
        //TO DO
    }
    /**
    * Edita una orden
    * @param Order $order La orden 
    *
    * @return int 0 Si todo ha ido bien
    * @return int -1 Si algo ha fallado
    */
    public static function editOrder($order){
        //TO DO
    }
}