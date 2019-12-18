<?php
    Class HistoricCartItem extends CartItem{
        private $language;

        public function __construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $language, $price){
            parent::__construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $price);                     
            $this->language = $language;                        
        }        
        
        public function getTicketType(){
            if($this->ticket_type == 'historic_single_ticket'){
                return 'Single ticket';
            } elseif($this->ticket_type == 'historic_fam_ticket'){
                return 'Family ticket';
            } else
            return $this->ticket_type;
        }

        public function getLanguage(){
            return $this->language;
        }
  
    }
?>