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
                $event = new Tour($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->language, $result->guide);      
                array_push($events, $event);
            }
            return $events;
        }

        public function findByDate($date){ 
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
                                AND date = :date                                                                
                                ');
            $this->db->bind(':event_type', 3);
            $this->db->bind(':date', $date);
            $results = $this->db->resultSet();
            foreach($results as $result){
                $event = new Tour($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->language, $result->guide);      
                array_push($events, $event);
            }
            return $events;
        }

        public function find($date, $time, $language){             
            $this->db->query('SELECT *
                                FROM event                                
                                JOIN historicevent
                                ON historicevent.id = event.id
                                JOIN language
                                ON language.id = historicevent.language
                                JOIN guide
                                ON guide.id = historicevent.guide
                                WHERE event_type = :event_type
                                AND date = :date
                                AND begin_time = :time
                                AND language.language = :language
                                ');
            $this->db->bind(':event_type', 3);
            $this->db->bind(':date', $date);
            $this->db->bind(':time', $time);
            $this->db->bind(':language', $language);
            $row = $this->db->single();
            $event = new Tour($row->id, $row->date, $row->begin_time, $row->end_time, $row->event_type, $row->n_tickets, $row->language, $row->guide);
            return $event;
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