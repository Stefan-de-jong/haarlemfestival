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
            $locations = array();
            $this->db->query('SELECT *
                                FROM tourlocation                                
                                ');
            $results = $this->db->resultSet();
            foreach($results as $result){
                $location = new Location($result->id, $result->name, $result->description);
                // add urls to object
                $this->db->query('SELECT url
                                    FROM photo
                                    JOIN linked_photo
                                    ON linked_photo.linked_id = :resultId
                                    WHERE id = photo_id                                
                                    ');
                $this->db->bind(':resultId', $result->id);
                $urls = $this->db->resultSet();
                if($this->db->rowCount() > 0){
                    $location->setURL1($urls[0]->url);
                    $location->setURL2($urls[1]->url);
                }
                array_push($locations, $location);
            }
            return $locations;
        }



        // niet nodig
        public function findComplete(){
            $this->db->query('SELECT *
                                FROM tourlocation
                                JOIN linked_photo
                                ON linked_photo.linked_id = tourlocation.id
                                JOIN photo
                                ON linked_photo.photo_id = photo.id
                            ');
            $results = $this->db->resultSet();    
            foreach($results as $result){
                $location = new Location($result->id, $result->name, $result->description);
                
            }
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