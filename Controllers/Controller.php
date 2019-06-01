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
        return new Order(
            1
            ,new User(1, "Usuario", null, "email",new Role(0, "Cliente", "client"),91478563,"Halfonso1","Pelayo1",time(),time(),1)
            ,new User(2, "Usuario1", null, "email",new Role(0, "Empleado", "employee"),91486325,"Halfonso","Pelayo",time(),time(),1)
            ,new Estate(1, "En proceso", "working", "La órden está realizandose.")
            ,time()
            ,time()
            ,null
            ,null
            ,null
            ,10
            ,"Observaciones"
            ,time()
        );
    }
    /**
     * Crea una orden de servicio
     * @param int clientID                          ID del cliente
     * @param int employeeID                        ID del trabajador asignado
     * @param int stateID                           ID del estado de la órden
     * @param OrderItems[] $orderItems              Array de OrderItems
     * @param String Description                    Descripción asociada a la órden
     * 
     * @return int 0                                Orden registrada con éxito
     * @return int 1                                No se encuentra al cliente
     * @return int 2                                No se encuentra al empleado
     * @return int 3                                El estado de la órden no existe
     * @return int 4                                Debe tener al menos 1 order-item
     * @return int -1                               Se ha producido un error al intentar registrar la órden
     */
    public function createOrder(){
        return -1;
    }
    /**
     * Edita una órden de servicio
     * @param int $orderID                          ID de la órden a editar
     * @param int $stateID                          Nuevo estado de la órden
     * @param String $description                   Descripción de la órden
     * 
     * @return int 0                                órden modificada con éxito
     * @return int 1                                No se encuentra la órden
     * @return int 2                                El estado de la órden no existe
     * @return int -1                               Se ha producido un error al intentar editar la órden.
     */

    public function editOrder(){
        return -1;
    }
    /**
    * Devuelve un array de objetos de OrderItems
    * @param int $orderID               ID de la orden
    *
    * @return null                      si no existe
    * @return Order[]                   Array de ordenes
    */
    public function getOrderItems($orderID){
        $orderItems = [
            new OrderItem(1, 
                new Clothe(1, "Váquero", 10, null, time(), time(), 1),
                new Fix(1, 1, "Bajo", 10, time(), time(), 1),
                10.5,
                "Sin descripción"
        ),
        new OrderItem(2, 
                new Clothe(2, "Blusa", 5, null, time(), time(), 1),
                new Fix(4, 1, "Descosido", 10, time(), time(), 1),
                12,
                "Sin descripción"
        ),
        new OrderItem(3, 
                new Clothe(3, "Opel Corsa", 10, null, time(), time(), 1),
                new Fix(2, 1, "Cambio búgias", 10, time(), time(), 1),
                153.99,
                "¿Y por qué no?"
            )
        ];
        return $orderItems;       
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
        //return array();
        return array(
            new Order(
                1
                ,new User(1, "Usuario", null, "email",new Role(0, "Cliente", "client"),91478563,"Halfonso1","Pelayo1",time(),time(),1)
                ,new User(2, "Usuario1", null, "email",new Role(0, "Empleado", "employee"),91486325,"Halfonso","Pelayo",time(),time(),1)
                ,new Estate(0, "Pendiente", "pending", "La órden ha sido recibida y está en espera.")
                ,time()
                ,null
                ,null
                ,null
                ,null
                ,5
                ,"Observaciones"
                ,time()
            ),
            new Order(
                2
                ,new User(1, "Usuario", null, "email",new Role(0, "Cliente", "client"),91478563,"Halfonso1","Pelayo1",time(),time(),1)
                ,new User(2, "Usuario1", null, "email",new Role(0, "Empleado", "employee"),91486325,"Halfonso","Pelayo",time(),time(),1)
                ,new Estate(0, "En proceso", "working", "La órden ha sido recibida y está en espera.")
                ,time()
                ,time()
                ,null
                ,null
                ,null
                ,2
                ,"Observaciones"
                ,time()
            ),
            new Order(
                3
                ,new User(1, "Usuario", null, "email",new Role(0, "Cliente", "client"),91478563,"Halfonso1","Pelayo1",time(),time(),1)
                ,new User(2, "Usuario1", null, "email",new Role(0, "Empleado", "employee"),91486325,"Halfonso","Pelayo",time(),time(),1)
                ,new Estate(0, "Finalizado", "finished", "La órden ha sido recibida y está en espera.")
                ,time()
                ,time()
                ,time()
                ,null
                ,null
                ,24
                ,"Observaciones"
                ,time()
            ),
            new Order(
                4
                ,new User(1, "Usuario", null, "email",new Role(0, "Cliente", "client"),91478563,"Halfonso1","Pelayo1",time(),time(),1)
                ,new User(2, "Usuario1", null, "email",new Role(0, "Empleado", "employee"),91486325,"Halfonso","Pelayo",time(),time(),1)
                ,new Estate(0, "Recogido", "out", "La órden ha sido recibida y está en espera.")
                ,time()
                ,time()
                ,time()
                ,time()
                ,time()
                ,85
                ,"Observaciones"
                ,time()
            ),
            new Order(
                5
                ,new User(1, "Usuario", null, "email",new Role(0, "Cliente", "client"),91478563,"Halfonso1","Pelayo1",time(),time(),1)
                ,new User(2, "Usuario1", null, "email",new Role(0, "Empleado", "employee"),91486325,"Halfonso","Pelayo",time(),time(),1)
                ,new Estate(0, "Cancelado", "canceled", "La órden ha sido recibida y está en espera.")
                ,time()
                ,null
                ,null
                ,null
                ,time()
                ,10
                ,"Observaciones"
                ,time()
            )
        );
    }
    /**
    * Registra una nueva prenda en la base de datos
    * @param String $clotheName         Nombre de la prenda
    *
    * @return 0                         Prenda registrada con éxito
    * @return 1                         Nombre no declarado
    * @return -1                        Error desconocido
    */
    public function addClothe($clotheName){
        if(empty($clotheName)){
            return 1;
        } else {
            $db = $this->connect(); 
            $sql = "INSERT INTO CLOTHES (CLOTHE_NAME, ACTIVE, REGISTERED_DATE, UPDATE_DATE) VALUES (:clotheName, 0, :registeredDate, :updateDate)";
            $stmt = $db->prepare($sql);

            $registerDateTimestamp = time();
        
            $stmt->bindParam(':clotheName', $clotheName);
            $stmt->bindParam(":registeredDate",$registerDateTimestamp );
            $stmt->bindParam(":updateDate", $registerDateTimestamp);
            
            if($stmt->execute()){
                return 0;
            }
        }
        return -1;
    }
    /**
     * Registra un nuevo arreglo para la prenda especificada
     * @param int $clotheID             ID de la prenda a añadir el arreglo
     * @param int $fixName              Nombre del arreglo
     * @param int $fixPrice             Precio recomendado del arreglo
     * @param int $active               0 Areglo deshabilitado, 1 arreglo hablitado
     * 
     * @return int 0                    Arreglo regitrado con exito
     * @return int 1                    ID de la prenda no especificado
     * @return int 2                    Falta el nombre del arreglo
     * @return int 3                    Falta el precio recomendado del arreglo
     * @return int -1                   Error desconocido
     */
    public function addFix($clotheID, $fixName, $fixPrice, $active){
        var_dump($active);
        if(empty($clotheID)){
            return 1;
        } elseif(empty($fixName)){
            return 2;
        } elseif(empty($fixPrice)){
            return 3;
        } else{
            $db = $this->connect(); 
            
            $sql = "INSERT INTO CLOTHES_FIXES (
                FIX_ID, 
                CLOTHE_ID, 
                NAME,
                PRICE, 
                ACTIVE, 
                CREATION_DATE,
                UPDATE_DATE
            )
            VALUES (
                (SELECT MAX(FIX_ID) + 1 AS MAX_FIX_ID FROM CLOTHES_FIXES WHERE CLOTHE_ID = :clotheID), 
                :clotheID, 
                :fixName, 
                :fixPrice, 
                :active, 
                :creationDate, 
                :updateDate
            )";

            
            $stmt = $db->prepare($sql);

            $timestamp = time();
            $stmt->bindParam(":clotheID", $clotheID);
            $stmt->bindParam(":fixName", $fixName);
            $stmt->bindParam(":fixPrice", $fixPrice);
            $stmt->bindParam(":active", $active);
            $stmt->bindParam(":creationDate", $timestamp);
            $stmt->bindParam(":updateDate", $timestamp);

            if($stmt->execute()){
                return 0;
            }
        }
        return -1;
    }
    /**
     * Edita un arreglo para la prenda especificada
     * @param int $clotheID             ID de la prenda a editar
     * @param int $fixName              Nombre del arreglo
     * @param int $fixPrice             Precio recomendado del arreglo
     * 
     * @return int 0                    Arreglo regitrado con exito
     * @return int 1                    ID de la prenda no especificado
     * @return int 2                    Falta el nombre del arreglo
     * @return int 3                    Falta el precio recomendado del arreglo
     * @return int -1                   Error desconocido
     */
    public function editFix($fixID, $fixName, $fixPrice){
        if(empty($fixID)){
            return 1;
        } elseif(empty($fixName)){
            return 2;
        } elseif(empty($fixPrice)){
            return 3;
        } else{
            $db = $this->connect(); 
            $sql = "UPDATE CLOTHES_FIXES SET NAME = :fixName, PRICE = :fixPrice, UPDATE_DATE = :updateDate WHERE FIX_ID = :fixID";
            $stmt = $db->prepare($sql);

            $timestamp = time();

            $stmt->bindParam(":fixID", $fixID);
            $stmt->bindParam(":fixName", $fixName);
            $stmt->bindParam(":fixPrice", $fixPrice);
            $stmt->bindParam(":updateDate", $timestamp);
            
            if($stmt->execute()){
                return 0;
            }
        }
        return -1;
    }
    /**
     * Activa o desactiva un arreglo arreglo para la prenda especificada
     * @param int $fixName              Nombre del arreglo
     * @param int $fixPrice             Precio recomendado del arreglo
     * 
     * @return int 0                    Arreglo modificado con exito
     * @return int 1                    ID de la del arreglo no especificado
     * @return int -1                   Error desconocido
     */
    public function toggleFix($fixID, $active){
        return -1;
    }
    

    /**
     * Consulta en la base de datos y devuelve una prenda
     * @param int $clotheID                 ID de la prenda a consultar
     * 
     * @return Clothe                       Objeto de la clase Clothe
     * @return null                         Si no ha encontrado la prenda
     */
    public function getClothe($clotheID){
        $db = $this->connect();
        $sql = "SELECT * FROM CLOTHES WHERE CLOTHES_ID = :clotheID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':clotheID', $clotheID);
        if($stmt->execute()){
            while($row = $stmt->fetch()){
                return new Clothe(
                    $row["CLOTHES_ID"],
                    $row["CLOTHE_NAME"],
                    null, null,
                    $row["REGISTERED_DATE"],
                    $row["UPDATE_DATE"],
                    $row["ACTIVE"]
                );
            }
        }
        return null;
    }
    /**
     * Cambia el nombre de una prenda
     * @param int $clotheID                 ID de la prenda a consultar
     * @param int $clotheName               Nombre de la prenda
     * 
     * @return int 0                        Nombre cambiado correctamente
     * @return int 1                        No se ha declarado el nombre
     * @return int -1                       Se ha producido un error
     */
    public function changeClotheName($clotheID, $clotheName){
        if(empty($clotheName)){
            return 1;
        } else {
            $db = $this->connect(); 
            $sql = "UPDATE CLOTHES SET CLOTHE_NAME = :clotheName, UPDATE_DATE = :updateDate WHERE CLOTHES_ID = :clotheID";
            $stmt = $db->prepare($sql);
            $timestamp = time();

            $stmt->bindParam(':clotheID', $clotheID);
            $stmt->bindParam(':clotheName', $clotheName);
            $stmt->bindParam(':updateDate', $timestamp);
        
            if($stmt->execute()){
                return 0;
            }
            if($stmt->rowCount() > 0){
                return 0;
            } else {
                return -1;
            }
        }
        return -1;
    }
    /**
     * Activa o desactiva una prenda
     * @param int $clotheID                 ID de la prenda a consultar
     * @param int $active                   0 Desactivado, 1 Activado
     * 
     * @return int 0                        Nombre cambiado correctamente
     * @return int -1                       Se ha producido un error
     */
    public function toggleClothe($clotheID, $active){
        if(empty($clotheID)){
            return 1;
        } else {
            $db = $this->connect(); 
            $sql = "UPDATE CLOTHES SET ACTIVE = :active, UPDATE_DATE = :updateDate WHERE CLOTHES_ID = :clotheID";
            $stmt = $db->prepare($sql);
            $dateTimestamp = time();

            $stmt->bindParam(':clotheID', $clotheID);
            $stmt->bindParam(':active', $active);
            $stmt->bindParam(':updateDate', $dateTimestamp);
        
            if($stmt->execute()){
                return 0;
            }
        }
        return -1;
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
            new Clothe(1, "Vaquero", 10, null, $timestamp, $timestamp, true),
            new Clothe(2, "Blusa", 10, null, $timestamp, $timestamp, true),
            new Clothe(3, "Camisa", 10, null, $timestamp, $timestamp, false),
            new Clothe(4, "Mercedes Benz", 10, null, $timestamp, $timestamp, true)
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
    public function getFixes($clotheID){
        $fixes = array();
        $db = $this->connect(); 
        $sql = "SELECT * FROM CLOTHES_FIXES WHERE CLOTHE_ID = :clotheID";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':clotheID', $clotheID);

        if($stmt->execute()){
            while($row = $stmt->fetch()){
                array_push($fixes, new Fix(
                    $row["FIX_ID"], 
                    $row["CLOTHE_ID"],
                    $row["NAME"],
                    $row["PRICE"],
                    $row["CREATION_DATE"],
                    $row["UPDATE_DATE"],
                    $row["ACTIVE"]
                ));
            }
        }
        return $fixes;
    }
    /**
     * Consulta en la base de datos y devuelve un unico arreglo
     * @param int $clotheId             ID de la prenda a consultar
     * @param int $fixID                ID del arreglo a consultar
     * 
     * @return Fix                      Array de prendas
     */
    public function getFix($clotheID, $fixID){
        $fixes = array();
        $db = $this->connect(); 
        $sql = "SELECT * FROM CLOTHES_FIXES WHERE CLOTHE_ID = :clotheID AND FIX_ID = :fixID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':clotheID', $clotheID);
        $stmt->bindParam(':fixID', $fixID);
        if($stmt->execute()){
            while($row = $stmt->fetch()){
                array_push($fixes, new Fix(
                    $row["FIX_ID"], 
                    $row["CLOTHE_ID"],
                    $row["NAME"],
                    $row["PRICE"],
                    $row["ACTIVE"],
                    $row["CREATION_DATE"],
                    $row["UPDATE_DATE"]
                ));
            }
        }
        return $fixes;
    }
    /**
     * Obtiene los estados de una orden desde la base de datos
     * 
     * @return Estate[]                 Estados de la orden disponibles
     */
    public function getStates(){
        $states = [
            new Estate(1, "Pendiente", "pending", "La órden ha sido recibida y está en espera."),
            new Estate(2, "En proceso", "working", "La órden está realizandose."),
            new Estate(3, "Finalizado", "finished", "La órden ha sido terminada y está pendiente de recogida."),
            new Estate(4, "Entregado", "out", "La órden ha sido recogida."),
            new Estate(5, "Cancelado", "canceled", "La órden ha sido cancelada.")
        ];
        return $states;
    }
    /**
     * Obtiene los estados de una orden desde la base de datos
     * @param int $stateID              ID de un estado
     * 
     * @return Estate                   Estado de una orden
     */
    public function getState($stateID){
        // Pendiente de hacer
        //s
        switch($stateID){
            case 1:
                return new Estate(2, "En proceso", "working", "La órden está realizandose.");
            case 2:
                return new Estate(3, "Finalizado", "finished", "La órden ha sido terminada y está pendiente de recogida.");
            case 3:
                return new Estate(4, "Entregado", "out", "La órden ha sido recogida.");
            case 4:
                return new Estate(5, "Cancelado", "canceled", "La órden ha sido cancelada.");
            default:
                return new Estate(1, "Pendiente", "pending", "La órden ha sido recibida y está en espera.");
        }
    }
}
