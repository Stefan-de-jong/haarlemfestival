<?php
    require_once(APPROOT."/models/User.php");
    class UserRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function login($email,$pass){
            $this->db->query("SELECT * FROM user WHERE email=:email and password=:password");
            $this->db->bind(':email', $email);
            $this->db->bind(':password',$pass);
            $row = $this->db->single();
            if ($row){
            $user = new User(
                $row->id,
                $row->first_name,
                $row->last_name,
                $row->email,
                $row->password,
                $row->role
            );
            $_SESSION['activeUser'] = $user;
            }
            else{
                throw new Exception("Login Failed");
            }
        }

        public function findId($id){
            $this->db->query('SELECT * FROM user WHERE id = :id');
            $this->db->bind(':id', $id);

            $row = $this->db->single();

            return $row;
        }   

        public function findAll(){ 
            $this->db->query('SELECT *
                                FROM user                                
                                ');

            $results = $this->db->resultSet();

            return $results;
        }

        public function save(User $user){
            $this->db->query('INSERT INTO user (name, email, password) VALUES (:name, :email, :password)');
            // Bind values
            $this->db->bind(':name', $user->name);
            $this->db->bind(':email', $user->email);
            $this->db->bind(':password', $user->password);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function update(User $user){
            $this->db->query('UPDATE user SET name = :name, email = :email WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $user->id);
            $this->db->bind(':name', $user->name);
            $this->db->bind(':email', $user->email);

            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
        }

        public function remove($id){
            $this->db->query('DELETE from user WHERE id = :id');
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