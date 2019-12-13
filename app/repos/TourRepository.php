<?php
    class TourRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findById($id){
            $this->db->query('SELECT * FROM event WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
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
                $event = new Tour($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type,  $result->price, $result->n_tickets, $result->language, $result->guide);      
                array_push($events, $event);
            }
            return $events;
        }
        
        public function save(Location $location){
            $this->db->query('INSERT INTO event (name, description) VALUES (:name, :description)');
            // Bind values
            $this->db->bind(':name', $location->getName());
            $this->db->bind(':description', $location->getDescription());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function update(Location $location){
            $this->db->query('UPDATE event SET name = :name, description = :description WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $event->getId());
            $this->db->bind(':name', $event->getName());
            $this->db->bind(':description', $event->getDescription());

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove(Customer $event){
            $this->db->query('DELETE from event WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $event->getId());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 
    }
?>