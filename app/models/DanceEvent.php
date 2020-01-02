<?php
class DanceEvent extends Event
{
    public function __construct($id, $date, $begin_time, $end_time, $event_type, $n_tickets, $price)
    {
        parent::__construct($id, $date, $begin_time, $end_time, $event_type, $n_tickets);
        $this->price = $price;
    }

public function getPrice()
{
    return $this->price;
}

}