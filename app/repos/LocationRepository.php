<?php
    class LocationRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findById($id){
            $this->db->query('SELECT * FROM location WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }  
        
        public function findByEmail($email){
            $this->db->query('SELECT * FROM location WHERE email = :email');
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            return $row;
        }   

        public function login($email, $password){
            $row = $this->findByEmail($email);
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            } else{
                return false;
            }
        }

        public function findAll(){ 
            $this->db->query('SELECT *
                                FROM location                                
                                ');

            $results = $this->db->resultSet();

            return $results;
        }

        public function save(location $location){
            $this->db->query('INSERT INTO location (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)');
            // Bind values
            $this->db->bind(':firstname', $location->getFirstname());
            $this->db->bind(':lastname', $location->getLastname());
            $this->db->bind(':email', $location->getEmail());
            $this->db->bind(':password', $location->getPassword());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function update(location $location){
            $this->db->query('UPDATE location SET first_name = :firstname, last_name = :lastname, email = :email WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $location->getId());
            $this->db->bind(':firstname', $location->getFirstname());
            $this->db->bind(':lastname', $location->getLastname());
            $this->db->bind(':email', $location->getEmail());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove(location $location){
            $this->db->query('DELETE from location WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $location->getId());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

     
    }
?>