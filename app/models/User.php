<?php
    class User{
        private $id;
        private $name;
        private $email;
        private $password;

        public function __construct($name, $email, $password){
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }
    }

?>