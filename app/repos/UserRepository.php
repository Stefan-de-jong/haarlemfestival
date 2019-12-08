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
            $user = new User($row->id,$row->first_name,$row->last_name,$row->email,$row->password,$row->role);
            return $user;
        }else{
            return false;
        }
    }

    public function findUsers($params){
        $parameterdefinitions = ["first_name","last_name","id"];
        $binddefeinitions = [":fn",":ln",":id"];
        $q="SELECT * FROM user WHERE ";
        $addAND=false;
        $allfalse=true;
        for ($i=0;$i<count($params);$i++){
            $p=$params[$i];
            if ($p!=null){
                $allfalse=false;
                $q.=($addAND?" AND ":"").$parameterdefinitions[$i]." = ".$binddefeinitions[$i]." ";
                $addAND=true;
            }
        }
        if ($allfalse){
            $q="SELECT * FROM user";
        }
        $this->db->query($q);
        for ($i=0;$i<count($params);$i++){
            $p=$params[$i];
            if ($p!=null){
                $this->db->bind($binddefeinitions[$i],$params[$i]);
            }
        }
        $rows = $this->db->resultSet();
        if ($rows){
            return $rows;
        }else{
            return false;
        }
    }

    public function findById($id){
        $this->db->query('SELECT * FROM user WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        if ($row){
            $user = new User($row->id,$row->first_name,$row->last_name,$row->email,$row->password,$row->role);
            return $user;
        }else{
            return false;
        }
    }
    public function updateUser($params){
       return true;
    }
}
?>