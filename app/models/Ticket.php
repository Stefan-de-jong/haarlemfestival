<?php
class Ticket
{
    public $ticket_id;
    public $event_id;
    public $ticket_type;
    public $ticket_price;
    public $buyer_email;
    public $event_type;
    public $date;
    public $time;

    public function __construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time)
    {
        $this->event_id = $event_id;
        $this->ticket_type = $ticket_type;
        $this->ticket_price = $ticket_price;
        $this->buyer_email = $buyer_email;
        $this->event_type = $event_type;
        $this->date = $date;
        $this->time = $time;
    }

    public function getTicketId()
    {
        return $this->ticket_id;
    }
    public function getEventID()
    {
        return $this->event_id;
    }
    public function getTicketType()
    {
        return $this->ticket_type;
    }          
    public function getTicketPrice()
    {
        return $this->ticket_price;
    }
    public function getBuyerEmail()
    {
        return $this->buyer_email;
    }
    public function getEventtype()
    {
        return $this->event_type;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function getTime()
    {
        return $this->time;
    }


    public function setTicketId($id)
    {
        $this->ticket_id = $id;
    }
}
?>