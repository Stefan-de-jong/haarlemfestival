<?php
    class CartItemRepository{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findHistoric($id, $amount, $ticket_type){
            $this->db->query('SELECT *,
                                event.id as id,
                                language.language as language                                
                                FROM event                                
                                JOIN historicevent
                                ON historicevent.id = event.id
                                JOIN language
                                ON language.id = historicevent.language                                
                                WHERE event_type = :event_type
                                AND event.id = :id
                                ');
            $this->db->bind(':event_type', 3);
            $this->db->bind(':id', $id);
            $event = $this->db->single();

            $this->db->query('SELECT *
                                FROM tickettype
                                WHERE ticket_type = :ticket_type
                                ');
            $this->db->bind(':ticket_type', $ticket_type);
            $ticket = $this->db->single();

            $cartItem = new HistoricCartItem($event->id, $event->event_type, $ticket_type, $amount, $event->date, $event->begin_time, $event->language, $ticket->ticket_price);
            return $cartItem;
        }
        
        public function findFood($id, $amount, $ticket_type, $request)
        {
            $this->db->query('SELECT *, event.id as eventId
                                FROM event                               
                                JOIN foodevent
                                ON foodevent.id = event.id  
                                JOIN restaurant
                                ON restaurant.id = foodevent.restaurant
                                WHERE event_type = :event_type
                                AND event.id = :id
                                ');
            $this->db->bind(':event_type', 2);
            $this->db->bind(':id', $id);
            $event = $this->db->single();

            $this->db->query('SELECT *
                                FROM tickettype
                                WHERE name = :ticket_type
                                ');
            $this->db->bind(':ticket_type', $ticket_type);
            $ticket = $this->db->single();

            $cartItem = new FoodCartItem($event->eventId, $event->event_type, $ticket->id, $amount, $event->date, $event->begin_time, $ticket->price, $request, $event->name, $event->session);
            return $cartItem;
        }


        public function findDance($id, $amount, $ticket_type){
            if (strpos($ticket_type, 'dance_ticket') !== false)
            {
            $this->db->query('SELECT * FROM EVENT
            INNER JOIN danceevent ON event.id = danceevent.id
            INNER JOIN (SELECT * FROM artist as a) a ON a.artist_id = danceevent.artist
            INNER JOIN (SELECT * FROM venue as v) v ON v.id = danceevent.location
            INNER JOIN (SELECT * FROM tickettype as t) t on t.id = event.id');
            $this->db->bind(':event_type', 1);
            $this->db->bind(':id', $id);
            $event = $this->db->single();
            }
            $ticket_type = $ticket_type . "_" . $id;
            if (strpos($ticket_type, 'dance_ticket') !== false)
            {
            $this->db->query('SELECT *
            FROM tickettype
            WHERE tickettype.name = :ticket_type
            ');
            $this->db->bind(':ticket_type', $ticket_type);
            }
            else if (strpos($ticket_type, 'all_access') !== false)
            {
            $this->db->query('SELECT *
            FROM tickettype
            WHERE tickettype.id = :ticket_type
            ');
            $this->db->bind(':ticket_type', $id);
            }
            $ticket = $this->db->single();
            if (strpos($ticket_type, 'dance_ticket') !== false)
            {
            $cartItem = new DanceCartItem($event->id, $event->event_type, $ticket_type, $amount, $event->date, $event->begin_time, $event->artist_name, $ticket->price, $event->venue_name, $event->address);
            //$event_id, $event_type, $ticket_type, $amount, $date, $time, $artist, $price, $venue, $address
            }
            else if (strpos($ticket_type, 'all_access') !== false)
            {
            $stringdate = "";
            {
            switch(substr($ticket->name, -3))
            {
            case 'fri':
            $stringdate = '27-07-2020';
            break;
            case 'sat':
            $stringdate = '28-07-2020';
            break;
            case 'sun';
            $stringdate = '28-07-2020';
            break;
            case 'all';
            $stringdate = '01-01-1970';
            break;
            }
            $date = DateTime::createFromFormat('d-m-Y', $stringdate);
            $time = DateTime::createFromFormat('H:i:s', '00:00:00');
            $cartItem = new DanceCartItem($id, 1, $ticket->name, $amount, $date->format('d-m-Y'), $time->format('H:i:s'), "Multiple Artist", $ticket->price, 0, 0);
            //$event_id, $event_type, $ticket_type, $amount, $date, $time, $artist, $price, $venue, $address
            }
        }
            return $cartItem;
        }

        public function findJazz(){

        }
        
        
    }
?>