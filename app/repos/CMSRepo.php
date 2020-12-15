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
    public function resetPassword($action,$id){
        if ($action == 'd58e3582afa99040e27b92b13c8f2280'){
            $this->resetPasswordCMSUser($id   );
        }
        if ($action == 'f4b1df7d1d45beb8f5529899393307a9'){
            $this->resetPasswordCustomer($id);
        }
    }
    private function resetPasswordCMSUser($id){
        $this->db->query('select email from user where id = :id');
        $this->db->bind(':id',$id);
        $em = $this->db->single()->email;
        $emailTaken = $this->emailTakenCMSUser($em);
        if ($emailTaken) {
            $newpass = $this->randomString(6);
            new sendamail($em,"New Password","Your new password = $newpass");
            $this->db->query('UPDATE user SET password = :pass WHERE email = :em');
            $this->db->bind(':pass', $newpass);
            $this->db->bind(':em', $em);
            $this->db->execute();
        }
    }
    private function resetPasswordCustomer($id)
    {
        $this->db->query('select email from customer where id = :id');
        $this->db->bind(':id',$id);
        $em = $this->db->single()->email;
        $emailTakenCustomer = $this->emailTakenCustomer($em);
        if ($emailTakenCustomer) {
            $newpass = $this->randomString(6);
            new sendamail($em, "New Password", "Your new password = $newpass");
            $this->db->query('UPDATE customer SET password = :pass WHERE email = :em');
            $this->db->bind(':pass', password_hash($newpass, PASSWORD_DEFAULT));
            $this->db->bind(':em', $em);
            $this->db->execute();
        }
    }
    private function emailTakenCMSUser($email) {
        $this->db->query('SELECT id FROM user WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }
    private function emailTakenCustomer($email) {
        $this->db->query('SELECT id FROM customer WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }
    public function getEditable($action){
        $meta = $this->meta[$action];
        if (isset($meta['customQuery'])){
            $this->db->query($meta['customQuery']);
        }else {
            $this->db->query('select * from ' . $meta['table']);
        }
        $res = $this->db->resultSet();
        foreach($res as $r){
            $r->action = $action;
            $idColumnString = $meta['idColumn'];
            $r->idValue = $r->$idColumnString;
            $r->readOnly = $meta['readOnly'];
            if (isset($meta['editablePasswordId'])){
                $r->editablePasswordId = $r->idValue;
            }
        }
        return $res;
    }
    public function process($post){
        if (!isset($post['action'])){
            return false;
        }
        $metaData = $this->meta[$post['action']];
        $updateObj = $this->GetData($metaData,$post);
        $emailChanged = $this->checkEmailChange($updateObj);
       if($this->buildQuery($updateObj)) {
           $success = $this->db->execute();
           if ($emailChanged != false) {
               new sendamail($updateObj->data['email'], 'Haarlem Festival', "Your email has been changed from {$emailChanged} to {$updateObj->data['email']}");
           }
           return $success;
       }else{
           return true;
       }
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

    private function GetData($meta,$post){
        $updateObj = (object) [];
            $updateObj->type = $this->types[0];
            $updateObj->tableName = $meta['table'];
            $updateObj->idColumn = $meta['idColumn'];
            $updateObj->idValue = $post['id'];
            $columns = $meta['updateAbles'];
            $updateObj->data = [];
            foreach ($columns as $column) {
                if (isset($post[$column])) {
                    $updateObj->data[$column] = $post[$column];
                }
            }
            return $updateObj;
    }
    private $types = ['update'];
    private $meta = [
        'd58e3582afa99040e27b92b13c8f2280'=>['table' => 'user', 'updateAbles' => [
                'firstname',
                'lastname',
                'email'
            ], 'readOnly' => false, 'idColumn' => 'id'
        ,'editablePasswordId'=>0],
        'f4b1df7d1d45beb8f5529899393307a9'=>['table' => 'customer', 'updateAbles' =>  [
            'first_name',
            'last_name',
            'email'
        ], 'readOnly' => false,'idColumn' => 'id','editablePasswordId'=>0],
        'd9729feb74992cc3482b350163a1a010'=>['table' => 'venue', 'updateAbles' =>  [
            'venue_name',
            'address'
        ], 'readOnly' => false,'idColumn' => 'id'],
        '6155ea87c23c52518df731aaa1f635aa'=>['table' => 'restaurant', 'updateAbles' =>  [
            'name',
            'stars',
            'address'
        ], 'readOnly' => false,'idColumn' => 'id'],
        '7cda127b9c7c0fa6430b710f04d0b08f'=>['table' => 'event', 'updateAbles' =>  [
            'date',
            'begin_time',
            'end_time'
        ], 'readOnly' => false,'idColumn' => 'id','customQuery' => "SELECT event.id,artist_name, v.venue_name, date, begin_time,end_time FROM event
        INNER JOIN danceevent ON event.id = danceevent.id
        INNER JOIN (SELECT * FROM artist as a) a ON a.artist_id = danceevent.artist
        INNER JOIN (SELECT * FROM venue as v) v ON v.id = danceevent.location
        INNER JOIN (SELECT * FROM tickettype as t) t on t.id = event.id"],
            'e0fe3095d33d3e33b253cb495ef3ba3f'=>['table' => 'ticket', 'updateAbles' =>  [

            ], 'readOnly' => true,'idColumn' => 'id','customQuery' =>
                "select ticket.id,eventtype.type,ticket_price,buyer_email from ticket,eventtype where LEFT(ticket.ticket_type,1) = eventtype.id"],
        'a1df5dde9402fb786e7efa94d6f851ca'=>['table' => 'guide', 'updateAbles' =>  [
            'name',
        ], 'readOnly' => false,'idColumn' => 'id'],

    ];
    private function buildQuery($d){
        if (count($d->data) == 0){
            return false;
        }
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
        }
        return true;
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
    private function randomString($length) {
        $chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
        $l = strlen($chars);
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[rand(0, $l - 1)];
        }
        return $str;
    }
}
?>