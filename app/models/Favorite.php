<?php
class Favorite
{
    private $customer_id;
    private $event_id;
    private $date;
    private $begin_time;
    private $end_time;
    private $event_type;

    /**
     * Favorite constructor.
     * @param $customer_id
     * @param $event_id
     * @param $date
     * @param $begin_time
     * @param $end_time
     * @param $event_type
     */
    public function __construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type)
    {
        $this->customer_id = $customer_id;
        $this->event_id = $event_id;
        $this->date = $date;
        $this->begin_time = $begin_time;
        $this->end_time = $end_time;
        $this->event_type = $event_type;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->event_id;
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

}
?>