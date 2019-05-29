<?php
class OrderItem{
    private $id;
    private $clothe;
    private $fix;
    private $price;
    private $description;
    function __construct($id, $clothe, $fix, $price, $description){
        $this->id = $id;
        $this->clothe = $clothe;
        $this->fix = $fix;
        $this->price = $price;
        $this->description = $description;
    }
    function getID(){
        return $this->id;
    }
    function getClothe(){
        return $this->clothe;
    }
    function getFix(){
         return $this->fix;
    }
    function getPrice(){
         return $this->price;
    }
    function getDescription(){
        return $this->description;
    }
}