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
        //TO DO
    }
    function getOrderID(){
        //TO DO
    }
    function getUser(){
        //TO DO
    }
    function getAssigneduser(){
        //TO DO
    }
    function getEstate(){
        //TO DO
    }
    function getEstateString(){
        //TO DO
    }
    function getEnterDate(){
        //TO DO
    }
    function getEnterDateString(){
        //TO DO
    }
    function getTargetDate(){
        //TO DO
    }
    function getTargetDateString(){
        //TO DO
    }
    function getFinishDate(){
        //TO DO
    }
    function getFinishDateString(){
        //TO DO
    }
    function getOutDate(){
        //TO DO
    }
    function getOrderItems(){
        //TO DO
    }
    function getObservations(){
        //TO DO
    }
}