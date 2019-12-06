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
        $this->db->query('SELECT *
        FROM jazzevent'
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