<?php
    class SnippetRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findByPage($page){
            $snippets = array();
            $this->db->query('SELECT *
                                FROM snippets
                                WHERE snippet_page = :page');
            $this->db->bind(':page', $page);
            $results = $this->db->resultSet();
            foreach ($results as $result) {
               $snippet = new Snippet($result->snippet_id, $result->snippet_page, $result->snippet_name, $result->snippet_text);
               $snippets[] = $snippet;
            }
            return $snippets;
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