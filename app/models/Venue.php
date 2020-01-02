<?php
    class Venue{
        private $id;
        private $name;
        private $address;

        public function __construct($id, $name, $address)
        {
            $this->id = $id;
            $this->name = $name;
            $this->address = $address;
        }


        //getters
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getAddress(){
            return $this->address;
        }

    }
?>