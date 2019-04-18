<?php
class Prenda{
    private $id;
    private $name;
    private $arreglos;
    function __construct($id, $name, $arreglos){
        $this->id = $id;
        $this->name = $name;
        $this->arreglos = $arreglos;
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
}