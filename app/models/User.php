<?php
    class User{
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;
        private $role;

        public function __construct($id, $firstname,$lastname, $email, $password,$role){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
            $this->role = $role;
        }

        public function getFirstName(){
            return $this->firstname;
        }

        
    }

?>