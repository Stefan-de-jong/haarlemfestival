<?php
    class EventData{
        private $id;
        private $artist;
        private $location;
        private $session;

        public function __construct($id, $artist, $location, $session)
        {
            $this->id = $id;
            $this->artist = $artist;
            $this->location = $location;
            $this->session = $session;
        }

        //getters
        public function getId(){
            return $this->id;
        }
        public function getName(){
            return $this->name;
        }
        public function getLocation(){
            return $this->location;
        }
        public function getSession()
        {
            return $this->session;
        }
        public function getArtist()
        {
        return $this->artist;
        }
    }
    ?>