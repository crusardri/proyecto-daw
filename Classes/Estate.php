<?php
class Estate{
    private $id;
    private $name;
    private $cssClass;
    function __construct($id, $name, $cssClass){
        $this->id = $id;
        $this->name = $name;
        $this->cssClass = $cssClass;
    }
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getCssClass(){
        return $this->cssClass;
    }
}