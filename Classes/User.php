<?php
require_once("Classes/Role.php");
class User{
    private $id;                //ID del usuario
    private $username;          //Nombre de usuario
    private $password;          //Contraseña CIFRADA del usuario
    private $email;             //Correo electronico del usuario
    private $role;              //Rol del usuario
    private $telephone;         //Telefono del usuario
    private $name;              //Nombre del usuario
    private $surname;           //Apellidos del usuario
    private $registeredDate;    //Fecha de registro del usuario
    private $updateDate;        //Fecha de actualizacion del usuario
    private $active;            //Si el usuario esta activo o deshabiltiado
    function __construct($id = 0, $username, $password = null, $email, $role, $telephone, $name, $surname, $registeredDate, $updateDate, $active = true){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->telephone = $telephone;
        $this->name = $name;
        $registeredDateOb = new DateTime();
        $registeredDateOb->setTimestamp($registeredDate);
        $this->registeredDate = $registeredDateOb;
        $updateDateOb = new DateTime();
        $updateDateOb->setTimestamp($updateDate);
        $this->updateDate = $updateDateOb;
        $this->active = $active;
    }
    function getId(){
        return $this->id;
    }
    function getUsername(){
        return $this->username;
    }
    function getEmail(){
        return $this->email;
    }
    function getRole(){
        return $this->role;
    }
    function getTelephone(){
        return $this->telephone;
    }
    function getName(){
        return $this->name;
    }
    function getRegisteredDate(){
        return $this->registeredDate;
    }
    /**
     * Obtiene una cadena de texto de la fecha de registro del usuario
     * 
     * @return String                       Fecha de registro
     */
    function getRegisteredDateString(){
        $date = $this->registeredDate;
        return $date->format('d/m/Y - H:i:s');
    }
    function getUpdateDate(){   
        return $this->updateDate;
    }       
    /**
     * Obtiene una cadena de texto de la fecha de actualización del usuario
     * 
     * @return String                       Fecha de actualización
     */
    function getUpdateDateString(){    
        $date = $this->updateDate;
        return $date->format('d/m/Y - H:i:s');   
    }
    /**
     * Especifica si el usuario esta habilitado o deshabilitado
     * 
     * @return boolean true                 Si esta habilitado
     * @return boolean false                Si esta deshabilitado
     */
    function isActive(){
        return $this->active;
    }
    /**
     * Comprueba si una cadena de texto es igual a la contraseña del usuario
     * @param String $password              Contraseña a comprobar
     * 
     * @return boolean true                 La cadena coincide con la contraseña
     * @return boolean false                La cadena no coincide con la contraseña
     */
    function checkPassword($password){
        if(password_verify($password, $this->password)){
            return true;
        }
        return false;
    }
    function getSurname(){
        return "APELLIDOS";
    }
}