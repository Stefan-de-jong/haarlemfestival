<?php
    class LocationRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findById($id){
            $this->db->query('SELECT * FROM tourlocation WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }

        public function findAll(){ 
            $this->db->query('SELECT *
                                FROM tourlocation                                
                                ');

            $results = $this->db->resultSet();
            $locations = array();
            foreach($results as $result){
                $newLocation = new Location($result->id, $result->name, $result->description);
                array_push($locations, $newLocation);
            }
            return $locations;
        }

        public function save(Location $location){
            $this->db->query('INSERT INTO tourlocation (name, description) VALUES (:name, :description)');
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
            $this->db->query('UPDATE tourlocation SET name = :name, description = :description WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $tourlocation->getId());
            $this->db->bind(':name', $tourlocation->getName());
            $this->db->bind(':description', $tourlocation->getDescription());

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove(Customer $tourlocation){
            $this->db->query('DELETE from tourlocation WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $tourlocation->getId());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 
    }
?>