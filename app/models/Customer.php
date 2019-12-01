<?php
    class Customer{
        private $id;
        private $firstname;
        private $lastname;
        private $email;
        private $password;

        public function __construct($firstname, $lastname, $email, $password){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
        }

        // getters
        public function getId(){
            return $this->id;
        }
        public function getFirstname(){
            return $this->firstname;
        }
        public function getLastname(){
            return $this->lastname;
        }
        public function getEmail(){
            return $this->email;
        }
        public function getPassword(){
            return $this->password;
        }    

        // setters
        public function setFirstname($firstname){
            $this->firstname = $firstname;
        }
        public function setLastname($lastname){
            $this->lastname = $lastname;
        }
    }

?>