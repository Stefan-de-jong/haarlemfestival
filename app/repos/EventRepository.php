<?php
    class EventRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
        
        public function updateTickets($id, $ticketType){
            if($ticketType == 'historic_fam_ticket'){
                $amount = 4;
            }
            else{
                $amount = 1;
            }            
            $this->db->query('UPDATE event SET n_tickets = n_tickets - :amount WHERE id = :id');
            // Bind values
            $this->db->bind(':id', $id);
            $this->db->bind(':amount', $amount);
            // Execute statement
            if($this->db->execute()){
                return true;
            } else {
                return false;
            }
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
    }
?>