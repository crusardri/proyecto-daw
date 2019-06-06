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
            ,new User(2, "Usuario", null, "email",new Role(0, "Cliente", "client"),91478563,"Halfonso1","Pelayo1",time(),time(),1)
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
            ,"Sin notas"
            ,10.15
        );
    }
    /**
     * Crea una orden de servicio
     * @param int $clientID                         ID del cliente
     * @param int $employeeID                       ID del trabajador asignado
     * @param OrderItems[] $orderItems              Array de OrderItems
     * @param String $description                   Descripción asociada a la órden
     * @param String $notes                         Notas de la orden
     * 
     * @return int 0                                Orden registrada con exito
     * @return int 1                                No se encuentra al cliente
     * @return int 2                                No se encuentra al empleado
     * @return int 3                                Debe tener al menos 1 order-item
     * @return int -1                               Se ha producido un error al intentar registrar la órden
     */
    public function createOrder($clientID, $employeID, $orderItems, $description, $notes){
        if(strlen($clientID) < 1){
            return 1;
        } elseif(strlen($employeID) < 1){
            return 2;
        } elseif(sizeof($orderItems) < 1){
            return 3;
        } else{
            $db = $this->connect(); 
            $sql = "INSERT INTO ORDERS (CLIENT_ID, EMPLOYEE_ID, DESCRIPTION, NOTES, IN_TIMESTAMP, UPDATE_TIMESTAMP) 
                    VALUES (:clientID, :employeID, :description, :notes, :inTimestamp, :updateTimestamp)";
            $stmt = $db->prepare($sql);
            $timestamp = time();
            $stmt->bindParam(':clientID', $clientID);
            $stmt->bindParam(':employeID', $employeID);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':notes', $notes);
            $stmt->bindParam(':inTimestamp', $timestamp);
            $stmt->bindParam(':updateTimestamp', $timestamp);
            
            if(!$stmt->execute() && $stmt->rowCount() < 1){
                return -1;
            }
            
            $sql = "INSERT INTO ORDER_ITEMS(ORDER_ID, CLOTHE_ID, FIX_ID, ACTUAL_PRICE, DESCRIPTION) 
            VALUES( (SELECT MAX(ORDER_ID) FROM ORDERS), :clothe, :fix, :price, :description) ";
            $stmt = $db->prepare($sql); 
            
            foreach($orderItems as $oi){
                $clothe = $oi->getClothe();
                $fix = $oi->getFix();
                $fixId = $fix->getID();
                $clotheId = $clothe->getId();
                $price = $oi->getPrice() ;
                $description = $oi->getDescription();
                $stmt->bindParam(":clothe", $clotheId);
                $stmt->bindParam(":fix", $fixId);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':description', $description);

                if(!$stmt->execute() && $stmt->rowCount() < 1){
                    $db->exec("DELETE FROM ORDER_ITEMS WHERE ORDER_ID = MAX(ORDERS.ORDER_ID)");
                    $db->exec("DELETE FROM ORDERS WHERE ORDER_ID = MAX(ORDERS.ORDER_ID)");
                    return -1;
                }
            }
        }
        return 0;
    }
    /**
     * Devuelve el ID de la última orden
     * 
     * @return int                                  ID de la última orden
     */
    public function getLastOrderID(){
        return 1;
    }
    /**
     * Edita una órden de servicio
     * @param int $orderID                          ID de la órden a editar
     * @param int $stateID                          Nuevo estado de la órden
     * @param String $notes                         Notas de la orden
     * 
     * @return int 0                                órden modificada con éxito
     * @return int -1                               Se ha producido un error al intentar editar la órden.
     */

    public function editOrder($orderID, $stateID, $notes){
        if(empty($orderID)){
            return 1;
        } elseif (empty($stateID)) {
            return 2;
        } else {
            $db = $this->connect();
            $sql = "UPDATE ORDERS SET ESTATE_ID = :stateID, NOTES = :notes, UPDATE_TIMESTAMP = :updateDate WHERE ORDER_ID = :orderID";
        
            $stmt = $db->prepare($sql);
            $timestamp = time();

            $stmt->bindParam(':orderID', $orderID);
            $stmt->bindParam(':stateID', $stateID);
            $stmt->bindParam(':notes', $notes);
            $stmt->bindParam(':updateDate', $timestamp);

            if($stmt->execute() && $stmt->rowCount() > 0){
                return 0;
            }
        }
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
                ,"Sin notas"
                ,10.15
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
                ,"Sin notas"
                ,10.15
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
                ,"Sin notas"
                ,10.15
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
                ,"Sin notas"
                ,10.15
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
                ,"Sin notas"
                ,10.15
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
            
            if($stmt->execute() && $stmt->rowCount() > 0){
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

            if($stmt->execute() && $stmt->rowCount() > 0){
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
            
            if($stmt->execute() && $stmt->rowCount() > 0){
                return 0;
            }
        }
        return -1;
    }
    /**
     * Activa o desactiva un arreglo arreglo para la prenda especificada
     * @param int $clotheID             ID de la prenda
     * @param int $fixID                ID del arreglo
     * @param int $active               0 arreglo desactivado, 1 arreglo activado
     * 
     * @return int 0                    Arreglo activado/desactivado con exito
     * @return int 1                    ID de la prenda no especificado
     * @return int 2                    ID del arreglo no especifricado
     * @return int -1                   Error desconocido
     */
    public function toggleFix($clotheID, $fixID, $active){
        if(empty($clotheID)){
            return 1;
        } elseif(empty($fixID)){
            return 2;
        } else {
            $db = $this->connect(); 
            $sql = "UPDATE CLOTHES_FIXES SET ACTIVE = :active, UPDATE_DATE = :updateDate WHERE CLOTHE_ID = :clotheID AND FIX_ID = :fixID";
            $stmt = $db->prepare($sql);
            $dateTimestamp = time();

            $stmt->bindParam(':clotheID', $clotheID);
            $stmt->bindParam(':fixID', $fixID);
            $stmt->bindParam(':active', $active);
            $stmt->bindParam(':updateDate', $dateTimestamp);
         
            if($stmt->execute() && $stmt->rowCount() > 0){
                return 0;
            }
        }
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
        $sql = "SELECT * FROM CLOTHES WHERE CLOTHE_ID = :clotheID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':clotheID', $clotheID);
        if($stmt->execute()){
            while($row = $stmt->fetch()){
                return new Clothe(
                    $row["CLOTHE_ID"],
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
            $sql = "UPDATE CLOTHES SET CLOTHE_NAME = :clotheName, UPDATE_DATE = :updateDate WHERE CLOTHE_ID = :clotheID";
            $stmt = $db->prepare($sql);
            $timestamp = time();

            $stmt->bindParam(':clotheID', $clotheID);
            $stmt->bindParam(':clotheName', $clotheName);
            $stmt->bindParam(':updateDate', $timestamp);
        
            if($stmt->execute() && $stmt->rowCount() > 0){
                return 0;
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
            $sql = "UPDATE CLOTHES SET ACTIVE = :active, UPDATE_DATE = :updateDate WHERE CLOTHE_ID = :clotheID";
            $stmt = $db->prepare($sql);
            $dateTimestamp = time();

            $stmt->bindParam(':clotheID', $clotheID);
            $stmt->bindParam(':active', $active);
            $stmt->bindParam(':updateDate', $dateTimestamp);
        
            if($stmt->execute() && $stmt->rowCount() > 0){
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
        $searchString = "%$searchString%"; 
        $page = $page - 1;
        $startFromItem = $page * $itemsPerPage;
        $clothes = array();                      
        $db = $this->connect();                 
        $sql = "SELECT 
            C.CLOTHE_ID,
            C.CLOTHE_NAME,
            C.ACTIVE,
            C.REGISTERED_DATE,
            C.UPDATE_DATE,
            (SELECT COUNT(CF.FIX_ID) FROM CLOTHES_FIXES CF WHERE CF.CLOTHE_ID = C.CLOTHE_ID) AS FIXES FROM CLOTHES C WHERE true";
        if(!is_null($searchString) && strlen($searchString) > 2 ){
            $sql .= "
                 AND (
                    LOWER(C.CLOTHE_ID) LIKE LOWER(:searchString) OR 
                    LOWER(C.CLOTHE_NAME) LIKE LOWER(:searchString)
                 )";
        }
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $sql .= " AND C.ACTIVE = :active";
        }
        switch($orderByFilter){
            case 1:
                $orderBy = "CLOTHE_NAME";
                break;
            case 2:
                $orderBy = "FIXES";
                break;
            case 3: 
                $orderBy = "ACTIVE";
                break;
            case 4:
                $orderBy = "REGISTERED_DATE";
                break;
            case 5:
                $orderBy = "UPDATE_DATE";
                break;
            default:
                $orderBy = "CLOTHE_ID";
                break;
        }
        $sql .= " 
            ORDER BY 
                $orderBy ";

        switch ($orderDirectionFilter){
            case 1:
                $sql .= "DESC ";
                break;
            default: 
                $sql .= "ASC ";
                break;
        }
        $sql .= " 
            LIMIT 
                :page, 
                :maxItems";
        $stmt = $db->prepare($sql);
        if(!is_null($searchString) && strlen($searchString) > 2){
            $stmt->bindParam(':searchString', $searchString);
        }
  
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $stmt->bindParam(':active', $stateFilter);
        }
        $stmt->bindParam(":page", $startFromItem);
        $stmt->bindParam(":maxItems", $itemsPerPage);

        if($stmt->execute()){
            while($row = $stmt->fetch()){
                array_push($clothes, new Clothe(
                    $row["CLOTHE_ID"], 
                    $row["CLOTHE_NAME"],
                    $row["FIXES"], null,
                    $row["REGISTERED_DATE"],
                    $row["UPDATE_DATE"],
                    $row["ACTIVE"]
                ));
            }
        } 
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
    public function getTotalClothes($searchString = "", $stateFilter = -1){
        $searchString = "%$searchString%";
        $db = $this->connect();
        $sql = "SELECT COUNT(*) FROM CLOTHES WHERE true "; 

        if(!is_null($searchString) && strlen($searchString) > 2){
            $sql .= " 
                AND (
                    LOWER(CLOTHE_ID) LIKE LOWER(:searchString) OR 
                    LOWER(CLOTHE_NAME) LIKE LOWER(:searchString)
                )";
        }
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $sql .= " AND 
                ACTIVE = :active";
        }
        $stmt = $db->prepare($sql);

        if(!is_null($searchString) && strlen($searchString) > 2){
            $stmt->bindParam(':searchString', $searchString);
        }
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $stmt->bindParam(':active', $stateFilter);
        }
        if($stmt->execute()){
            if($row = $stmt->fetch()){
                return($row[0]);
            }
        }
        return 0;
    }
    /**
     * Consulta en la base de datos y devuelve toda la informacion sobre los arreglos de una prenda
     * @param int $clotheId             ID de la prenda a consultar
     * @param int $active               Mostrar solo los arreglos activos o inactivos
     * 
     * @return Fix[]                    Array de prendas
     */
    public function getFixes($clotheID, $active = -1){
        $fixes = array();
        $db = $this->connect(); 
        $sql = "SELECT * FROM CLOTHES_FIXES WHERE CLOTHE_ID = :clotheID";
        if($active >= 0){
            switch($active){
                case 1:
                    $sql .= " AND ACTIVE = 1";
                    break;
                default:
                    $sql .= " AND ACTIVE = 0";
                    break;
            }
            
        }

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
                return new Fix(
                    $row["FIX_ID"], 
                    $row["CLOTHE_ID"],
                    $row["NAME"],
                    $row["PRICE"],
                    $row["ACTIVE"],
                    $row["CREATION_DATE"],
                    $row["UPDATE_DATE"]
                );
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
        $states = array();

        $db = $this->connect(); 
        $sql = "SELECT * FROM ORDER_ESTATES";
        $stmt = $db->prepare($sql);

        if($stmt->execute()){
            while($row = $stmt->fetch()){
                array_push($states, new Estate(
                    $row["ESTATE_ID"], 
                    $row["NAME"],
                    $row["CSS_CLASS"],
                    $row["DESCRIPTION"]
                ));
            }
        }    
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
