<?php
    Class CartItem{
        private $event_type;
        private $ticket_type;
        private $amount;
        private $date;
        private $time;
        private $language;
        private $price;
        private $subtotal;

        public function __construct($event_type, $ticket_type, $amount, $date, $time, $language, $price, $subtotal){
            $this->event_type = $event_type;
            $this->ticket_type = $ticket_type;
            $this->amount = $amount;
            $this->date = $date;
            $this->time = $time;            
            $this->language = $language;
            $this->price = $price;
            $this->subtotal = $subtotal;
        }

        public function getEventType(){
            return $this->event_type;
        }
        public function getTicket_type(){
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
            return $this->subtotal;
        }
    }
?>