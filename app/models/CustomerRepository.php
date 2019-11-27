<?php
    class CustomerRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findId($id){
            $this->db->query('SELECT * FROM customer WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }   

        public function findAll(){ 
            $this->db->query('SELECT *
                                FROM customer                                
                                ');

            $results = $this->db->resultSet();

            return $results;
        }

        public function save(Customer $customer){
            $this->db->query('INSERT INTO customer (name, email, password) VALUES (:name, :email, :password)');
            // Bind values
            $this->db->bind(':name', $customer->name);
            $this->db->bind(':email', $customer->email);
            $this->db->bind(':password', $customer->password);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function update(Customer $customer){
            $this->db->query('UPDATE customer SET name = :name, email = :email WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $customer->id);
            $this->db->bind(':name', $customer->name);
            $this->db->bind(':email', $customer->email);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove($id){
            $this->db->query('DELETE from customer WHERE id = :id');
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