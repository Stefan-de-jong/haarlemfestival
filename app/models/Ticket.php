<?php
class Ticket
{
    public $id; // In DB after sale
    public $eventId; 
    public $price;    
    public $buyer_email; // In DB after sale


    public function __construct($eventId)
    {
        $this->eventId = $eventId;        
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEventId()
    {
        return $this->eventId();
    }

    public function getTicketType()
    {
        return $this->ticket_type;
    }

    public function getBuyerEmail()
    {
        return $this->buyer_email;
    }


}
?>