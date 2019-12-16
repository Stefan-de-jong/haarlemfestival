<?php
    Class CartItem{
        private $event_id;
        private $event_type;
        private $ticket_type;
        private $amount;
        private $date;
        private $time;
        private $language;
        private $price;

        public function __construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $language, $price){
            $this->event_id = $event_id;
            switch ($event_type) {
                case '1':
                    $this->event_type = 'Haarlem Dance';
                    break;
                case '2':
                    $this->event_type = 'Haarlem Food';
                    break;
                case '3':
                    $this->event_type = 'Haarlem Historic';
                    break;
                case '4':
                    $this->event_type = 'Haarlem Jazz';
                    break;    
                default:
                    $this->event_type = $event_type;
                    break;
            }
            
            $this->ticket_type = $ticket_type;
            $this->amount = $amount;
            $this->date = $date;
            $this->time = $time;            
            $this->language = $language;
            $this->price = $price;            
        }

        public function getEventType(){
            return $this->event_type;
        }
        public function getTicketType(){
            if($this->ticket_type == 'historic_single_ticket'){
                return 'Single ticket';
            } elseif($this->ticket_type == 'historic_fam_ticket'){
                return 'Family ticket';
            } else
            return $this->ticket_type;
        }
        public function getAmount(){
            return $this->amount;
        }
        public function getDate(){
            return $this->date;
        }
        public function getTime(){
            return $this->time;
        }
        public function getLanguage(){
            return $this->language;
        }
        public function getPrice(){
            return $this->price;
        }
        public function getSubtotal(){
            return $this->price*$this->amount;
        }
    }
?>