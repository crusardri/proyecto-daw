<?php
class User{
    private $id;
    private $username;
    private $password;
    private $email;
    private $role;
    function __construct($id = 0, $username, $password = null, $email, $role){
        $this->id = $id;
        $this->id = $username;
        $this->id = $password;
        $this->id = $email;
        $this->id = $role;
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