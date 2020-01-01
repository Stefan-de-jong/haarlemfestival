<?php
    class EventRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
        
        public function updateTickets($id, $ticketType){
            if($ticketType == 'historic_single_ticket'){
                $amount = 1;
            }
            elseif($ticketType == 'historic_fam_ticket'){
                $amount = 4;
            }            
            $this->db->query('UPDATE event SET n_tickets = n_tickets - :amount WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);
            $this->db->bind(':amount', $amount);
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }     
    }
?>