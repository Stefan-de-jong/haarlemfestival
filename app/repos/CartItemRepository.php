<?php
    class CartItemRepository{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findHistoric($id, $amount, $ticket_type){
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

            $this->db->query('SELECT *
                                FROM tickettype
                                WHERE ticket_type = :ticket_type
                                ');
            $this->db->bind(':ticket_type', $ticket_type);
            $ticket = $this->db->single();

            $cartItem = new HistoricCartItem($event->id, $event->event_type, $ticket_type, $amount, $event->date, $event->begin_time, $event->language, $ticket->ticket_price);
            return $cartItem;
        }
        
        public function findFood(){

        }

        public function findDance(){

        }

        public function findJazz(){

        }
        
        
    }
?>