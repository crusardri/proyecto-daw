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
        $db = Connection::connect();
        $sql = "SELECT * FROM orders WHERE order_id = :orderID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $stmt->execute();
        
        while($row = $stmt->fetch()){
            $order = new orders($row['START_TIMESTAMP'], $row['LIMIT_TIMESTAMP'], $row['END_TIMESTAMP'], $row['OUT_TIMESTAMP'], $row['OBSERVATIONS'], $row['UPDATE_TIMESTAMP']);
        }

        $orderItemsArray = getOrderItems($orderID);
        $order = new order($orderArray, $orderItemsArray);
        $stmt->close();
        $db->close();

        return $order;
    }
    private static function getOrderItems($orderID){
        $db = Connection::connect();
        $sql = "SELECT * FROM order_items WHERE order_item_id = :orderID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
        $stmt->execute();
        
        while($row = $stmt->fetch()){
          $orderItems = new order_Items($row['START_TIMESTAMP'], $row['LIMIT_TIMESTAMP'], $row['END_TIMESTAMP'], $row['OUT_TIMESTAMP'], $row['OBSERVATIONS'], $row['UPDATE_TIMESTAMP']);
        }
        $stmt->close();
        $db->close();

        return $orderItems;
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
        $db = Connection::connect();
        $sql = "SELECT * FROM clothes WHERE clothes_id = :clothesID";
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(':clothesID', $prendaID, PDO::PARAM_INT);
        $stmt->execute();
        
        while($row = $stmt->fetch()){
          $prenda = new Prenda($row['CLOTHE_NAME'], $row['ACTIVE']);
        }
        $stmt->close();
        $db->close();

        return $prenda;
        
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
        $db = Connection::connect();
        $sql = "SELECT * FROM clothes_fixes WHERE fix_id = :fix_id";
        $stmt = $db->stmt_init();
        $stmt->prepare($sql);
        $stmt->bindParam(':fix_id', $arregloId, PDO::PARAM_INT);
        
        while($row = $stmt->fetch()){
            $arreglo = new Clothes_Fixes($row['PRICE'], $row['ACTIVE']);
        }
        $stmt->close();
        $db->close();

        return $arreglo;
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
        $db = Connection::connect();
        $sql = "INSERT INTO orders (START_TIMESTAMP, LIMIT_TIMESTAMP, END_TIMESTAMP, OUT_TIMESTAMP, OBSERVATIONS, UPDATE_TIMESTAMP) VALUES (:order_id, :start_timestamp, :limit_timestamp, :end_timestamp, :observations, :update_timestamp) WHERE order_id = :orderID";
        $stmt = $db->prepare($sql);
 
        $stmt->bindParam(':order_id', $order, PDO::PARAM_INT);
        $stmt->bindParam(':start_timestamp', $order, PDO::PARAM_INT);
        $stmt->bindParam(':limit_timestamp', $order, PDO::PARAM_INT);
        $stmt->bindParam(':end_timestamp', $order, PDO::PARAM_INT);
        $stmt->bindParam(':out_timestamp', $order, PDO::PARAM_INT);
        $stmt->bindParam(':observations', $order, PDO::PARAM_STR);
        $stmt->bindParam(':update_timestamp', $order, PDO::PARAM_INT);
 
        $stmt->execute();
 
        if (!stmt()){
             return -1;
        } else {
             return 0;
        }
        $stmt->close();
        $db->close();
    }
    /**
    * Edita una orden
    * @param Order $order La orden 
    *
    * @return int 0 Si todo ha ido bien
    * @return int -1 Si algo ha fallado
    */
    public static function editOrder($order){
       $db = Connection::connect();
       $sql = "UPDATE orders (START_TIMESTAMP, LIMIT_TIMESTAMP, END_TIMESTAMP, OUT_TIMESTAMP, OBSERVATIONS, UPDATE_TIMESTAMP) (:order_id, :start_timestamp, :limit_timestamp, :end_timestamp, :observations, :update_timestamp) WHERE order_id = :orderID";
       $stmt = $db->prepare($sql);

       $stmt->bindParam(':order_id', $order, PDO::PARAM_INT);
       $stmt->bindParam(':start_timestamp', $order, PDO::PARAM_INT);
       $stmt->bindParam(':limit_timestamp', $order, PDO::PARAM_INT);
       $stmt->bindParam(':end_timestamp', $order, PDO::PARAM_INT);
       $stmt->bindParam(':out_timestamp', $order, PDO::PARAM_INT);
       $stmt->bindParam(':observations', $order, PDO::PARAM_STR);
       $stmt->bindParam(':update_timestamp', $order, PDO::PARAM_INT);
      
       $stmt->execute();

       if (!stmt()){
            return -1;
       } else {
            return 0
       }
       $stmt->close();
       $db->close();
    }
}