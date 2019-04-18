<?php
class OrderItem{
    private $prenda;
    private $arreglo;
    private $price;
    private $description;
    function __construct($prenda, $parreglo, $price, $description){
        $this->prenda = $prenda;
        $this->parreglo = $arreglo;
        $this->price = $price;
        $this->description = $description;
    }
    function getPrenda(){
        return $this->prenda;
    }
    function getArreglo(){
         return $this->arreglo;
    }
    function getPrice(){
         return $this->price;
    }
    function getDescription(){
        return $this->description;
    }
}