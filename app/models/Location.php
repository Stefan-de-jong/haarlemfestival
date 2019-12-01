<?php
    class Location{
        private $id;
        private $name;
        private $description;


        public function __construct($id, $name, $description){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
        }

        // getters
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getDescription(){
            return $this->description;
        }

        // setters
        public function setName($name){
            $this->name = $name;
        }
        public function setDescription($description){
            $this->description = $description;
        }
   
    }

?>