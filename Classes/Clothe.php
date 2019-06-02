<?php
class Clothe{
    private $id;                //ID de la prenda
    private $name;              //Nombre de la prenda
    private $fixes;             //Arreglos de la prenda
    private $numFixes;          //Numero de arreglos de la prenda
    private $creationDate;      //Fecha de creacion
    private $updateDate;        //Fecha de actualizacion
    private $active;            //Estado habilitado/deshabilitado
    function __construct($id, $name, $numFixes = 0, $fixes = null, $creationDate, $updateDate, $active = 0){
        $this->id = $id;                                
        $this->name = $name;                           
        $this->fixes = $fixes;                          
        $this->numFixes = $numFixes;
        $creationDateOb = new DateTime();
        $creationDateOb->setTimestamp($creationDate);
        $this->creationDate = $creationDateOb;
        $updateDateOb = new DateTime();
        $updateDateOb->setTimestamp($updateDate);
        $this->updateDate = $updateDateOb;
        if($active == 0){
            $this->active = false;
        }else {
            $this->active = true;
        }
    }
    function getId(){
        return $this->id;
    }
    function getName(){
        return $this->name;
    }
    function getNumFixes(){
        return $this->numFixes;
    }
    function getFixes(){
        return $this->fixes;
    }
    function getArreglos(){
        return $this->fixes;
    }
    function getCreationDate(){   
        return $this->creationDate;
    }  
    function getUpdateDate(){   
        return $this->updateDate;
    }         
    /**
     * Obtiene una cadena de texto de la fecha de creación de la prenda
     * 
     * @return String               //Fecha de creación
     */
    function getCreationDateString(){    
        $date = $this->creationDate;
        return $date->format('d/m/Y - H:i:s');
    }
    /**
     * Obtiene una cadena de texto de la fecha de actualización de la prenda
     * 
     * @return String               //Fecha de actualización
     */
    function getUpdateDateString(){    
        $date = $this->updateDate;
        return $date->format('d/m/Y - H:i:s'); 
    }
    /**
     * Especifica si la prenda esta habilitada o deshabilitada
     * 
     * @return boolean true             //Si esta habilitada
     * @return boolean false            //Si esta deshabilitada
     */
    function isActive(){
        return $this->active;
    }
}