<?php
class Role{
    private $id;
    private $name;
    private $cssClass;
    private $description;
    function __construct($id, $name, $cssClass, $description = ""){
        $this->id = $id;
        $this->name = $name;
        $this->cssClass = $cssClass;
        $this->description = $description;
    }
    function getID(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getCssClass(){
        return $this->cssClass;
    }
    function getDescription(){
        return $this->description;
    }
}