<?php
class Event
{
    public $id;
    public $date;
    public $begin_time;
    public $end_time;
    public $event_type;
    public $n_tickets;

    public function __construct($id, $date, $begin_time, $end_time, $event_type, $n_tickets)
    {
        $this->id = $id;
        $this->date = $date;
        $this->begin_time = $begin_time;
        $this->end_time = $end_time;
        $this->event_type = $event_type;
        $this->n_tickets = $n_tickets;
    }

    // Getters
    public function getId(){
        return $this->id;
    }
    public function getDate(){
        return $this->date;
    }
    public function getBeginTime(){
        return $this->begin_time;
    }
    public function getEndTime(){
        return $this->end_time;
    }
    public function getEventType(){
        return $this->event_type;
    }
    public function getNTickets(){
        return $this->n_tickets;
    }

    // setters
    public function setDate($date){
        $this->date = $date;
    }
    public function setBeginTime($beginTime){
        $this->beginTime = $beginTime;
    }
    public function setEndTime($endTime){
        $this->endTime = $endTime;
    }
    public function setEventType($eventType){
        $this->eventType = $eventType;
    }    
    public function setNTickets($nTickets){
        $this->nTickets = $nTickets;
    }
}
?>