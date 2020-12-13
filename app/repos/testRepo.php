<?php
class testRepo
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getEditable($table, $idColumn){
        $action = 0;
        if ($table == 'users'){
            $action=0;
        }
        $this->db->query('select * from ' . $table);
        $res = $this->db->resultSet();
        foreach($res as $r){
            $r->action = $action;
            $r->idValue = $r->$idColumn;
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
        if (is_numeric($p['action'])) {
            $action = $p['action'];
            $updateObj->type = $this->types[$action];
            $updateObj->tableName = $this->tablenames[$action];
            $updateObj->idColumn = 'id';
            $updateObj->idValue = $p['id'];
            $columns = $this->tableData[$action];
            $updateObj->data = [];
            foreach ($columns as $column) {
                $updateObj->data[$column] = $p[$column];
            }
            return $updateObj;
        }
    }
    private $types = ['update'];
    private $tablenames = ['users'];
    private $tableData = [
        [
            'firstname',
            'lastname',
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
        }
    }
}