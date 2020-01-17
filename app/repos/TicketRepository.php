<?php
    class TicketRepository {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function findById($id){
            
        }

        public function findByEmail($email){
            
        }

        public function findAll(){ 
           
        }
        
        public function save(Ticket $ticket){
            $this->db->query('INSERT INTO ticket (event_id, ticket_type, ticket_price, buyer_email) VALUES (:event_id, :ticket_type, :ticket_price, :buyer_email)');
            // Bind values
            $this->db->bind(':event_id', $ticket->getEventID());
            $this->db->bind(':ticket_type', $ticket->getTicketType());
            $this->db->bind(':ticket_price', $ticket->getTicketPrice());
            $this->db->bind(':buyer_email', $ticket->getBuyerEmail());            

            // Execute statement
            if($this->db->execute()){
                $ticket->setTicketId($this->db->lastInsertedId());
                return true;
            } else {
                return false;
            }
        }
        public function getAllFoodTickets($email)
        {
            try {
                $tickets = array();
                $this->db->query('SELECT event.id as event_id,ticket_type, ticket_price, buyer_email,event.event_type, event.date, event.begin_time, restaurant.name, foodevent.session 
                            FROM `ticket` join event on ticket.event_id = event.id join foodevent on foodevent.id = event.id join restaurant on restaurant.id = foodevent.restaurant
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
                                join event 
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
        public function getAllDanceTickets($email) //if an event has multiple artist this method will add a ticket for each of the artists playing, thus more tickets may be displayed than actually ordered
        {
            try {
                $artist_count = 0;
                $tickets = array();
                $this->db->query('SELECT * FROM ticket
                INNER JOIN event ON event.id = ticket.event_id
                INNER JOIN (SELECT * FROM danceevent as de) de ON de.id = ticket.event_id
                INNER JOIN (SELECT * FROM venue as v) v on de.location = v.id
                INNER JOIN (SELECT * FROM artist as a) a on de.artist = a.artist_id
                INNER JOIN (SELECT * FROM tickettype as t) t on t.id = ticket.event_id
                WHERE ticket.buyer_email = :email');
                $this->db->bind(':email', $email);
                $tickets = $this->db->resultSet();
                foreach ($tickets as $ticket)
                {
                                                    //$event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $price, $venue, $artist, $ticket_name
                    $ticket = new DanceTicket($ticket->event_id, $ticket->ticket_type, $ticket->ticket_price, $ticket->buyer_email, $ticket->event_type, $ticket->date, $ticket->begin_time, $ticket->ticket_price, $ticket->venue_name, $ticket->artist_name, $ticket->name);
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