<?php
    class CustomerRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findById($id){
            $this->db->query('SELECT * FROM customer WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }  
        
        public function findByEmail($email){
            $this->db->query('SELECT * FROM customer WHERE email = :email');
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
                                FROM customer                                
                                ');

            $results = $this->db->resultSet();

            return $results;
        }

        public function save(Customer $customer){
            $this->db->query('INSERT INTO customer (first_name, last_name, email, password) VALUES (:firstname, :lastname, :email, :password)');
            // Bind values
            $this->db->bind(':firstname', $customer->getFirstname());
            $this->db->bind(':lastname', $customer->getLastname());
            $this->db->bind(':email', $customer->getEmail());
            $this->db->bind(':password', $customer->getPassword());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function update(Customer $customer){
            $this->db->query('UPDATE customer SET first_name = :firstname, last_name = :lastname, email = :email WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $customer->getId());
            $this->db->bind(':firstname', $customer->getFirstname());
            $this->db->bind(':lastname', $customer->getLastname());
            $this->db->bind(':email', $customer->getEmail());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove(Customer $customer){
            $this->db->query('DELETE from customer WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $customer->getId());
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

     
    }
?>