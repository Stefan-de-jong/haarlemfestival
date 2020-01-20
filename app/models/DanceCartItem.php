<?php
    Class DanceCartItem extends CartItem{
        private $artist;
        private $venue;
        private $address;
        private $ticket_name;

        public function __construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $artist, $price, $venue, $address, $ticket_name){
            parent::__construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $price);                     
            $this->artist = $artist;
            $this->venue = $venue;        
            $this->address = $address;     
            $this->ticket_name = $ticket_name;           
        }        
        
        public function getTicketType(){            
            return $this->ticket_type;
        }

        public function printTicketType($ticket_type){ //for some reason getting the ticket type from the class itself did not work so I pass ticket_type as a param
            if(strpos($ticket_type, "dance_ticket") !== false)
            {
                return 'Dance Ticket';
            }
            else if(strpos($ticket_type, 'all_access') !== false)
            {
                return 'All-Access';
            }
            else
            {
            return "Ticket for dance";
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

        public function getTicketName()
        {
            return $this->ticket_name;
        }
  
    }
?>