<?php

class UserController {
    private $ajax; //Si es una consulta Ajax (cambio localizacion DDBB)
    public function __construct($ajax = false){
        $this->ajax = $ajax;
    }
    /**
    * Devuelve una conexion a la Base de datos
    *
    * @return PDO                           Conexion a la base de datos completa.
    */
    private function connect(){
        if($this->ajax){
            return new PDO("sqlite:../.data/data.db");
        }
        return new PDO("sqlite:.data/data.db");
    }
    /**
    * Consulta en la base de datos un usuario por ID y devuelve un objeto de clase Usuario
    * @return User                          Usuario completo
    */
    public function getUser($id){
        $db = $this->connect(); 
        $sql = "SELECT * FROM USERS AS U, USER_ROLES AS R WHERE USER_ID = :userID AND U.ROLE_ID = R.ROLE_ID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $id);
        if($stmt->execute()){
            if($row = $stmt->fetch()){
               return new User(
                $row["USER_ID"], 
                $row["USERNAME"], 
                $row["HASHED_PASSWORD"], 
                $row["EMAIL"], 
                new Role(
                    $row["ROLE_ID"], 
                    $row["ROLE_NAME"], 
                    $row["ROLE_CSS_CLASS"], 
                    $row["ROLE_DESCRIPTION"]
                ), 
                $row["PHONE"], 
                $row["NAME"], 
                $row["SURNAME"], 
                $row["REGISTER_TIMESTAMP"], 
                $row["UPDATE_TIMESTAMP"], 
                $row["ACTIVE"]
                );
            }
        } 
        return null;
    }
    /**
    * Consulta en la base de datos y devuelve todos los usuarios comprendidos en un rango.
    * @param String $searchString           Cadena a buscar
    * @param int $roleFilter                Especifica que usuarios mostrar por rol
    * @param int $estateFilter              Especifica el estado del usuario
    * @param int $orderByFilter             Especifica el tipo de ordenacion de usuarios
    * @param int $orderDirectionFilter      Especifica la direccion de ordenacion
    * @param int $page                      Especifica la pagina que se va a visualizar
    * @param int $itemsPerPage              Especifica la cantidad de usuarios que apareceran por página.
    *
    * @return User[]                        Array de usuarios
    *
    * @author Iván Maldonado Fernández
    */
    public function getUsers($searchString, $roleFilter, $stateFilter, $orderByFilter, $orderDirectionFilter, $page = 1, $itemsPerPage = 10, $noClients = false){
        $searchString = "%$searchString%"; 
        $page = $page - 1;
        $startFromItem = $page * $itemsPerPage; //Obtener desde que usuario va a obtener la SQL
        $users = array();                       //Array de usuarios
        $db = $this->connect();                 //Conexion DDBB
        //SQL Principal
        $sql = "
            SELECT 
                *
            FROM
                USERS AS U,
                USER_ROLES AS R
            WHERE
                U.ROLE_ID = R.ROLE_ID"; 
        //Concatenar condicion busqueda
        if(!is_null($searchString) && !empty($searchString)){
            $sql .= " 
                AND (
                    LOWER(U.NAME) LIKE LOWER(:searchString) OR 
                    LOWER(U.SURNAME) LIKE LOWER(:searchString) OR 
                    LOWER(U.USERNAME) LIKE LOWER(:searchString) OR 
                    LOWER(U.EMAIL) LIKE LOWER(:searchString) OR 
                    LOWER(U.PHONE) LIKE LOWER(:searchString)
                )";
        }
        //Concatenar condicion filtro
        if(!is_null($roleFilter) && $roleFilter >= 0){
            $sql .= " AND 
                U.ROLE_ID = :roleID";
        }
        //Mostrar solo no clientes (Especifico para el AJAX)
        if($noClients){
            $sql .= " AND 
                U.ROLE_ID != 0";
        }
        //Cocnatenar condicion activo
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $sql .= " AND 
                U.ACTIVE = :active";
        }
        //Cocnatenar condicion activo
        //Bindear filtro order by
        //(NOTA!!!!!! No se pueden bindear a una statement nombres de tablas, columnas, ni palabras claves)
        switch($orderByFilter){
            case 0:
                $orderBy = "U.USER_ID";
                break;
            case 1:
                $orderBy = "U.USERNAME";
                break;
            case 2:
                $orderBy = "U.ROLE_ID";
                break;
            case 3: 
                $orderBy = "U.NAME";
                break;
            case 4:
                $orderBy = "U.SURNAME";
                break;
            case 5:
                $orderBy = "U.EMAIL";
                break;
            case 6:
                $orderBy = "U.ACTIVE";
                break;
            case 7:
                $orderBy = "U.REGISTER_TIMESTAMP";
                break;
            case 8:
                $orderBy = "U.UPDATE_TIMESTAMP";
                break;
            default:
                $orderBy = "U.USER_ID";
                break;
        }
        $sql .= " 
            ORDER BY 
                $orderBy ";
        //Bindear filtro orden 
        //(NOTA!!!!!! No se pueden bindear a una statement nombres de tablas, columnas, ni palabras claves)
        switch ($orderDirectionFilter){
            case 1:
                $sql .= "DESC ";
                break;
            default: 
                $sql .= "ASC ";
                break;
        }
        //Final de la SQL (Limitado por página)
        $sql .= " 
            LIMIT 
                :page, 
                :maxItems";
        $stmt = $db->prepare($sql);//Preparamos sentencia
        //Bindear filtro busqueda
        if(!is_null($searchString) && !empty($searchString)){
            $stmt->bindParam(':searchString', $searchString);
        }
        //Bindear filtro rol
        if(!is_null($roleFilter) && $roleFilter >= 0){
            $stmt->bindParam(':roleID', $roleFilter);
        }
        //Bindear filtro estado
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $stmt->bindParam(':active', $stateFilter);
        }
        //Bindear filtro empezar desde (página)
        $stmt->bindParam(":page", $startFromItem);
        //Bindear filtro elementos por página
        $stmt->bindParam(":maxItems", $itemsPerPage);
        //Ejecutamos la Query
        if($stmt->execute()){
            while($row = $stmt->fetch()){
                array_push($users, new User(
                    $row["USER_ID"], 
                    $row["USERNAME"],
                    $row["HASHED_PASSWORD"],
                    $row["EMAIL"],
                    new Role(
                        $row["ROLE_ID"], 
                        $row["ROLE_NAME"], 
                        $row["ROLE_CSS_CLASS"], 
                        $row["ROLE_DESCRIPTION"]
                    ),
                    $row["PHONE"],
                    $row["NAME"],
                    $row["SURNAME"],
                    $row["REGISTER_TIMESTAMP"],
                    $row["UPDATE_TIMESTAMP"],
                    $row["ACTIVE"]
                ));
            }
        }
        return $users;
    }
    /**
    * Consulta en la base de datos y devuelve el total de usuarios que coincida con los filtros.
    * @param String $searchString       Cadena a buscar
    * @param int $roleFilter            Especifica que usuarios mostrar por rol
    * @param int $stateFilter          Especifica el estado del usuario
    *
    * @return int                       Numero total de usuarios segun filtros
    *
    * @author Iván Maldonado Fernández
    */
    public function getTotalUsers($searchString = "", $roleFilter = -1, $stateFilter = -1){
        $searchString = "%$searchString%"; 
        $db = $this->connect();                 //Conexion DDBB
        //SQL Principal
        $sql = "
            SELECT 
                COUNT(*)
            FROM
                USERS AS U,
                USER_ROLES AS R
            WHERE
                U.ROLE_ID = R.ROLE_ID"; 
        //Concatenar condicion busqueda
        if(!is_null($searchString) && !empty($searchString)){
            $sql .= " 
                AND (
                    LOWER(U.NAME) LIKE LOWER(:searchString) OR 
                    LOWER(U.SURNAME) LIKE LOWER(:searchString) OR 
                    LOWER(U.USERNAME) LIKE LOWER(:searchString) OR 
                    LOWER(U.EMAIL) LIKE LOWER(:searchString) OR 
                    LOWER(U.PHONE) LIKE LOWER(:searchString)
                )";
        }
        //Concatenar condicion filtro
        if(!is_null($roleFilter) && $roleFilter >= 0){
            $sql .= " AND 
                U.ROLE_ID = :roleID";
        }
        //Cocnatenar condicion activo
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $sql .= " AND 
                U.ACTIVE = :active";
        }
        $stmt = $db->prepare($sql);//Preparamos sentencia
        //Bindear filtro busqueda
        if(!is_null($searchString) && !empty($searchString)){
            $stmt->bindParam(':searchString', $searchString);
        }
        //Bindear filtro rol
        if(!is_null($roleFilter) && $roleFilter >= 0){
            $stmt->bindParam(':roleID', $roleFilter);
        }
        //Bindear filtro estado
        if(!is_null($stateFilter) && $stateFilter >= 0){
            $stmt->bindParam(':active', $stateFilter);
        }
        //Ejecutamos la Query
        if($stmt->execute()){
            if($row = $stmt->fetch()){
                return($row[0]);
            }
        }
        return 0;
    }
    /**
    * Consulta en la base de datos si el nombre de usuario esta disponible
    *
    * @param String $username           Nombre de usuario
    *
    * @return boolean                   Devuelve true si esta disponible, false si esta registrado
    */
    public function checkUsername($username){
        $db = $this->connect(); 
        $sql = "SELECT COUNT(username) AS total FROM USERS WHERE USERNAME = :username";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(':username', $username);

        if($stmt->execute()){
            if($result = $stmt->fetch()){
                if((int)$result['total'] == 0){
                     return true;
                } 
            }
        }  
        return false;  
    }
    
    /**
    * Consulta en la base de datos si el correo electronico esta disponible
    *
    * @param String $email              Nombre de usuario
    *
    * @return boolean                   Devuelve true si esta disponible, false si esta registrado
    */
    public function checkEmail($email){
        $db = $this->connect(); 
        $sql = "SELECT COUNT(EMAIL) AS total FROM USERS WHERE EMAIL = :email";
        $stmt = $db->prepare($sql);
        
        $stmt->bindParam(':email', $email);
        if($stmt->execute()){
            if($result = $stmt->fetch()){
                if((int)$result["total"] == 0){
                    return true;
                } 
            }
        }  
        return false; 
    }
    /**
    * Consulta en la base de datos y devuelve un array de usuarios
    *
    * @return Role[] Roles              Array de roles de usuario
    */
    public function getRoles(){
        $roles = array();
        $db = $this->connect();
        $sql = "SELECT * FROM USER_ROLES";
        $stmt = $db->prepare($sql);

        if($stmt->execute()){
            while($row = $stmt->fetch()){
                $rol = new Role(
                    $row["ROLE_ID"],
                    $row["ROLE_NAME"],
                    $row["ROLE_CSS_CLASS"], 
                    $row["ROLE_DESCRIPTION"]
                );
                array_push($roles, $rol);
            }
        }
        return $roles;
    }
    /**
    * Registra un usuario en la base de datos
    * @param String $username           Nombre de usuario
    * @param String $password           Contraseña del usuario (Se debe crear el Hash de la contraseña)
    * @param String $email              Email del usuario
    * @param String $name               Nombre del usuario
    * @param String $surname            Apellido del usuario
    * @param String $phone              Telefono del usuario
    * @param String $role               ID del Rol del usuario
    *
    * @return int 0                     Todo ha ido bien
    * @return int 1                     Nombre de usuario tiene menos de 4 caracteres
    * @return int 2                     Nombre de usuario ya esta registrado
    * @return int 3                     Contraseña tiene menos de 6 caracteres
    * @return int 4                     Correo no es valido
    * @return int 5                     Correo ya esta registrado
    * @return int 6                     Falta el nombre
    * @return int -1                    Algo ha fallado
    */
    public function registerUser($username, $password, $email, $name, $surname, $phone, $role = 0, $active = 1){
        if (strlen($username) < 4 || !preg_match('/^[a-zA-Z0-9]+$/', $username)){
            return 1;
        } elseif(!$this->checkUsername($username)){
            return 2;
        } elseif(strlen($password) < 6){
             return 3;
        } elseif(empty($email) || !preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email)){
            return 4;
        } elseif(!$this->checkEmail($email)){
            return 5;
        } elseif(empty($name)){
            return 6;
        } else{
            //Comprobar active bien formateado
            if($active > 1 || $active < 0){
                $active = 0;
            }
            $db = $this->connect(); 
            $sql = "INSERT INTO USERS (username, hashed_password, email, name, surname, phone, role_id, update_timestamp, register_timestamp, active ) VALUES (:usuario, :contrasena, :email, :nombre, :surname, :phone, :rol, :registeredDate, :updateDate, :active)";
            $stmt = $db->prepare($sql);
            
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $timestamp = time();
            $stmt->bindParam(":usuario", $username);
            $stmt->bindParam(":contrasena", $passwordHash);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":nombre", $name);
            $stmt->bindParam(":surname", $surname);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":rol", $role);
            $stmt->bindParam(":registeredDate",$timestamp );
            $stmt->bindParam(":updateDate", $timestamp);
            $stmt->bindParam(":active", $active);
            if($stmt->execute() && $stmt->rowCount > 0){
                return 0;
            }else {

            }
        }
        return -1;
    } 
    /**
    * Comprueba si la contraseña antigua coincide en la base de datos,y  la cambia por la nueva establecida
    * @param String $oldPassword        La contraseña antigua
    * @param String $newPassword        La nueva contraseña
    * @param String $repeatPassword     La nueva contraseña
    * @param User $user                 Usuario
    *
    * @return int 0                     Todo ha ido bien
    * @return int 1                     La contraseña antigua no es correcta
    * @return int 2                     La contraseña no tiene al menos 6 caracteres
    * @return int 3                     La contraseña no coincide
    * @return int -1                    Algo ha fallado
    */
    public function changePasswordClient($oldPassword, $newPassword, $repeatPassword, $user){
        if(!$user->checkPassword($oldPassword)){
            return 1;
        } elseif(strlen($newPassword) < 6 || strlen($repeatPassword) < 6  ){
            return 2;
        } elseif ($newPassword != $repeatPassword){
            return 3;
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $db = $this->connect();
            $sql = "UPDATE USERS SET HASHED_PASSWORD = :password, UPDATE_TIMESTAMP = :updateDate  WHERE USER_ID = :userID";
            
            $stmt = $db->prepare($sql);
            $timestamp = time();
            
            $userId = $user->getID();
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':userID', $userId);
            $stmt->bindParam(':updateDate', $timestamp);
            
            if($stmt->execute() && $stmt->rowCount > 0){
                return 0;
            }
        }
        return -1;
    }

    /**
    * Cambia la contraseña de un usuario.
    * @param String $newPassword        Nueva contraseña
    * @param User $user                 Usuario
    *
    * @return int 0                     Todo ha ido bien
    * @return int 1                     La contraseña no tiene al menos 6 caracteres
    * @return int 2                     Si la contraseña no coincide
    * @return int -1                    Algo ha fallado
    */
    public function changePasswordAdmin($newPassword, $user){
        if(strlen($newPassword) < 6){
            return 1;
        } elseif($newPassword != $newPassword){
            return 2;
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $db = $this->connect();
            $sql = "UPDATE USERS SET HASHED_PASSWORD = :password, UPDATE_TIMESTAMP = :updateDate  WHERE USER_ID = :userID";
            
            $stmt = $db->prepare($sql);
            $timestamp = time();
            $userId = $user->getID();
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':userID', $userId);
            $stmt->bindParam(':updateDate', $timestamp);

            if($stmt->execute() && $stmt->rowCount > 0){
                return 0;
            }
        }
        return -1;
    }
    /**
    * Cambia la información personal de un usuario
    * @param String $name               Nombre del usuario
    * @param String $surname            Apellidos del usuario
    * @param String $phone              Telefono del usuario
    *
    * @return int 0                     Todo ha ido bien
    * @return int 1                     Si el nombre esta vacio
    * @return int -1                    Algo ha fallado
    */
    public function changePersonalInfo($userID, $name, $surname, $phone){
        if(empty($name)){
            return 1;
        } else {
            $db = $this->connect(); 
            $sql = "UPDATE USERS SET NAME = :name, SURNAME = :surname, PHONE = :phone, UPDATE_TIMESTAMP = :updateDate WHERE USER_ID = :userID";
            $stmt = $db->prepare($sql);

            $timestamp = time();

            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':updateDate', $timestamp);

            if($stmt->execute() && $stmt->rowCount > 0){
                return 0; 
            }    
        } 
        return -1; 
    }
    /**
     * Cambia el correo electronico de un usuario desde el panel de control
     * @param int $userID               ID de usuario a cambiar el correo
     * @param String $email             Nuevo Email de usuario
     * 
     * @return int 0                    Si todo ha ido bien
     * @return int 1                    Si el correo electronico no es valido
     * @return int 2                    Si el correo electronico ya esta en uso
     * @return int -1                   Si algo ha fallado
     */  
    public function changeEmail($userID, $email){
        if(empty($email) || !preg_match('/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD', $email)){
            return 1;
        } elseif(!$this->checkEmail($email)){
            return 2;
        } else {
            $db = $this->connect(); 
            $sql = "UPDATE USERS SET EMAIL = :emailUser, UPDATE_TIMESTAMP = :updateDate  WHERE USER_ID = :userID";
            $stmt = $db->prepare($sql);

            $timestamp = time();

            $stmt->bindParam(':emailUser', $email);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':updateDate', $timestamp);

            if($stmt->execute() && $stmt->rowCount > 0){
                return 0;  
            }    
        } 
        return -1;
    }
    /**
     * Cambia el Rol de un usuario desde el panel de control
     * @param int $userID               ID de usuario a cambiar
     * @param int $roleID               ID del nuevo rol
     * 
     * @return int 0                    Si todo ha ido bien
     * @return int -1                   Si algo ha fallado
     */  
    public function changeRole($userID, $roleID){
        $db = $this->connect();
        $sql = "UPDATE USERS SET ROLE_ID = :roleID, UPDATE_TIMESTAMP = :updateDate  WHERE USER_ID = :userID AND EXISTS(SELECT ROLE_ID FROM USER_ROLES WHERE ROLE_ID = :roleID)"; 
        $stmt = $db->prepare($sql);

        $timestamp = time();

        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':roleID', $roleID);
        $stmt->bindParam(':updateDate', $timestamp);

        if($stmt->execute() && $stmt->rowCount > 0){
           return 0;
        }
        return -1;
    }
    /**
     * Cambia el estado (activo/desactiado) de un usuario desde el panel de control
     * @param int $userID               ID de usuario a cambiar
     * @param boolean $newState         Nuevo Estado
     * 
     * @return int 0                    Si todo ha ido bien
     * @return int -1                   Si algo ha fallado
     */  
    public function changeState($userID, $newState){
        if($newState){
            $newState = 0;
        }else{
            $newState = 1;
        }
        $db = $this->connect();
        $sql = "UPDATE USERS SET ACTIVE = :newState, UPDATE_TIMESTAMP = :updateDate  WHERE USER_ID = :userID";
        $stmt = $db->prepare($sql);

        $timestamp = time();
    
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':newState', $newState);
        $stmt->bindParam(':updateDate', $timestamp);
    
        if($stmt->execute() && $stmt->rowCount > 0){
            return 0;
        }
        return -1;
    }
    /**
    * Consulta en la base de datos si el nombre del usuario y el Hash de la contraseña coincide en la base de datos y añade la ID de usuario a la sesion
    * @param String $username           Nombre de usuario
    * @param String $password           Contraseña en texto plano
    * 
    * @return int 0                     Todo ha ido bien
    * @return int 1                     Falta por rellenar el campo Usuario
    * @return int 2                     Falta por rellenar el campo Contraseña
    * @return int 3                     El usuario no está en la base de datos
    * @return int 4                     El usuario está deshabilitado
    * @return int 5                     La contraseña no coincide con la base de datos
    * @return int -1                    Algo ha fallado
    */
    public function login($username, $password){
        if (empty($username)){
            return 1;
        } elseif(empty($password)){
            return 2;
        } else {
            $db = $this->connect(); 
            $sql = "SELECT * FROM USERS AS U, USER_ROLES AS R WHERE lower(USERNAME) = lower(:username) AND U.ROLE_ID = R.ROLE_ID";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':username', $username);

            if($stmt->execute()){
                if($row = $stmt->fetch()){
                    $user = new User(
                        $row["USER_ID"],
                        $row["USERNAME"],
                        $row["HASHED_PASSWORD"],
                        $row["EMAIL"], 
                        new Role(
                            $row["ROLE_ID"],
                            $row["ROLE_NAME"],
                            $row["ROLE_CSS_CLASS"],
                            $row["ROLE_DESCRIPTION"]
                        ), 
                        $row["PHONE"],
                        $row["NAME"],
                        $row["SURNAME"],
                        $row["REGISTER_TIMESTAMP"],
                        $row["UPDATE_TIMESTAMP"],
                        $row["ACTIVE"]
                    );
                    if(!$user->isActive()){
                        return 4;
                    } 
                    if(!$user->checkPassword($password)){
                        return 5;
                    }
                    
                    $_SESSION["userID"] = $row[0];
                    return 0;
                } else {
                    return 3;
                }     
            } else {
                return -1;
            }
        } 
    }
    /**
    * Borra la sesión
    */
    public function logout(){
        session_destroy();
    }
}