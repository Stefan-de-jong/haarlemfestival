<?php
    class Artist{
        private $id;
        private $name;
        private $bio;
        private $style;

        public function __construct($id, $name, $bio, $style)
        {
            $this->id = $id;
            $this->name = $name;
            $this->bio = $bio;
            $this->style = $style;
        }

        //getters
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getBio(){
            return $this->bio;
        }
        public function getStyle()
        {
            return $this->style;
        }
    }
    ?>