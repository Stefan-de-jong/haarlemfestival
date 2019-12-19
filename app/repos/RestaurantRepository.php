<?php
class RestaurantRepository
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function findAllRestaurants(){
        try {
            $restaurants = array();
            $this->db->query('SELECT *, restaurant.id as rest_id FROM `restaurant` JOIN photo ON photo.id = restaurant.rest_img ');

            $results = $this->db->resultSet();

            foreach ($results as $result)
            {
                $restaurant = new Restaurant($result->rest_id, $result->name, $result->info_page, $result->kitchen1, $result->kitchen2, $result->stars, $result->price, $result->address, $result->url);
                array_push($restaurants, $restaurant);
            }
            return $restaurants;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function findRestaurantById($id)
    {
        try {
            $this->db->query('SELECT * FROM `restaurant` where id ='. $id);
            //$this->db->bind(':id', $id);
            $this->db->execute();
            if($this->db->rowCount() == 0)
                return false;
            else
                return true;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function findAllRestaurantsBySpecificKitchen($kitchen)
    {
        try {
            $restaurants = array();
            $this->db->query('SELECT *, restaurant.id as rest_id FROM `restaurant` 
                            JOIN photo
                            ON photo.id = restaurant.rest_img
                                WHERE kitchen1 =:kitchen OR
                                kitchen2 = :kitchen'
            );
            $this->db->bind(':kitchen', $kitchen);
            $results = $this->db->resultSet();

            foreach ($results as $result)
            {
                $restaurant = new Restaurant($result->rest_id, $result->name, $result->info_page, $result->kitchen1, $result->kitchen2, $result->stars, $result->price, $result->address, $result->url);
                array_push($restaurants, $restaurant);
            }
            return $restaurants;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getRestaurantInfoPage($restaurant)
    {
        try {
            $this->db->query('select * 
                            from page
                            join restaurant
                            on page.id = restaurant.info_page
                            join photo
                            on restaurant.rest_img = photo.id
                            where restaurant.id =:restaurant'
            );
            $this->db->bind(':restaurant', $restaurant);
            $result = $this->db->single();
            return $result;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getEventByRestaurant($restaurant)
    {
        try {
            $this->db->query('SELECT * FROM event
                            JOIN foodevent
                            on event.id = foodevent.id
                            where foodevent.restaurant = :restaurant'
            );
            $this->db->bind(':restaurant', $restaurant);
            $results = $this->db->resultSet();
            $events = array();
            foreach ($results as $result)
            {
                //$id, $date, $begin_time, $end_time, $event_type, $price, $n_tickets, $restaurant, $session
                $event = new FoodEvent($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->restaurant, $result->session);
                array_push($events, $event);
            }

            return $events;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getEventByInfo($date, $session, $restaurant)
    {
        try {
            $this->db->query('SELECT * FROM event
                            JOIN foodevent
                            on event.id = foodevent.id
                            where foodevent.restaurant = :restaurant 
                            AND event.date = "'.$date.' "
                            AND foodevent.session = :session'
            );
            $this->db->bind(':restaurant', $restaurant);
            $this->db->bind(':session', $session);

            $result = $this->db->single();

            $event = new FoodEvent($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->restaurant, $result->session);

            return $event;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
//--------------------------------------------CMS functions-----------------------------------------------------------------------------
// test user---->$test = new Restaurant(9,"name", 1,1,4,10,1,"address",1);

    public function updateRestaurant(Restaurant $restaurant)
    {
        try {
            $this->db->query('UPDATE `restaurant` 
                            SET `name`="' . $restaurant->getName() . '",
                            `kitchen1`=' . $restaurant->getKitchen1() . ',
                            `kitchen2`=' . $restaurant->getKitchen2() . ',
                            `stars`=' . $restaurant->getStars() . ',
                            `price`=' . $restaurant->getPrice() . ',
                            `address`="' . $restaurant->getAddress() . '",
                            `info_page`=' . $restaurant->getInfoPage() . ',
                            `rest_img`= ' . $restaurant->getRestImg() . '
                            WHERE id = ' . $restaurant->getId()
            );
            $this->db->execute();
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insertRestaurant(Restaurant $restaurant)
    {
        try {
            $this->db->query('INSERT INTO restaurant (name, kitchen1, kitchen2, stars, price, address, info_page, rest_img) 
                        VALUES ("'.$restaurant->getName().'",'.$restaurant->getKitchen1().', '.$restaurant->getKitchen2().','.$restaurant->getStars().', '.$restaurant->getPrice().', "'.$restaurant->getAddress().'", '.$restaurant->getInfoPage().', '.$restaurant->getRestImg().' )');
            $this->db->execute();
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function deleteRestaurantById($id)
    {
        try {
            $this->db->query('Delete from restaurant where id = :id');
            $this->db->bind(':id', $id);
            $this->db->execute();
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
?>