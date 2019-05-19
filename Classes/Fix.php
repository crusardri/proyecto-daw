<?php
class Arreglo{
    private $id;
    private $name;
    private $price;
    private $creationDate;
    private $active;
    function __construct($id, $name, $price, $creationDate, $active = true){
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->creationDate = new DateTime($this->creationDate);
        $this->active = $active;
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
    function getCreationDate(){   
        return $this->creationDate;
    }       
    function getCreationDateString(){    
        $date = $this->creationDate;
        $date->format('d-m-Y H:i:s');   
        return $this->creationDate;
    }
    function getActive(){
        return $this->active;
    }
}