<?php
class ProgramRepository
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }
}
?>