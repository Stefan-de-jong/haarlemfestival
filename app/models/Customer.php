<?php
    class Customer{
        public $id;
        public $firstname;
        public $lastname;
        public $email;
        public $password;

        public function __construct($firstname, $lastname, $email, $password){
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            $this->email = $email;
            $this->password = $password;
        }



        
    }

?>