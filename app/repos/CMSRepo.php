<?php
class CMSRepo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getEvents(){
        $this->db->query('SELECT *  FROM event');
        $this->db->execute();
       $rows =  $this->db->resultSet();
       $editables  = array();
        if ($rows){
            foreach( $rows as $k=>$v){
                $f = new FormattedSnippet();
                $f->cat=10;
                $f->title=$v->name;
                $f->val=$v->price;
                $f->id=$v->id;
                array_push($editables,$f);
            }
        }
        else return false;
    }
    private function getItemName($id){
        try{
            $this->db->query('SELECT *  FROM tickettype WHERE id = :id');
            $this->db->bind(':id',$id);
            $x = $this->db->single();
            if (!isset($x->name)){
                return $id;
            }else return $x->name;
        }catch (Exception $e){
            return $id;
        }
    }
    public function getTickets(){
        $q = $this->db->query('SELECT *  FROM ticket');
        $res = $this->db->resultSet();
        foreach($res as $t){
            $t->event_id = $this->getItemName($t->event_id);
        }
        return $res;
    }
    public function Login($email,$password){
        $this->db->query('SELECT *  FROM user WHERE email = :email AND password = :password');
        $this->db->bind(':email', $email);
        $this->db->bind(':password',$password);
        if ($result = $this->db->single()) {
            return new User($result->id, $result->firstname, $result->lastname, $result->email, $result->password, $result->role);
        }
    }
    public function emailTaken($email) {
        $this->db->query('SELECT id FROM user WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($row) {
            return true;
        } else {
            return false;
        }
    }
    public function emailTakenCustomer($email) {
        $this->db->query('SELECT id FROM customer WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        if ($row) {
            return true;
        } else {
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

    public function findAll(){
        $this->db->query('SELECT * FROM user');
        return $this->db->resultSet();
    }

    public function resetPassword($em){
        $emailTaken = $this->emailTaken($em);
        if ($emailTaken) {
            $newpass = $this->randomString(6);
            new sendamail($em,"New Password","Your new password = $newpass");
            $this->db->query('UPDATE user SET password = :pass WHERE email = :em');
            $this->db->bind(':pass', $newpass);
            $this->db->bind(':em', $em);
            $this->db->execute();
        }
    }
    public function resetPasswordCustomer($em){
        $emailTakenCustomer = $this->emailTakenCustomer($em);
        if ($emailTakenCustomer) {
            $newpass = $this->randomString(6);
            new sendamail($em,"New Password","Your new password = $newpass");
            $this->db->query('UPDATE customer SET password = :pass WHERE email = :em');
            $this->db->bind(':pass',  password_hash($newpass, PASSWORD_DEFAULT));
            $this->db->bind(':em', $em);
            $this->db->execute();
        }
    }

    public function sendProfileUpdateConfirmationEmails($emails){
        foreach($emails as $email){
            try{
                new sendamail($email, "Profile Changed", "Your Haarlem Festival email has been changed from ". $emails[0] . " to " . $emails[1]);
            }catch(Exception $e){

            }
        }
    }
    public function findUsers() {
        $q = "SELECT * FROM user";
        $this->db->query($q);
        $rows = $this->db->resultSet();
        if ($rows) {
            $users = Array();
            foreach ($rows as $row) {
                $user = new User($row->id, $row->firstname, $row->lastname, $row->email, $row->password, $row->role);
                array_push($users, $user);
            }
            return $users;
        } else {
            return Array();
        }
    }
    public function findById($id) {
        $this->db->query('SELECT * FROM user WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        if ($row) {
            $user = new User($row->id, $row->firstname, $row->lastname, $row->email, $row->password, $row->role);
            return $user;
        } else {
            throw new Exception("Error getting user or user does not exist.");
        }
    }
    public function findByIdStd($id) {
        $this->db->query('SELECT * FROM user WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function deleteUser($id){
        $this->db->query('DELETE FROM user WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteCustomer($id){
        $this->db->query('DELETE FROM customer WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->execute();
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update($user) {
        $this->db->query('UPDATE user SET firstname = :fn, lastname = :ln, email= :em, role= :role WHERE id = :id');
        $this->db->bind(':fn', $user->getFirstName());
        $this->db->bind(':ln', $user->getLastName());
        $this->db->bind(':em', $user->getEmail());
        $this->db->bind(':role', $user->getRole());
        $this->db->bind(':id', $user->getId());
        if ($this->db->execute()) {
            if ($_SESSION["CMSid"]===$user->getId()){
                $this->updateSession();
            }
            return true;
        } else {
            throw new Exception("Failed updating user.");
        }
    }
    public function updateCustomer($user) {
        $this->db->query('UPDATE customer SET first_name = :fn, last_name = :ln, email= :em WHERE id = :id');
        $this->db->bind(':fn', $user->getFirstName());
        $this->db->bind(':ln', $user->getLastName());
        $this->db->bind(':em', $user->getEmail());
        $this->db->bind(':id', $user->getId());
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    private function updateSession(){
        $currentUser = $this->findById($_SESSION["CMSid"]);
        $_SESSION["CMSfn"] = $currentUser->getFirstName();
        $_SESSION["CMSln"] = $currentUser->getLastName();
        $_SESSION["CMSem"] = $currentUser->getEmail();
        $_SESSION["CMSpass"] = $currentUser->getPassword();
        $_SESSION["CMSrole"] = $currentUser->getRole();
    }
    public function save($user) {
        if ($this->emailTaken($user->getEmail())){
            return false;
        }
        $this->db->query('INSERT INTO users (firstname, lastname, email, password, role)
        VALUES (:fn, :ln, :em, :pass, :role)');
        $this->db->bind(':fn', $user->getFirstName());
        $this->db->bind(':ln', $user->getLastName());
        $this->db->bind(':em', $user->getEmail());
        $this->db->bind(':pass', md5($user->getPassword() . MD5SALT));
        $this->db->bind(':role', $user->getRole());
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function allCustomers(){
        $q = "SELECT * FROM customer";
        $this->db->query($q);
        $rows = $this->db->resultSet();
        if ($rows) {
            $users = Array();
            foreach ($rows as $row) {
                $user = new Customer($row->first_name, $row->last_name, $row->email, $row->password);
                $user->id = $row->id;
                array_push($users, $user);
            }
            return $users;
        } else {
            return Array();
        }
    }
    public function findCustomer($id){
        $this->db->query('SELECT *  FROM customer WHERE id = :id');
        $this->db->bind(':id',$id);
        $row =  $this->db->single();
        if ($row) {
            $user = Array();
                $user = new Customer($row->first_name, $row->last_name, $row->email, $row->password);
                $user->id = $row->id;
                return $user;
        }
        return false;
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