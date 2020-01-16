<?php

class FoodFavorite extends Favorite
{
    private $restaurant;
    private $session;
    private $rest_name;

    public function __construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type, $restaurant, $session, $rest_name)
    {
        parent::__construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type);
        $this->restaurant = $restaurant;
        $this->session = $session;
        $this->rest_name = $rest_name;
    }

    /**
     * @return mixed
     */
    public function getId()
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

    public function getRestName()
    {
        return  $this->rest_name;
    }
}
?>