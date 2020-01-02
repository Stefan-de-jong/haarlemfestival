<?php
    class Pass{
        private $id;
        private $name;
        private $price;

        public function __construct($id, $name, $price)
        {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
        }

        //getters
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return substr($this->name, -3);
        }
        public function getPrice(){
            return $this->price;
        }
    }
    ?>