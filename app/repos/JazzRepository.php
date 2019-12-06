<?php

class JazzRepository{

    private $db;

    public function __construct()
    {
    $this->db = new Database;
    }

    public function getArtists(){ 
        $this->db->query('SELECT *
        FROM artist'
        );
       $results = $this->db->resultSet();
       return $results;
    }

    public function getEvents(){
        $this->db->query('SELECT je.location, je.artist, ev.price, ev.begin_time, ev.end_time, ev.date, ev.n_tickets
        FROM event AS ev JOIN jazzevent AS je ON ev.id = je.id'
        );
       $results = $this->db->resultSet();
       return $results;
    }

    public function getDailyEvents(){
        $this->db->query('SELECT *
        FROM jazzevent'
        );
       $results = $this->db->resultSet();
       return $results;
    }

    public function getEventData(){ 
        $this->db->query('SELECT *
        FROM event WHERE event_type = 4' //jazz is 4?
        );
        $results = $this->db->resultSet();
        return $results;
    }
}
?>