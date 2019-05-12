<?php
class Order{
    private $id;
    private $user;
    private $assigned;
    private $estate;
    private $enterDate;
    private $targetDate;
    private $finishDate;
    private $outDate;
    private $items;
    private $observations;
    private $updateDate;
    function __construct($orderID = 0, $user,$assigned, $estate = 0, $enterDate, $targetDate, $finishDate, $outDate, $items, $observations, $updateDate){
        $this->id = $orderID;
        $this->user = $user;
        $this->assigned = $assigned;
        $this->estate = $estate;
        $this->enterDate = new DateTime($this->enterDate);
        $this->targetDate = new DateTime($this->targetDate);
        $this->finishDate = new DateTime($this->finishDate);
        $this->outDate = new DateTime($this->outDate);
        $this->items = $items;
        $this->observations = $observations;
        $this->updateDate = new DateTime($this->updateDate);
    }
    function getOrderID(){
        return $this->orderID;
    }
    function getUser(){
        return $this->user;
    }
    function getAssigneduser(){
        return $this->assigned;
    }
    function getEstate(){
        return $this->estate;
    }
    function getEnterDate(){
        return $this->enterDate;
    }
    function getEnterDateString(){
        $date = $this->enterDate;
        $date->format('d-m-Y H:i:s');   
        return $this->enterDate;
    }
    function getTargetDate(){
        return $this->targetDate;
    }    
    function getTargetDateString(){
        $date = $this->targetDate;
        $date->format('d-m-Y H:i:s');   
        return $this->targetDate;
    }
    function getFinishDate(){
        return $this->finishDate;
    }
    function getFinishDateString(){
        $date = $this->finishDate;
        $date->format('d-m-Y H:i:s');   
        return $this->finishDate;
    }
    function getOutDate(){
        return $this->outDate;
    }
    function getOutDateString(){
        $date = $this->outDate;
        $date->format('d-m-Y H:i:s');   
        return $this->outDate;
    }
    function getOrderItems(){
        return $this->items;
    }
    function getObservations(){
        return $this->observations;
    }
    function getUpdateDate(){   
        return $this->updateDate;
    }       
    function getUpdateDateString(){    
        $date = $this->updateDate;
        $date->format('d-m-Y H:i:s');   
        return $this->updateDate;
    }
}