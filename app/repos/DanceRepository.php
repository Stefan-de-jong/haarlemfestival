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
       return $results;
    }

    public function getAllEvents(){ //gets all events
        $this->db->query('SELECT *
        FROM danceevent'
        );
       $results = $this->db->resultSet();
       return $results;
    }

    public function getEventData(){ //assuming that dance eventtype = 1, it gets all event data associated with dance events
        $this->db->query('SELECT *
        FROM event WHERE event_type = 1'
        );
        $results = $this->db->resultSet();
        return $results;
    }

    public function getVenues(){
        $this->db->query('SELECT *
        FROM venue'
        );
        $results = $this->db->resultSet();
        return $results;
    }
}
?>