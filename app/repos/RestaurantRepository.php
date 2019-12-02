<?php
class RestaurantRepository
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function findAllRestaurants(){
       
        
        $this->db->query('SELECT *
                                FROM restaurant                                
                                ');

        $results = $this->db->resultSet();

        
        return $results;
    }

    public function findAllRestaurantsBySpecificKitchen($kitchen)
    {

        $this->db->query('SELECT *
                                FROM restaurant 
                                WHERE kitchen1 ='.$kitchen.' OR
                                kitchen2 = '.$kitchen
                            );

        $results = $this->db->resultSet();


        return $results;
    }

    public function getRestaurantInfoPage($page_nr)
    {
        $this->db->query('SELECT *
                            FROM page
                            WHERE id ='.$page_nr);

        $results = $this->db->resultSet();


        return $results;
    }
}
?>