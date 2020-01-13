<?php
    Class DanceTicket extends Ticket{
        private $artist;
        private $venue;

        public function __construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $price, $venue, $artist){
            parent::__construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time);                     
            $this->artist = $artist;
            $this->venue = $venue;                       
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