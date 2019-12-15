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
        public function setnTickets($nTickets){
            $this->nTickets = $nTickets;
        }
    }

?>