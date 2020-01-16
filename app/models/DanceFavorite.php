<?php

class DanceFavorite extends Favorite
{
    private $restaurant;
    private $session;
    private $rest_name;

    public function __construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type, $artist, $venue, $location)
    {
        parent::__construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type);
        $this->artist = $artist;
        $this->venue = $venue;
        $this->location = $location;
    }

    public function getArtist()
    {
        return $this->artist;
    }

    public function getVenue()
    {
        return $this->venue;
    }

    public function getLocation()
    {
        return  $this->location;
    }
}
?>