<?php
    class Location{
        private $id;
        private $name;
        private $description;
        private $imageURLs; 


        public function __construct($id, $name, $description){
            $this->id = $id;
            $this->name = $name;
            $this->description = $description;
            $this->imageURLs = [
                'url1' => '',
                'url2' => ''
            ];     
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
        public function getURL1(){
            return $this->imageURLs['url1'];
        }
        public function getURL2(){
            return $this->imageURLs['url2'];
        }


        // setters
        public function setName($name){
            $this->name = $name;
        }
        public function setDescription($description){
            $this->description = $description;
        }
        public function setURL1($url1){
            $this->imageURLs['url1'] = $url1;
        }
        public function setURL2($url2){
            $this->imageURLs['url2'] = $url2;
        }
   
    }

?>