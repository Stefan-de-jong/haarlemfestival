<?php
class HistoricTicket
{
    public $id; // In DB after sale
    public $event; // Event OBJECT
    public $ticket_type; // hist_single_ticket, hist_fam_ticket -> reference that type for price    
    public $buyer_email; // In DB after sale


    public function __construct(Tour $event, $ticketType)
    {
        $this->event = $event;
        $this->ticket_type = $ticketType;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEventId()
    {
        return $this->event->getId();
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