<?php

namespace App\Models;


class timeplace
{
    private $event;
    private $span;
    private $start_date;

    function getEvent(){
        return $this->event;
    }

    function setEvent($Event){
        $this->event = $Event;
    }

    function getSpan(){
        return $this->span;
    }
    
    function setSpan($Span){
        $this->span = $Span;
    }

    function getStartDate(){
        return $this->start_date;
    }

    function setStartDate($start_date){
        $this->start_date = $start_date;
    }

    function __toString(){
        return "event : {$this->getEvent()} span : {$this->getSpan()}, startDate : {$this->getStartDate()}";
    }
}