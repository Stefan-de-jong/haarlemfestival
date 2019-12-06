<?php
class UserRepository{
    private $db;

        public function __construct(){
            $this->db = new Database;
        }

    public function login($email, $password){
        $this->db->query('SELECT * FROM user WHERE email = :email AND password = :password');
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $row = $this->db->single();
        if ($row){
            return $row;
        }else{
            return false;
        }
        
    }
}
?>