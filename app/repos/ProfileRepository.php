<?php
class ProfileRepository
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getAllFoodTickets($email)
    {
        try {
            $tickets = array();
            $this->db->query('SELECT event.id as event_id,ticket_type, ticket_price, buyer_email,event.event_type, event.date, event.begin_time, restaurant.name, foodevent.session 
                            FROM `ticket` join EVENT on ticket.event_id = EVENT.id join foodevent on foodevent.id = event.id join restaurant on restaurant.id = foodevent.restaurant
                            WHERE ticket.buyer_email = :email');
            $this->db->bind(':email', $email);
            $results = $this->db->resultSet();

            foreach ($results as $result)
            {

                //$event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $name, $session
                $ticket = new FoodTicket($result->event_id, $result->ticket_type, $result->ticket_price, $result->buyer_email, $result->event_type, $result->date, $result->begin_time, $result->name, $result->session);
                array_push($tickets, $ticket);
            }
            return $tickets;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function getAllHistoricTickets($email)
    {
        try {
            $tickets = array();
            $this->db->query('SELECT *,
                                event.id as event_id                                
                                FROM ticket 
                                join EVENT 
                                on ticket.event_id = event.id 
                                join historicevent 
                                on historicevent.id = event.id 
                                join language 
                                on language.id = historicevent.language
                                WHERE ticket.buyer_email = :email');
            $this->db->bind(':email', $email);
            $results = $this->db->resultSet();

            foreach ($results as $result)
            {
                //$event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $name, $session                
                $ticket = new HistoricTicket($result->event_id, $result->ticket_type, $result->ticket_price, $result->buyer_email, $result->event_type, $result->date, $result->begin_time, $result->language);
                array_push($tickets, $ticket);
            }
            return $tickets;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function getAllDanceTickets($email)
    {
        try {
            $tickets = array();
            $this->db->query('');
            $this->db->bind(':email', $email);
            $results = $this->db->resultSet();

            foreach ($results as $result)
            {

                //$event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $name, $session

                //array_push($tickets, $ticket);
            }
            return $tickets;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function getAllFoodFavorites($id)
    {
        try {
            $favorites= array();
            $this->db->query('SELECT * FROM customer_favourites 
                                join EVENT on customer_favourites.event_id = EVENT.id join foodevent on foodevent.id = event.id
                                JOIN restaurant on restaurant.id = foodevent.restaurant
                                WHERE customer_favourites.customer_id = :id ');
            $this->db->bind(':id', $id);
            $results = $this->db->resultSet();

            foreach ($results as $result)
            {
                //$customer_id, $event_id, $date, $begin_time, $end_time, $event_type, $rest_name, $session
                $favorite = new FoodFavorite($result->customer_id, $result->event_id, $result->date, $result->begin_time, $result->end_time, $result->event_type, $result->restaurant, $result->session, $result->name);
                array_push($favorites, $favorite);
            }
            return $favorites;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
?>