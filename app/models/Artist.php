<?php
    class Artist{
        private $id;
        private $artist_name;
        private $artist_bio;
        private $artist_style;

        public function __construct($id, $artist_name, $artist_bio, $artist_style)
        {
            $this->id = $id;
            $this->artist_name = $artist_name;
            $this->artist_bio = $artist_bio;
            $this->artist_style = $artist_style;
        }

        //getters
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->artist_name;
        }
        public function getBio(){
            return $this->artist_bio;
        }
        public function getStyle()
        {
            return $this->artist_style;
        }
    }
    ?>