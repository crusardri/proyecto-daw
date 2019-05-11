<?php
class User{
    private $id;
    private $username;
    private $password;
    private $email;
    private $role;
    private $telephone;
    private $name;
    private $registeredDate;
    private $updateDate;
    private $active;
    function __construct($id = 0, $username, $password = null, $email, $role, $telephone, $name, $registeredDate, $updateDate, $active = true){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->telephone = $telephone;
        $this->name = $name;
        $this->registeredDate = new DateTime($this->registeredDate);
        $this->updateDate = new DateTime($this->updateDate);;
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
    function getRegisteredDateString(){
        $date = $this->registeredDate;
        $date->format('d-m-Y H:i:s');
        return $this->registeredDate;
        }
    function getUpdateDate(){   
        return $this->updateDate;
        }       
    function getUpdateDateString(){    
        $date = $this->updateDate;
        $date->format('d-m-Y H:i:s');   
        return $this->updateDate;
        }
    function getActive(){
        return $this->active;
    }
    function checkPassword(){
        if(password_verify($password, $this->password)){
            return true;
        }
        return false;
    }
}