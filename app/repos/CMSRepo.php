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
    public function getEditable($table, $idColumn,$customQuery = false){
        $action = 0;
        if ($table == 'user'){
            $action=0;
        }
        if ($table == 'customer'){
            $action = 1;
        }
        if ($table == 'venue'){
            $action  = 2;
        }
        if ($table == 'restaurant'){
            $action = 3;
        }
        if ($table == 'event'){
            $action = 4;
        }
        if ($customQuery){
            $this->db->query("SELECT event.id,artist_name, v.venue_name, date, begin_time,end_time FROM event
        INNER JOIN danceevent ON event.id = danceevent.id
        INNER JOIN (SELECT * FROM artist as a) a ON a.artist_id = danceevent.artist
        INNER JOIN (SELECT * FROM venue as v) v ON v.id = danceevent.location
        INNER JOIN (SELECT * FROM tickettype as t) t on t.id = event.id");
        }else {
            $this->db->query('select * from ' . $table);
        }
        $res = $this->db->resultSet();
        foreach($res as $r){
            $r->action = $action;
            $r->idValue = $r->$idColumn;
        }
        return $res;
    }
    public function process($p){
        $updateObj = $this->getData($p);
        $emailChanged = $this->checkEmailChange($updateObj);
        $this->buildQuery($updateObj);
        $success = $this->db->execute();
        if ($emailChanged != false){
            new sendamail($updateObj->data['email'],'Haarlem Festival',"Your email has been changed from {$emailChanged} to {$updateObj->data['email']}");
        }
        return $success;
    }

    private function checkEmailChange($u)
    {
        if (isset($u->data['email'])) {
            $q = "SELECT email from {$u->tableName} ";
            $q .= " WHERE " . $u->idColumn . " = :" . $u->idColumn;
            $query = $this->db->query($q);
            $this->db->bind(':' . $u->idColumn, $u->idValue);
            $email = $this->db->single()->email;
            if ($u->data['email'] !== $email) {
                return $email;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    private function getData($p){
        $updateObj = (object) [];
        if (is_numeric($p['action'])) {
            $action = $p['action'];
            $updateObj->type = $this->types[0];
            $updateObj->tableName = $this->tablenames[$action];
            $updateObj->idColumn = 'id';
            $updateObj->idValue = $p['id'];
            $columns = $this->tableData[$action];
            $updateObj->data = [];
            foreach ($columns as $column) {
                if (isset($p[$column])) {
                    $updateObj->data[$column] = $p[$column];
                }
            }
            return $updateObj;
        }
    }
    private $types = ['update'];
    private $tablenames = ['user','customer','venue','restaurant','event'];
    private $tableData = [
        [
            'firstname',
            'lastname',
            'email',
        ],
        [
            'first_name',
            'last_name',
            'email',
        ],
        [
            'venue_name',
            'address'
        ],
        [
            'name',
            'stars',
            'address'
        ],
        [
            'date',
            'begin_time',
            'end_time'
        ]
    ];
    private function buildQuery($d){
        $q = "";
        if ($d->type == 'update'){
            $q = "UPDATE {$d->tableName} SET ";
            foreach ($d->data as $col => $val) {
                $q .= $col . ' = :' . $col . ', ';
            }
            $q = substr($q, 0, -2);
            $q .= " WHERE " . $d->idColumn . " = :" .  $d->idColumn;
            $query = $this->db->query($q);
            foreach ($d->data as $col => $val) {
                $this->db->bind(':'.$col,$val);
            }
            $this->db->bind(':'.$d->idColumn,$d->idValue);
            /*var_dump($q);
            var_dump($d);*/
        }
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