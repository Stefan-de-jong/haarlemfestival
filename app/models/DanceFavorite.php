<?php

class DanceFavorite extends Favorite
{
    private $artist;
    private $venue;
    private $location;
    private $artist_id;

    public function __construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type, $artist, $venue, $location, $artist_id)
    {
        parent::__construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type);
        $this->artist = $artist;
        $this->venue = $venue;
        $this->location = $location;
        $this->artist_id = $artist_id;
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

    public function getArtistId()
    {
        return $this->artist_id;
    }
}
?>