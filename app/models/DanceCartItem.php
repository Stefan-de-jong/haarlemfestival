<?php
    Class DanceCartItem extends CartItem{
        private $artist;
        private $venue;
        private $address;

        public function __construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $artist, $price, $venue, $address){
            parent::__construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $price);                     
            $this->artist = $artist;
            $this->venue = $venue;        
            $this->address = $address;                
        }        
        
        public function getTicketType(){            
            return $this->ticket_type;
        }

        public function printTicketType(){
            if(strpos($this->ticket_type, "dance_ticket") !== false)
            {
                return 'Dance Ticket';
            }
            else if(strpos($this->ticket_type, 'all_access') !== false)
            {
                return 'All-Access';
            }
            else
            {
            return $this->ticket_type;
            }
        }        

        public function getArtist(){
            return $this->artist;
        }

        public function getVenue(){
            return $this->venue;
        }

        public function getAddress(){
            return $this->address;
        }
  
    }
?>