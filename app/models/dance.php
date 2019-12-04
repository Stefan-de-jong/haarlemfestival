<?php
    class Dance
    {
        private $id;
        private $artist_name;
        private $artist_bio;
        private $artist_style;
        private $artist;
        private $venue_location;
        private $venue_session;
        private $venue_name;
        private $venue_address;

        public function __construct($id, $name, $bio, $style, $artist, $location, $session, $venue_name, $address)
        {
            $this->id = $id;
            $this->artist_name = $name;
            $this->artist_bio = $bio;
            $this->artist_style = $style;
            $this->artist = $artist;
            $this->venue_location = $location;
            $this->venue_session = $session;
            $this->venue_name = $venue_name;
            $this->venue_address = $address;
        }

    }
?>