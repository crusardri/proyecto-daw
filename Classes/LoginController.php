<?php
class LoginController {
    /**
    * Devuelve una conexion a la Base de datos
    * @return PDO Conexion a la base de datos completa.
    */
    private function connect(){
        return new PDO("sqlite:.data/data.db");
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
        return -1;
    }
    /**
    * Borra la sesión
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
    public function changePassword($oldPassword, $newPassword, $user){
        return -1;
    }

    /**
    * Cambia el email del usuario por uno nuevo
    * @param String $newString El nuevo email
    * 
    * @return int 0 si se ha cambiado correctamente
    * @return int 1 si el correo ya existe en la base de datos
    * @return int -1 si algo ha ido mal
    */
    public function changeEmail($newEmail){
        return -1;
    }
    /**
    * Registra un usuario en la base de datos
    * @param String $username Nombre de usuario
    * @param String $password Contraseña del usuario (Se debe crear el Hash de la contraseña)
    * @param String $email El email del usuario
    * @param String $name El nombre del usuario
    * @param String $surname El apellido del usuario
    * @param String $phone El telefono del usuario
    * @param String $role El ID del Rol del usuario
    *
    * @return int 0 Si todo ha ido bien
    * @return int 1 Si el nombre de usuario tiene menos de 4 caracteres
    * @return int 2 si el nombre de usuario ya esta registrado
    * @return int 3 si la contraseña tiene menos de 6 caracteres
    * @return int 4 si el correo no es valido
    * @return int 5 si el correo ya esta registrado
    * @return int 6 si falta el nombre
    * @return int -1 si algo ha fallado
    */
    public function registerUser($userName, $password, $email, $name, $surname, $phone, $role = 0){
        return -1;
    }  
}
