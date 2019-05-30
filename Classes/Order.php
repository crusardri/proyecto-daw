<?php
class Order{
    private $id;
    private $client;
    private $employee;
    private $state;
    private $enterDate;
    private $workingDate;
    private $finishDate;
    private $outDate;
    private $cancelDate;
    private $totalOrderItems;
    private $observations;
    private $updateDate;
    function __construct($id = 0, $client, $employee, $state = 0, $enterDate, $workingDate, $finishDate, $outDate, $cancelDate, $totalOrderItems, $observations, $updateDate){
        $this->id = $id;
        $this->client = $client;
        $this->employee = $employee;
        $this->state = $state;
        $this->totalOrderItems = $totalOrderItems;
        $this->observations = $observations;
        if(!is_null($enterDate)){
            $enterDateO = new DateTime();
            $this->enterDate =  $enterDateO->setTimestamp($enterDate);
        }
        if(!is_null($workingDate)){
        $workingDateO = new DateTime();
        $this->workingDate = $workingDateO->setTimestamp($workingDate);
        }
        if(!is_null($finishDate)){
        $finishDateO = new DateTime();
        $this->finishDate = $finishDateO->setTimestamp($finishDate);
        }
        if(!is_null($outDate)){
        $outDateO = new DateTime();
        $this->outDate = $outDateO->setTimestamp($outDate);
        }
        if(!is_null($cancelDate)){
        $cancelDateO = new DateTime();
        $this->cancelDate = $cancelDateO->setTimestamp($cancelDate);
        }
        if(!is_null($updateDate)){
        $updateDateO = new DateTime();
        $this->updateDate = $updateDateO->setTimestamp($updateDate);
        }
    }
    function getID(){
        return $this->id;
    }
    function getClient(){
        return $this->client;
    }
    function getEmployee(){
        return $this->employee;
    }
    function getState(){
        return $this->state;
    }
    function getEnterDate(){
        return $this->enterDate;
    }
    function getEnterDateString(){
        $date = $this->enterDate;
        if(is_null($date)){
            return "-";
        }
        return $date->format('d-m-Y H:i:s');   
    }
    function getWorkingDate(){
        return $this->workingDate;
    }    
    function getWorkingDateString(){
        $date = $this->workingDate;
        if(is_null($date)){
            return "-";
        }
        return $date->format('d-m-Y H:i:s');     
    }
    function getFinishDate(){
        return $this->finishDate;
    }
    function getFinishDateString(){
        $date = $this->finishDate;
        if(is_null($date)){
            return "-";
        }
        return $date->format('d-m-Y H:i:s');   
    }
    function getOutDate(){
        return $this->outDate;
    }
    function getOutDateString(){
        $date = $this->outDate;
        if(is_null($date)){
            return "-";
        }
        return $date->format('d-m-Y H:i:s');   
    }
    function getCancelDate(){
        return $this->cancelDate;
    }
    function getCancelDateString(){
        $date = $this->cancelDate;
        if(is_null($date)){
            return "-";
        }
        return $date->format('d-m-Y H:i:s');   
    }
    function getTotalOrderItems(){
        return $this->totalOrderItems;
    }
    function getObservations(){
        return $this->observations;
    }   
    function getUpdateDate(){   
        return $this->updateDate;
    }       
    function getUpdateDateString(){    
        $date = $this->updateDate;
        if(is_null($date)){
            return "-";
        }
        return $date->format('d-m-Y H:i:s');   
    }
}