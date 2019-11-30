<?php
class RestaurantRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function findAllRestaurants(){
        $this->db->query('SELECT *
                                FROM restaurant                          
                                ');

        $results = $this->db->resultSet();

        echo $results;
    }
}
?>
