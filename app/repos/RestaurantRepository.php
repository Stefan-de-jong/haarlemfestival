<?php
class RestaurantRepository
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function findAllRestaurants(){

        $restaurants = array();
        $this->db->query('SELECT * FROM `restaurant` 
                            JOIN photo
                            ON photo.id = restaurant.rest_img');

        $results = $this->db->resultSet();

        foreach ($results as $result)
        {
            $restaurant = new Restaurant($result->id, $result->name, $result->info_page, $result->kitchen1, $result->kitchen2, $result->stars, $result->price, $result->address, $result->url);
            array_push($restaurants, $restaurant);
        }

        return $restaurants;
    }

    public function findAllRestaurantsBySpecificKitchen($kitchen)
    {
        $restaurants = array();
        $this->db->query('SELECT * FROM `restaurant` 
                            JOIN photo
                            ON photo.id = restaurant.rest_img
                                WHERE kitchen1 ='.$kitchen.' OR
                                kitchen2 = '.$kitchen
                            );

        $results = $this->db->resultSet();

        foreach ($results as $result)
        {
            $restaurant = new Restaurant($result->id, $result->name, $result->info_page, $result->kitchen1, $result->kitchen2, $result->stars, $result->price, $result->address, $result->url);
            array_push($restaurants, $restaurant);
        }

        return $restaurants;
    }

    public function getRestaurantInfoPage($restaurant)
    {
        $this->db->query('select * 
                            from page
                            join restaurant
                            on page.id = restaurant.info_page
                            join photo
                            on restaurant.rest_img = photo.id
                            where restaurant.id ='. $restaurant
                            );

        $results = $this->db->resultSet();


        return $results;
    }

    public function getEventInfo($restaurant)
    {
        $this->db->query('SELECT * FROM event
                            JOIN foodevent
                            on event.id = foodevent.id
                            where foodevent.restaurant ='. $restaurant
        );

        $results = $this->db->resultSet();


        return $results;
    }

    public function getEventByInfo($date, $session, $restaurant)
    {
        $this->db->query('SELECT foodevent.id as id, event.price  as price FROM event
                            JOIN foodevent
                            on event.id = foodevent.id
                            where foodevent.restaurant ='.$restaurant.' 
                            AND event.date = "'.$date.' "
                            AND foodevent.session = '.$session
        );
        $results = $this->db->resultSet();


        return $results;
    }

}
?>