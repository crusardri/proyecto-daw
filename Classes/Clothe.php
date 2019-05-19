<?php
class Prenda{
    private $id;
    private $name;
    private $arreglos;
    private $creationDate;
    private $active;
    function __construct($id, $name, $arreglos, $creationDate, $active = true){
        $this->id = $id;
        $this->name = $name;
        $this->arreglos = $arreglos;
        $this->creationDate = new DateTime($this->creationDate);
        $this->active = $active;
    }
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getArreglos(){
        return $this->arreglos;
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