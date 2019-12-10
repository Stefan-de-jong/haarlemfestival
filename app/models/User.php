<?php
    class User{
        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $password;
        public $role;

        public function __construct($id, $firstname,$lastname, $email, $password,$role){
            $this->id=$id;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }
    }

?>