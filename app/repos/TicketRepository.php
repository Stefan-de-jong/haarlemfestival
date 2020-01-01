<?php
    class TicketRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findById($id){
            
        }

        public function findByEmail($email){
            
        }

        public function findAll(){ 
           
        }
        
        public function save(Ticket $ticket){
            $this->db->query('INSERT INTO ticket (event_id, ticket_type, ticket_price, buyer_email) VALUES (:event_id, :ticket_type, :ticket_price, :buyer_email)');
            // Bind values
            $this->db->bind(':event_id', $ticket->getEventID());
            $this->db->bind(':ticket_type', $ticket->getTicketType());
            $this->db->bind(':ticket_price', $ticket->getTicketPrice());
            $this->db->bind(':buyer_email', $ticket->getBuyerEmail());            

            // Execute statement
            if($this->db->execute()){
                $ticket->setTicketId($this->db->lastInsertedId());
                return true;
            } else {
                return false;
            }
        }
    }
?>