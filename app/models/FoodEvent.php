<?php

class FoodEvent extends Event
{
    public $restaurant;
    public $session;

    /**
     * FoodEvent constructor.
     * @param $restaurant
     * @param $session
     */
    public function __construct($id, $date, $begin_time, $end_time, $event_type, $price, $n_tickets, $restaurant, $session)
    {
        parent::__construct($id, $date, $begin_time, $end_time, $event_type, $price, $n_tickets);
        $this->restaurant = $restaurant;
        $this->session = $session;
    }

    /**
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @return mixed
     */
    public function getSession()
    {
        return $this->session;
    }


}
?>
