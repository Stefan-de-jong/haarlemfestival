<?php
    require_once(APPROOT."/models/Page.php");
    class PageRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findId($id){
            $this->db->query('SELECT * FROM page WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }  
        
        public function findAll(){
            $this->db->query('SELECT * FROM page');

            $results = $this->db->resultSet();

            return $results;
        }  

        public function update(Page $page){
            $this->db->query('UPDATE page SET html = :html, title = :title WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $page->id);
            $this->db->bind(':html', $page->html);
            $this->db->bind(':title', $page->title);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        

     
    }
?>