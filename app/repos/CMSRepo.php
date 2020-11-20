<?php
class CMSRepo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function Login($email,$password){
        $this->db->query('SELECT *  FROM user WHERE email = :email AND password = :password');
        $this->db->bind(':email', $email);
        $this->db->bind(':password',$password);
        if ($result = $this->db->single()) {
            return new User($result->id, $result->firstname, $result->lastname, $result->email, $result->password, $result->role);
        }
    }
    public function allUsers(){
        $this->db->query('SELECT *  FROM user');
         return $this->db->resultSet();
    }
    public function findUser($id){
        $this->db->query('SELECT *  FROM user WHERE id = :id');
        $this->db->bind(':id',$id);
        return $this->db->single();
    }
}
?>