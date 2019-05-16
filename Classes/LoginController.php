<?php
require("IConnectable.php");
class LoginController implements IConnectable {
    /**
    * Devuelve una conexion a la Base de datos
    * @return PDO Conexion a la base de datos completa.
    */
    private static function connect(){
        return new PDO("sqlite:.data/games.db");
    }
    /**
    * Consulta en la base de datos si el nombre del usuario y el Hash de la contraseña coincide en la base de datos y añade la ID de usuario a la sesion
    * @param String $username El nombre de usuario
    * @param String $password La contraseña en texto plano
    * 
    * @return int 0 si todo ha ido bien
    * @return int 1 si el usuario no esta en la base de datos
    * @return int 2 si la contraseña no es correcta
    * @return int -1 si algo ha fallado
    */
    public function login($username, $password){
        $db = $this::connect();
        $db = Connection::connect();
        $user = $this->getUserByName($username);
        if(isset($user)){
            if($user->checkPassword($password)){
                $_SESSION["userID"] = $user->getID();
                return 0;
            }else {
                return -1;
            }
            return 2;
        } else {
            return 1;
        }
    }
    /**
    * Borra el ID de usuario de la sesión
    */
    public function logout(){
        session_start();
        session_destroy();
    }
    /**
    * Comprueba si la contraseña antigua coincide en la base de datos,y  la cambia por la nueva establecida
    * @param String $oldPassword La contraseña antigua
    * @param String $newPassword La nueva contraseña
    *
    * @return int 0 si todo ha ido bien
    * @return int 1 si la contraseña antigua no funciona
    * @return int -1 si algo ha fallado
    */
    public function changePassword($oldPassword, $newPassword){
        $db = $this->connect(); 
        $sql = "UPDATE users SET hashed_password = :newPass WHERE :oldPass = hashed_password";
        $stmt = $db->stmt_init();
        $stmt->prepare($sql);
        $stmt->bindParam(':newPass', $newPassword);
        $stmt->bindParam(':oldPass', $oldPassword);
        if($stmt->execute()){
            $user->setPassword($newPassword);
            return 0;
        } else {
            return -1;
        }

       $stmt->close();
       $db->close();
    }
    /**
    * Cambia el email del usuario por uno nuevo
    * @param String $newString El nuevo email
    * 
    * @return int 0 si se ha cambiado correctamente
    * @return int -1 si algo ha ido mal
    */
    public function changeEmail($newEmail){
        $userID = $user->getID();
        $db = Connection::connect();
        $sql = "UPDATE users SET email = :email WHERE user_id = :userID";
        $stmt = $db->stmt_init();
        $stmt->prepare($sql);
        $stmt->bindParam(':emailUser', $newEmail);
        $stmt->bindParam(':userID', $userID);
        $dbsuccess = $stmt->execute();
        
        if($dbsuccess){
            $user->setEmail($newEmail);
            return 0;
        } else {
            return -1;
        }
        
        $stmt->close();
        $db->close();
    }
    /**
    * Registra un usuario en la base de datos
    * @param String $username Nombre de usuario
    * @param String $password Contraseña del usuario (Se debe crear el Hash de la contraseña)
    * @param String $email El email del usuario
    * @param String $role El Rol del usuario
    *
    * @return int 0 Si todo ha ido bien
    * @return int 1 Si el nombre de usuario tiene menos de 4 caracteres
    * @return int 2 si el nombre de usuario ya esta registrado
    * @return int 3 si la contraseña tiene menos de 6 caracteres
    * @return int 4 si el correo no es valido
    * @return int 5 si el correo ya esta registrado
    * @return int -1 si algo ha fallado
    */
    public function registerUser($userName, $password, $email, $role = "user"){
        if (strlen($username) < 4){
            return 1;
        } elseif($this->checkUsername($username)){
            return 2;
        } elseif(strlen($password) < 6){
            return 3;
        }elseif(empty($email)){
            return 4;
        }elseif($this->checkEmail($email)){
            return 5;
        }else{
            $db = $this->connect(); 
            $sql = "INSERT INTO users (username, hashed_password, email) VALUES (:usuario, :contrasena, :email)";
            $stmt = $db->prepare($sql);
        
            $stmt->bind_param(":usuario", $userName);
            $stmt->bind_param(":contrasena", $password);
            $stmt->bind_param(":email", $email);
            if($stmt->execute()){
                return 0;
            } else {
                return -1;
            }
        }
    }  
}