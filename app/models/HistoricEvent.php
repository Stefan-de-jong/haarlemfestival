<?php
    class HistoricEvent extends Event{     
        private $language;
        private $guide;

        public function __construct($id, $date, $begin_time, $end_time, $event_type, $n_tickets, $language, $guide){
            parent::__construct($id, $date, $begin_time, $end_time, $event_type, $n_tickets);           
            $this->language = $language;
            $this->guide = $guide;
        }

        // Getters
        public function getLanguage(){
            return $this->language;
        }
        public function getGuide(){
            return $this->guide;
        }    
        public function getLanguageId(){
            if($this->language == 'Nederlands'){
                return 1;
            } elseif($this->language == 'English'){
                return 2;
            } else
            return 3;
        }        

        // Setters
        public function setLanguage($language){
            $this->language = $language;
        }
        public function setGuide($guide){
            $this->guide = $guide;
        }   
        
        
    }

?>