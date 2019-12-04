<?php

class DanceRepository{

    public function __construct(){
    $this->db = new Database();
    }

    public function getArtistVenueAmount($id){
        $this->db->query('SELECT COUNT(id) FROM venue WHERE id = :id');
        $this->db->bind(':id', $id);

        $venue_quantity = $this->db->rowCount();

        return $venue_quantity;
    }  

    
    public function getCorrectArtist($id){
        $this->db->query('SELECT id, name, bio, style FROM artist WHERE id = :id';
        $this->db->bind(':id', $id);

        $artist_information = $this->db->resultSet();

        return $artist_information;
    }  
}
?>