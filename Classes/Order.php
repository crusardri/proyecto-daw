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
    function __construct($orderID = 0, $user, $estate = 0, $enterDate, $targetDate, $finishDate, $outDate, $items, $observations){
        $this->id = $orderID;
        $this->user = $user;
        $this->assigned = $assigned;
        $this->estate = $estate;
        $this->enterDate = $enterDate;
        $this->targetDate = $targetDate;
        $this->finishDate = $finishDate;
        $this->outDate = $outDate;
        $this->items = $items;
        $this->observations = $observations;
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
    function getEstateString(){
        return $this->;
    }
    function getEnterDate(){
        return $this->enterDate;
    }
    function getEnterDateString(){
        return $this->;
    }
    function getTargetDate(){
        return $this->targetDate;
    }    
    function getTargetDateString(){
        return $this->;
    }
    function getFinishDate(){
        return $this->finishDate;
    }
    function getFinishDateString(){
        return $this->;
    }
    function getOutDate(){
        return $this->outDate;
    }
    function getOrderItems(){
        return $this->items;
    }
    function getObservations(){
        return $this->observations;
    }
}