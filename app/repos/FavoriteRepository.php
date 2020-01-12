<?php
class FavoriteRepository
{
    private $db;

    public function __construct(){
        $this->db = new Database;
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