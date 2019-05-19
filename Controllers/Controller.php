<?php
require("IConnectable.php");
class Controller {
    /**
    * Devuelve una conexion a la Base de datos
    * @return PDO Conexion a la base de datos completa.
    */
    private function connect(){
        return new PDO("sqlite:.data/data.db");
    }
    /**
    * Devuelve una unica orden
    * @param int orderId ID de la orden
    *
    * @return Order si la ha encontrado
    * @return null si no existe
    */
    public static function getOrder($orderID){
        return null;
    }
    /**
    * Devuelve un array de objetos de OrderItems
    * @param int orderId ID de la orden
    *
    * @return null si no existe
    * @return Order[] Array de ordenes
    */
    private static function getOrderItems($orderID){
        return null;       
    }
    /**
    * Devuelve todas las ordenes limitado por pagina
    * @param String $searchString   Cadena de texto a buscar
    * @param int $showEstate        ID del estado de la orden que se mostrarán
    * @param int $orderBy           Tipo de ordenacion por clolumna
    * @param int $page              Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage      Especifica la cantidad de usuarios por pagina
    *
    * @return Order[] Array de ordenes
    */
    public static function getOrders($searchString, $showEstate, $orderBy, $orderDirection, $page = 1, $itemsPerPage = 10){
        //Columna a filtrar
        switch ($orderBy) {
            case 0:
                $orderByCollumn = "ORDER_ID";
                break;
            case 1:
                $orderByCollumn = "IN_TIMESTAMP";
                break;
            case 2:
                $orderByCollumn = "START_TIMESTAMP";
                break;
            case 3:
                $orderByCollumn = "END_TIMESTAMP";
                break;
            case 4:
                $orderByCollumn = "OUT_TIMESTAMP";
                break;
            case 5:
                $orderByCollumn = "CANCEL_TIMESTAMP";
                break;
            case 6:
                $orderByCollumn = "UPDATE_TIMESTAMP";
                break;
            case 7:
                $orderByCollumn = "CLIENT.NAME";
                break;
            case 8:
                $orderByCollumn = "EMPLOYEE.NAME";
                break;
            case 9:
                $orderByCollumn = "PRICE";
                break;
            case 10:
                $orderByCollumn = "NUM_PRENDAS";
                break;
        }
        //Orden del filtrado
        switch ($orderDirection){
            case 0: 
                $orderDirection = "ASC";
                break;
            case 1:
                $orderDirection = "DESC";
                break;
        }
        //TO DO
        return array();
    }


    /**
    * Devuelve una prenda
    * @param int $prendaId ID de la prenda
    *
    * @return Prenda 
    */
    public static function getPrenda($prendaId){
        return null;
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
        return null;
        //TO DO
    }
    /**
    * Devuelve un arreglo por ID
    * 
    * @return Arreglo
    */
    public static function getArreglo($arregloId){
        return null;
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
        return 0;
    }
    /**
    * Registra una nueva orden
    * @param Order $order La orden 
    *
    * @return int 0 Si todo ha ido bien
    * @return int -1 Si algo ha fallado
    */
    public static function createOrder($order){
        return 0;
    }
    /**
    * Edita una orden
    * @param Order $order La orden 
    *
    * @return int 0 Si todo ha ido bien
    * @return int -1 Si algo ha fallado
    */
    public static function editOrder($order){
       return 0;
    }
}