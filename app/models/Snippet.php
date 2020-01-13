<?php
    class Snippet{
        private $id;
        private $page;
        private $name;
        private $text;

        public function __construct($id, $page, $name, $text)
        {
            $this->id = $id;
            $this->page = $page;
            $this->name = $name;
            $this->text = $text;
        }

        //getters
        public function getId(){
            return $this->id;
        }
        public function getPage(){
            return $this->page;
        }
        public function getName(){
            return $this->name;
        }
        public function getText(){
            return $this->text;
        }
    }
    ?>