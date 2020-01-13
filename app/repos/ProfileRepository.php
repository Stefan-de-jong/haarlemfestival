<?php
class ProfileRepository
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function updateEmail($customer, $email)
    {
        //cms functionalitie
    }
}
?>