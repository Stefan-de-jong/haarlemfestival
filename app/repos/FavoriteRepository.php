<?php
class FavoriteRepository
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }


    public function getAllHistoricFavorites($id){       
        $favorites= array();
        $this->db->query('SELECT *,
                            language.language as language
                            FROM customer_favourites 
                            JOIN event
                            ON customer_favourites.event_id = event.id 
                            JOIN historicevent
                            ON historicevent.id = event.id
                            JOIN language
                            ON language.id = historicevent.language   
                            WHERE customer_favourites.customer_id = :id ');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();

        foreach ($results as $result){            
            $favorite = new HistoricFavorite($result->customer_id, $result->event_id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->language);
            array_push($favorites, $favorite);
        }
        return $favorites;        
    }

    public function addFavorite($customer, $event)
    {
        try {
            $this->db->query('INSERT INTO `customer_favourites`(`customer_id`, `event_id`) VALUES (:customer,:event)');
            $this->db->bind(':event', $event);
            $this->db->bind(':customer', $customer);
            $this->db->execute();
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

    }
    public function deleteFavorite($customer, $event)
    {
        try {
            $this->db->query('Delete from customer_favourites where customer_id = :customer AND event_id = :event');
            $this->db->bind(':event', $event);
            $this->db->bind(':customer', $customer);
            $this->db->execute();
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}

?>