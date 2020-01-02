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
        
        public function findFood($id, $amount, $ticket_type, $request){
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

            $cartItem = new FoodCartItem($event->eventId, $event->event_type, $ticket_type, $amount, $event->date, $event->begin_time, $ticket->price, $request, $event->name, $event->session);
            return $cartItem;
        }

        public function findDance($id, $amount, $ticket_type){
            $this->db->query(
                'SELECT *,
                            event.id as id                               
                            FROM event                                
                            INNER JOIN danceevent as DE
                            ON DE.id = event.id
                            INNER JOIN artist
                            ON artist.id = DE.artist                               
                            WHERE event_type = :event_type
                            AND event.id = :id');
            $this->db->bind(':event_type', 1);
            $this->db->bind(':id', $id);
            $event = $this->db->single();

            $this->db->query('SELECT *
            FROM tickettype
            WHERE tickettype.name = :ticket_type
            ');
            $ticket_type = $ticket_type . "_" . $id;
            $this->db->bind(':ticket_type', $ticket_type);
            $ticket = $this->db->single();
            $this->db->query('SELECT * FROM venue
            INNER JOIN danceevent ON danceevent.location = venue.id WHERE danceevent.id = :id'
            );
            $this->db->bind(':id', $id);
            $location = $this->db->single();
            if (strpos($ticket_type, 'dance_ticket') !== false)
            {
            $cartItem = new DanceCartItem($event->id, $event->event_type, $ticket_type, $amount, $event->date, $event->begin_time, $event->name, $ticket->price, $location->name, $location->address);
            }
            else if (strpos($ticket_type, 'all_access') !== false)
            {
            //currently I am checking for static ids but if the id changes in the system this will not work anymore so I will probably implent a way where I don't have to depend on ids later
            if ($id == 114)
            {$date = DateTime::createFromFormat('d-m-Y', '27-07-2020');}
            if ($id == 115)
            {$date = DateTime::createFromFormat('d-m-Y', '28-07-2020');}
            if ($id == 116)
            {$date = DateTime::createFromFormat('d-m-Y', '28-07-2020');}
            if ($id == 117)
            {$date = DateTime::createFromFormat('d-m-Y', '00-00-00');}
            $time = DateTime::createFromFormat('H:i:s', '00:00:00');
            $cartItem = new DanceCartItem($id, 1, $ticket_type, $amount, $date->format('d-m-Y'), $time->format('H:i:s'), "Multiple Artist", $ticket->price, 0, 0);
            }
            return $cartItem;
        }

        public function findJazz(){

        }
        
        
    }
?>