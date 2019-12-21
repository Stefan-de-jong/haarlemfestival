<?php
class programRepository
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findAllFoodEvents()
    {
        try {
            $this->db->query('SELECT *, event.id as eventId FROM `event` 
                                JOIN foodevent on event.id = foodevent.id
                                JOIN restaurant on foodevent.restaurant = restaurant.id');
            $results = $this->db->resultSet();
            $events = array();
            foreach ($results as $result)
            {
                //$id, $date, $begin_time, $end_time, $event_type, $price, $n_tickets, $restaurant, $session
                $event = new FoodEvent($result->eventId, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->name, $result->session);
                array_push($events, $event);
            }
            return $events;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
?>