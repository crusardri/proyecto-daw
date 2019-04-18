<?php
class Arreglo{
    private $id;
    private $name;
    private $price;
    function __construct($id, $name, $price){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getPrice(){
        return $this->price;
    }
}