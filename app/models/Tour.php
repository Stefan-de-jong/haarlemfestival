<?php
    class Tour{
        private $id;
        private $date;
        private $beginTime;
        private $endTime;
        private $eventType;        
        private $nTickets;
        private $language;
        private $guide;

        public function __construct($id, $date, $beginTime, $endTime, $eventType, $nTickets, $language, $guide){
            $this->id = $id;
            $this->date = $date;
            $this->beginTime = $beginTime;
            $this->endTime = $endTime;
            $this->eventType = $eventType;            
            $this->nTickets = $nTickets;
            $this->language = $language;
            $this->guide = $guide;
        }

        // getters
        public function getId(){
            return $this->id;
        }
        public function getDate(){
            return $this->date;
        }
        public function getBeginTime(){
            return $this->beginTime;
        }
        public function getEndTime(){
            return $this->endTime;
        }
        public function getEventType(){
            return $this->eventType;
        }    
        public function getNTickets(){
            return $this->nTickets;
        }
        public function getLanguage(){
            return $this->language;
        }
        public function getGuide(){
            return $this->guide;
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
        public function setLanguage($language){
            $this->language = $language;
        }
        public function setGuide($guide){
            $this->guide = $guide;
        }    
    }

?>