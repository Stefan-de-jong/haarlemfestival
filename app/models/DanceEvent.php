<?php
class DanceEvent extends Event
{
    public function __construct($id, $date, $begin_time, $end_time, $event_type, $n_tickets, $price, $artist, $artist_id, $venue, $location)
    {
        parent::__construct($id, $date, $begin_time, $end_time, $event_type, $n_tickets);
        $this->price = $price;
        $this->artist = $artist;
        $this->artist_id = $artist_id;
        $this->venue = $venue;
        $this->location = $location;
    }

public function getPrice()
{
    return $this->price;
}

public function getArtist()
{
    return $this->artist;
}

public function getArtistId()
{
    return $this->artist_id;
}

public function getVenue()
{
    return $this->venue;
}

public function getLocation()
{
    return $this->location;
}

}