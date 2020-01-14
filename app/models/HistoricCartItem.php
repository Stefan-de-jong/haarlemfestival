<?php
    Class HistoricCartItem extends CartItem{
        private $language;

        public function __construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $language, $price){
            parent::__construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $price);                     
            $this->language = $language;                        
        }        
        
        public function getTicketType(){            
            return $this->ticket_type;
        }

        public function printTicketType(){
            if($this->ticket_type == '300'){
                return 'Single ticket';
            } elseif($this->ticket_type == '301'){
                return 'Family ticket';
            } else
            return $this->ticket_type;
        }        

        public function getLanguage(){
            return $this->language;
        }
  
    }
?>