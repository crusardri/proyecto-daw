<?php
class User{
    private $id;
    private $username;
    private $password;
    private $email;
    private $role;

    function __construct($id = 0, $username, $password = null, $email, $role){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
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
    function checkPassword(){
        return $this->password;
    }
}