<?php
class ProfileRepository
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getAllUsersTickets($email)
    {
        try {
            $tickets = array();
            $this->db->query('SELECT * FROM ticket JOIN event ON ticket.event_id = event.id WHERE buyer_email = :email');
            $this->db->bind(':email', $email);
            $results = $this->db->resultSet();

            foreach ($results as $result)
            {

                //$event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $name, $session
                $ticket = new Ticket($result->event_id, $result->ticket_type, $result->ticket_price, $result->buyer_email, $result->event_type, $result->date, $result->begin_time);
                array_push($tickets, $ticket);
            }
            return $tickets;
        }
        catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
?>