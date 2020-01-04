<?php

class DanceRepository{

    private $db;
    public function __construct()
    {
    $this->db = new Database;
    }
    
    public function getCorrectArtist($id){
       
    }  

    public function getAllArtists(){ //get the information from all the artists in the database
        $this->db->query('SELECT *
        FROM artist'
        );
       $results = $this->db->resultSet();
       $artists = array();
       foreach ($results as $result)
       {
       $artist = new Artist($result->artist_id, $result->artist_name, $result->bio, $result->style);
       array_push($artists, $artist);
       }
       return $artists;
    }

    public function getAllEvents(){ //gets all events
        $this->db->query('SELECT *
        FROM danceevent'
        );
       $results = $this->db->resultSet();
       $events = array(); 
       foreach ($results as $result)
       {
       $event = new EventData($result->id, $result->artist, $result->location, $result->session);
       array_push($events, $event);
       }
       return $events;
    }

    public function getEventData(){ //assuming that dance eventtype = 1, it gets all event data associated with dance events
        $this->db->query('SELECT * FROM EVENT
        INNER JOIN danceevent ON event.id = danceevent.id
        INNER JOIN (SELECT * FROM artist as a) a ON a.artist_id = danceevent.artist
        INNER JOIN (SELECT * FROM venue as v) v ON v.id = danceevent.location
        INNER JOIN (SELECT * FROM tickettype as t) t on t.id = event.id');
        $results = $this->db->resultSet();
        $eventdata = array();
        foreach ($results as $result)
        {
        $event = new DanceEvent($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->price, $result->artist_name, $result->artist_id, $result->venue_name, $result->address);
        array_push($eventdata, $event);    
        }
        return $eventdata;
    }

    public function getVenues(){
        $this->db->query('SELECT *
        FROM venue'
        );
        $results = $this->db->resultSet();
        $venues = array();
        foreach ($results as $result)
        {
        $venue = new Venue($result->id, $result->venue_name, $result->address);
        array_push($venues, $venue);
        }
        return $venues;
    }

    public function getStyles(){
        $this->db->query('SELECT *
        FROM style'
        );
        $results = $this->db->resultSet();
        $styles = array();
        foreach ($results as $result)
        {
        $style = new Styles($result->id, $result->name);
        array_push($styles, $style);
        }
        return $styles;
    }

    public function getAllPasses(){
        $this->db->query('SELECT *
        FROM tickettype WHERE tickettype.name LIKE "all_access%"'
        );
        $results = $this->db->resultSet();
        $passes = array();
        foreach ($results as $result)
        {
        $pass = new Pass($result->id, $result->name, $result->price);
        array_push($passes, $pass);
        }
        return $passes;
    }
} 
?>