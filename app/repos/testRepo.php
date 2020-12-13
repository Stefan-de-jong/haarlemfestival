<?php
class testRepo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getusers(){
        $this->db->query('select * from users');
        $res = $this->db->resultSet();
        foreach($res as $r){
            $r->action = '1';
            $r->idValue = $r->id;
        }
        return $res;
    }
    public function process($p){
        $updateObj = $this->getData($p);
          $this->buildQuery($updateObj);
          return $this->db->execute();
    }

    private function getData($p){
        $updateObj = (object) [];
        if ($p['action'] === '1'){
            $updateObj->type = 'update';
            $updateObj->tableName = 'users';
            $updateObj->idColumn = 'id';
            $updateObj->idValue = $p['id'];
            $updateObj->data = [
                'firstname' => $p['firstname'],
                'lastname' => $p['lastname']
            ];
            return $updateObj;
        }
    }
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
        }
    }
}