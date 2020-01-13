<?php
class ProgramRepository
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function findAllFoodEvents()
    {
        try {
            $this->db->query('SELECT * FROM `event` 
                                JOIN foodevent on event.id = foodevent.id
                                JOIN restaurant on foodevent.restaurant = restaurant.id');
            $results = $this->db->resultSet();
            $events = array();
            foreach ($results as $result)
            {
                //$id, $date, $begin_time, $end_time, $event_type, $price, $n_tickets, $restaurant, $session
                $event = new FoodEvent($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->name, $result->session);
                array_push($events, $event);
            }
            return $events;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function findAllHistoricEvents(){
        $events = array();
        $this->db->query('SELECT *,
                            historicevent.id as id,
                            language.language as language,
                            guide.name as guide
                            FROM event                                
                            JOIN historicevent
                            ON historicevent.id = event.id
                            JOIN language
                            ON language.id = historicevent.language
                            JOIN guide
                            ON guide.id = historicevent.guide
                            WHERE event_type = :event_type                                
                            ');
        $this->db->bind(':event_type', 3);
        $results = $this->db->resultSet();
        foreach($results as $result){
            $event = new HistoricEvent($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->language, $result->guide);      
            array_push($events, $event);
        }
        return $events;
    }

    public function findAllDanceEvents()
    {
    $events = array();
    $this->db->query('SELECT * FROM event
    INNER JOIN danceevent ON event.id = danceevent.id
    INNER JOIN (SELECT * FROM artist as a) a ON a.artist_id = danceevent.artist
    INNER JOIN (SELECT * FROM venue as v) v ON v.id = danceevent.location
    INNER JOIN (SELECT * FROM tickettype as t) t on t.id = event.id');
    $results = $this->db->resultSet();
    foreach ($results as $result)
    {
    $event = new DanceEvent($result->id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->n_tickets, $result->price, $result->artist_name, $result->artist_id, $result->venue_name, $result->address);
    array_push($events, $event);
    }
    return $events;
    }


    
}
?>