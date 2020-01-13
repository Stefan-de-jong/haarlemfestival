<?php
class FoodTicket extends Ticket
{
    private $rest_name;
    private $session;

    public function __construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $name, $session){
        parent::__construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time);
        $this->rest_name = $name;
        $this->session = $session;
    }
    public function printTicketType(){
        if($this->ticket_type == 200){
            return 'Regular ticket';
        } elseif($this->ticket_type == 201){
            return 'Kids ticket';
        } else
            return $this->ticket_type;
    }

    public function getRestName()
    {
        return $this->rest_name;
    }
    public function getSession()
    {
        return $this->session;
    }
    
}
?>