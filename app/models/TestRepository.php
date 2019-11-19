<?php
    class TestRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findId($id){
            $this->db->query('SELECT * FROM test WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }   

        public function findAll(){ 
            $this->db->query('SELECT *
                                FROM test                                
                                ');

            $results = $this->db->resultSet();

            return $results;
        }

        public function save(Test $test){
            $this->db->query('INSERT INTO test (title, body) VALUES (:title, :body)');
            // Bind values
            $this->db->bind(':title', $test->title);
            $this->db->bind(':body', $test->body);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function update(Test $test){
            $this->db->query('UPDATE test SET title = :title, body = :body WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $test->id);
            $this->db->bind(':title', $test->title);
            $this->db->bind(':body', $test->body);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove($id){
            $this->db->query('DELETE from test WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

     
    }
?>