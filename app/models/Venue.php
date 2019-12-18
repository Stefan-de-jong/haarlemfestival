<?php
    class Venue{
        private $id;
        private $venue_name;
        private $address = $address;

        public function __construct($id, $venue_name, $address)
        {
            $this->id = $id;
            $this->venue_name = $venue_name;
            $this->$address = $address;
        }

    }
?>