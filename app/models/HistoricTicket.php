<?php
class HistoricTicket extends Ticket
{
    private $language;

    public function __construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time, $language){
        parent::__construct($event_id, $ticket_type, $ticket_price, $buyer_email, $event_type, $date, $time);
        $this->language = $language;       
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function printTicketType(){
        if($this->ticket_type == '300'){
            return 'Single ticket';
        } elseif($this->ticket_type == '301'){
            return 'Family ticket';
        } else
        return $this->ticket_type;
    }        
    
}
?>