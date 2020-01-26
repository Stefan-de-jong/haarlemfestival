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


        public function deleteToken($email){
            $this->db->query('DELETE FROM password_reset WHERE resetEmail = :resetEmail');
            $this->db->bind(':resetEmail', $email);
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function saveToken($email, $selector, $hashedToken, $expires){
            $this->db->query('INSERT INTO password_reset (resetEmail, resetSelector, resetToken, resetExpires) VALUES (:resetEmail, :resetSelector, :resetToken, :resetExpires)');
            // Bind values            
            $this->db->bind(':resetEmail', $email);
            $this->db->bind(':resetSelector', $selector );
            $this->db->bind(':resetToken', $hashedToken);
            $this->db->bind(':resetExpires', $expires);
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function getToken($selector, $currentDate){
            $this->db->query('SELECT * FROM password_reset WHERE resetSelector = :resetSelector AND resetExpires >= :currentDate');
            $this->db->bind(':resetSelector', $selector);
            $this->db->bind(':currentDate', $currentDate);
            $row = $this->db->single();
            return $row;
        }     

        public function updatePassword($email, $password){
            $this->db->query('UPDATE customer SET password = :password WHERE email = :email');
            // Bind values
            $this->db->bind(':email', $email);
            $this->db->bind(':password', $password);
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }
    }
?>