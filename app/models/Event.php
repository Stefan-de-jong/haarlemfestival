<?php
class Event
{
    public $id;
    public $date;
    public $begin_time;
    public $end_time;
    public $event_type;
    public $price;
    public $n_tickets;

    /**
     * Event constructor.
     * @param $id
     * @param $date
     * @param $begin_time
     * @param $end_time
     * @param $event_type
     * @param $price
     * @param $n_tickets
     */
    public function __construct($id, $date, $begin_time, $end_time, $event_type, $price, $n_tickets)
    {
        $this->id = $id;
        $this->date = $date;
        $this->begin_time = $begin_time;
        $this->end_time = $end_time;
        $this->event_type = $event_type;
        $this->price = $price;
        $this->n_tickets = $n_tickets;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getBeginTime()
    {
        return $this->begin_time;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @return mixed
     */
    public function getEventType()
    {
        return $this->event_type;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getNTickets()
    {
        return $this->n_tickets;
    }



}
?>
