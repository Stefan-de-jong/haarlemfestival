<?php
    class Styles{
        private $id;
        private $name;

        public function __construct($id, $name)
        {
            $this->id = $id;
            $this->name = $name;
        }

        //getters
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
    }
    ?>