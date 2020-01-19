<?php
    Class DanceTicket extends Ticket{
        private $artist;
        private $venue;
        private $ticket_name;

        public function __construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $price, $venue, $artist, $ticket_name){
            parent::__construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time);                     
            $this->artist = $artist;
            $this->venue = $venue;   
            $this->ticket_name = $ticket_name;                    
        }        
        
        public function getTicketType(){            
            return $this->ticket_type;
        }

        public function printTicketType(){
            if(strpos($this->ticket_name, "dance_ticket") !== false)
            {
                return 'Dance Ticket';
            }
            else if(strpos($this->ticket_name, 'all_access') !== false)
            {
                return 'All-Access';
            }
            else
            {
            return $this->ticket_name;
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

        public function getTicketName(){
            return $this->ticket_name;
        }
  
    }
?>