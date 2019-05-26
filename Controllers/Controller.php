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
    * @param int orderId                ID de la orden
    *
    * @return Order                     si la ha encontrado
    * @return null                      si no existe
    */
    public function getOrder($orderID){
        return null;
    }
    /**
    * Devuelve un array de objetos de OrderItems
    * @param int                        orderId ID de la orden
    *
    * @return null                      si no existe
    * @return Order[]                   Array de ordenes
    */
    private function getOrderItems($orderID){
        return null;       
    }
    /**
    * Devuelve todas las ordenes limitado por pagina
    * @param String $searchString       Cadena de texto a buscar
    * @param int $showEstate            ID del estado de la orden que se mostrarán
    * @param int $orderBy               Tipo de ordenacion por clolumna
    * @param int $page                  Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage          Especifica la cantidad de usuarios por pagina
    *
    * @return Order[] Array de ordenes
    */
    public function getOrders($searchString, $showEstate, $orderBy, $orderDirection, $page = 1, $itemsPerPage = 10){
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
     * Consulta en la base de datos y devuelve una prenda
     * @param int $clotheID                 ID de la prenda a consultar
     * 
     * @return Clothe                       Objeto de la clase Clothe
     * @return null                         Si no ha encontrado la prenda
     */
    public function getClothe($clotheID){
        $timestamp = time();
        return new Clothe(1, "Vaquero", Controller::getNumFixes(1), Controller::getFixes(1), $timestamp, $timestamp, true);
    }
    /**
     * Consulta en la base de datos y trae información de las prendas segun filtros y página
     * @param String $searchString          Cádena a buscar
     * @param int $stateFilter              Filtro de estado
     * @param int $orderByFilter            Filtro Ordenar por
     * @param int $orderDirectionFilter     Filtro direccion de ordenación
     * @param int $page                     Página a consultar
     * @param int $itemsPerPage             Cantidad de prendas a mostrar por página
     * 
     * @return Clothe[]                     Array de Prendas
     */
    public function getClothes($searchString, $stateFilter, $orderByFilter, $orderDirectionFilter, $page, $itemsPerPage = 20){
        $page = $page -1;
        $timestamp = time();
        $clothes = [
            new Clothe(1, "Vaquero", $this->getNumFixes(1), $this->getFixes(1), $timestamp, $timestamp, true),
            new Clothe(2, "Blusa", $this->getNumFixes(2), $this->getFixes(2), $timestamp, $timestamp, true),
            new Clothe(3, "Camisa", $this->getNumFixes(3), $this->getFixes(3), $timestamp, $timestamp, false),
            new Clothe(4, "Mercedes Benz", $this->getNumFixes(4), $this->getFixes(4), $timestamp, $timestamp, true)
        ];
        return $clothes;
    }
    /**
     * Consulta en la base de datos y trae el número total de prendas segun filtros.
     * @param String $searchString          Cádena a buscar
     * @param int $stateFilter              Filtro de estado
     * @param int $orderByFilter            Filtro Ordenar por
     * @param int $orderDirectionFilter     Filtro direccion de ordenación
     * 
     * @return int                          Número de prendas segun filtros
     */
    public static function getTotalClothes($searchString = "", $stateFilter = -1){
        return 1000;
    }
    /**
     * Consulta en la base de datos y devuelve toda la informacion sobre los arreglos de una prenda
     * @param int $clotheId             ID de la prenda a consultar
     * 
     * @return Fix[]                    Array de prendas
     */
    private function getFixes($clotheID){
        $timestamp = time();
        $fixes = [
            new Fix(1, 1, "Bajo", 10.5, $timestamp, $timestamp, true),
            new Fix(2, 1, "Ensanchar", 12.5, $timestamp, $timestamp, true),
            new Fix(3, 1, "Bragueta", 8.5, $timestamp, $timestamp, false),
            new Fix(4, 1, "Bolsillo", 10.5, $timestamp, $timestamp, true)
        ];
        return $fixes;
    }
    /**
     * Consulta en la base de datos y devuelve toda la informacion sobre los arreglos de una prenda
     * @param int $clotheId             ID de la prenda a consultar
     * 
     * @return int                      Número de prendas encontradas
     */
    private function getNumFixes($clotheId){
        return 4;
    }
}