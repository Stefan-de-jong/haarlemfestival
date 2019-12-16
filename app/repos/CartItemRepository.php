<?php
    class CartItemRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findById($id, $amount, $ticket_type){
            $this->db->query('SELECT * 
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

            $this->db->query('SELECT ticket_price
                                FROM tickettype
                                WHERE ticket_type = :ticket_type
                                ');
            $this->db->bind(':ticket_type', $ticket_type);
            $price = $this->db->single();

            $cartItem = new CartItem($event->id, $event->event_type, $ticket_type, $amount, $event->date, $event->begin_time, $event->language, $price->ticket_price);
            return $cartItem;
        }

        public function findAll(){ 
            $events = array();
            $this->db->query('SELECT *
                                FROM event                                
                                JOIN historicevent
                                ON historicevent.id = event.id
                                JOIN language
                                ON language.id = historicevent.language
                                JOIN guide
                                ON guide.id = historicevent.guide
                                WHERE event_type = :event_type                                
                                ');
            $this->db->bind(':event_type', 3);
            $results = $this->db->resultSet();
            foreach($results as $result){
                $event = new CartItem($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->language, $result->guide);      
                array_push($events, $event);
            }
            return $events;
        }
        
        
    }
?>