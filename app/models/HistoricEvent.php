<?php
    class HistoricEvent{
        private $id;
        private $date;
        private $beginTime;
        private $endTime;
        private $eventType;
        private $price;
        private $nTickets;
        private $language;
        private $guide;

        public function __construct($date, $beginTime, $endTime, $eventType, $price, $nTickets, $language, $guide){
            $this->date = $date;
            $this->beginTime = $beginTime;
            $this->endTime = $endTime;
            $this->eventType = $eventType;
            $this->price = $price;
            $this->nTickets = $nTickets;
            $this->language = $language;
            $this->guide = $guide;
        }

        // getters
        public function getId(){
            return $this->id;
        }
        public function getDate(){
            return $this->price;
        }
        public function getBeginTime(){
            return $this->nTickets;
        }
        public function getEndTime(){
            return $this->language;
        }
        public function getEventType(){
            return $this->guide;
        }    
        public function getprice(){
            return $this->price;
        }
        public function getnTickets(){
            return $this->nTickets;
        }
        public function getlanguage(){
            return $this->language;
        }
        public function getguide(){
            return $this->guide;
        }    

        // setters
        public function setprice($price){
            $this->price = $price;
        }
        public function setnTickets($nTickets){
            $this->nTickets = $nTickets;
        }
    }

?>