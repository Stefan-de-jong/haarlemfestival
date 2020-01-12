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

        public function save(Snippet $snippet){
            $this->db->query('INSERT INTO snippets (snippet_page, snippet_name, snippet_text) VALUES (:page, :name, :text)');
            // Bind values
            $this->db->bind(':page', $snippet->getPage());
            $this->db->bind(':name', $snippet->getName());
            $this->db->bind(':text', $snippet->getText());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function update(Snippet $snippet){
            $this->db->query('UPDATE snippets SET snippet_page = :page, snippet_name = :name, snippet_text = :text WHERE snippet_id = :id');
            // Bind values
            $this->db->bind(':id', $snippet->getId());
            $this->db->bind(':page', $snippet->getPage());
            $this->db->bind(':name', $snippet->getName());
            $this->db->bind(':text', $snippet->getText());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove(Snippet $snippet){
            $this->db->query('DELETE from snippets WHERE snippet_id = :id');
            // Bind values
            $this->db->bind(':id', $snippet->getId());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        } 
    }
?>