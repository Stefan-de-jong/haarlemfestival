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
    private function getHistoricSnippets1(){
        $this->db->query('SELECT *  FROM snippets');
        $res = $this->db->resultSet();
        function myFilter($obj) {
            return $obj->snippet_page  != "haarlem_food";
        }
        return array_filter($res, 'myFilter');
    }
    private function getHistoricSnippets2(){
        $this->db->query('SELECT *  FROM tourlocation');
        return $this->db->resultSet();
    }
    private function getDanceSnippets(){
        $this->db->query('SELECT *  FROM artist');
        return $this->db->resultSet();
    }
    private function getFoodSnippets1(){
        $this->db->query('SELECT *  FROM snippets');
        $res = $this->db->resultSet();
        function Filter($obj) {
            return $obj->snippet_page  == "haarlem_food";
        }
        return array_filter($res, 'Filter');
    }
    private function getFoodSnippets2(){
        $this->db->query('SELECT *  FROM restaurant');
        return $this->db->resultSet();
    }
    public function getAllSnippets(){
        try {
            $danceSnippetsRaw =   $this->getDanceSnippets();
            $historicSnippets1Raw = $this->getHistoricSnippets1();
            $historicSnippets2Raw = $this->getHistoricSnippets2();
            $foodSnippets1Raw = $this->getFoodSnippets1();
            $foodSnippets2Raw = $this->getFoodSnippets2();
            $danceSnippets = [];
            foreach( $danceSnippetsRaw as $k=>$v){
                $f = new FormattedSnippet();
                $f->cat=1;
                $f->title=$v->artist_name;
                $f->val=$v->bio;
                $f->id=$v->artist_id;
                array_push($danceSnippets,$f);
            }
            $historicSnippets1 = [];
            foreach( $historicSnippets1Raw as $k=>$v){
                $f = new FormattedSnippet();
                $f->cat=2;
                $f->title=$v->snippet_name;
                $f->val=$v->snippet_text;
                $f->id=$v->snippet_id;
                array_push($historicSnippets1,$f);
            }
            $historicSnippets2 = [];
            foreach( $historicSnippets2Raw as $k=>$v){
                $f = new FormattedSnippet();
                $f->cat=3;
                $f->title=$v->name;
                $f->val=$v->description;
                $f->id=$v->id;
                array_push($historicSnippets2,$f);
            }
            $foodSnippets1 = [];
            foreach( $foodSnippets1Raw as $k=>$v){
                $f = new FormattedSnippet();
                $f->cat=4;
                $f->title=$v->snippet_name;
                $f->val=$v->snippet_text;
                $f->id=$v->snippet_id;
                array_push($foodSnippets1,$f);
            }
            $foodSnippets2 = [];
            foreach( $foodSnippets2Raw as $k=>$v){
                $f = new FormattedSnippet();
                $f->cat=5;
                $f->title=$v->name;
                $f->val=$v->address;
                $f->id=$v->id;
                array_push($foodSnippets2,$f);
            }
            return ["dance"=>$danceSnippets,"historicMain" => $historicSnippets1,"historicRoute" => $historicSnippets2,
                "foodMain"=>$foodSnippets1, "foodRestaurants"=>$foodSnippets2];
        }catch (Exception $e){
            return [];
        }
    }
    public function updateContent($cat,$id,$val){
        $table = "";
        $columnId = "";
        $columnVal = "";
        if ($cat==1){
            $table = "artist";
            $columnId="artist_id";
            $columnVal="bio";
        }
       else if ($cat==2){
            $table = "snippets";
            $columnId="snippet_id";
            $columnVal="snippet_text";
        }
        else if ($cat==3){
            $table = "tourlocation";
            $columnId="id";
            $columnVal="description";
        }else if ($cat == 4) {
            $table = "snippets";
            $columnId="snippet_id";
            $columnVal="snippet_text";
        }
        else if ($cat == 5) {
            $table = "restaurant";
            $columnId="id";
            $columnVal="address";
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