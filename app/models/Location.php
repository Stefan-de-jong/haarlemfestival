<?php
    class Location{
        private $id;
        private $name;
        private $description;
        private $email;
        private $password;

        public function __construct($name, $description){
            $this->name = $name;
            $this->description = $description;
        }

        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getDescription(){
            return $this->description;
        }

    }

?>