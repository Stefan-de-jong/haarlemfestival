<?php

class DanceRepository{

    private $db;
    public function __construct()
    {
    $this->db = new Database;
    }

    public function getArtistVenueAmount($id){
        $this->db->query('SELECT COUNT(id) FROM venue WHERE id = :id');
        $this->db->bind(':id', $id);

        $venue_quantity = $this->db->rowCount();

        return $venue_quantity;
    }  

    
    public function getCorrectArtist($id){
       
    }  

    public function getAllArtists(){
        $this->db->query('SELECT *
        FROM artist                                
        ');

       $results = $this->db->resultSet();

        return $results;
    }
}
?>