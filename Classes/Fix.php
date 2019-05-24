<?php
class Fix{
    private $id;                //ID del arreglo
    private $clotheID;          //ID de la prenda relaccionada
    private $name;              //Nombre del arreglo
    private $price;             //Precio del arreglo
    private $creationDate;      //Fecha de creacion del arreglo
    private $updateDate;        //Fecha de actualizacion del arreglo
    private $active;            //Si el arreglo esta habilitado o deshabilitado
    function __construct($id, $clotheID, $name, $price, $creationDate, $updateDate, $active = true){
        $this->id = $id;
        $this->name = $name;
        $this->clotheID = $clotheID;
        $this->price = $price;
        $creationDateOb = new DateTime();
        $creationDateOb->setTimestamp($creationDate);
        $this->creationDate = $creationDateOb;
        $updateDateOb = new DateTime();
        $updateDateOb->setTimestamp($updateDate);
        $this->updateDate = $updateDateOb;
        $this->active = $active;
    }
    function getId(){
        return $this->id;
    }
    function getClotheId(){
        return $this->clotheID;
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
    function getUpdateDate(){   
        return $this->updateDate;
    }      
    /**
     * Obtiene una cadena de texto de la fecha de creación del arreglo
     * 
     * @return String               //Fecha de creación
     */
    function getCreationDateString(){    
        $date = $this->creationDate;
        return $date->format('d/m/Y - H:i:s');  
    }
    /**
     * Obtiene una cadena de texto de la fecha de actualización del arreglo
     * 
     * @return String               //Fecha de actualización
     */
    function getUpdateDateString(){    
        $date = $this->updateDate;
        return $date->format('d/m/Y - H:i:s');  
    }
    /**
     * Especifica si el arreglo esta habilitado o deshabilitado
     * 
     * @return boolean true             //Si esta habilitado
     * @return boolean false            //Si esta deshabilitado
     */
    function isActive(){
        return $this->active;
    }
}