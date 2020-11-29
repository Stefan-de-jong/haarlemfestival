<?php
class CMSRepo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getTickets(){
        $this->db->query('SELECT *  FROM ticket');
        return $this->db->resultSet();
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
    public function getHistoricSnippets1(){
        $this->db->query('SELECT *  FROM snippets');
        $res = $this->db->resultSet();
        function myFilter($obj) {
            return $obj->snippet_page  != "haarlem_food";
        }
        return array_filter($res, 'myFilter');
    }
    public function getHistoricSnippets2(){
        $this->db->query('SELECT *  FROM tourlocation');
        return $this->db->resultSet();
    }
    public function getDanceSnippets(){
        $this->db->query('SELECT *  FROM artist');
        return $this->db->resultSet();
    }
    public function updateContent($cat,$id,$val){
        $table = "";
        $columnId = "";
        $columnVal = "";
        if ($cat==1){

        }
       else if ($cat==2){
            $table = "snippets";
            $columnId="snippet_name";
            $columnVal="snippet_text";
        }
        else if ($cat==3){
            $table = "tourlocation";
            $columnId="name";
            $columnVal="description";
        }else if ($cat == 4) {

        }
        else{
            return false;
        }
        $sql = "UPDATE {$table} SET {$columnVal} = :val WHERE {$columnId} = :id";
        $this->db->query($sql);
        $this->db->bind(':val',$val);
        $this->db->bind(':id',$id);
        try{
            $this->db->execute();
            return true;
        }catch (Exception $e){
            return false;
        }
    }
}
?>