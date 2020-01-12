<?php
Class FoodCartItem extends CartItem{
    private $request;
    private $rest_name;
    private $session;

    public function __construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $price, $request, $name, $session){
        parent::__construct($event_id, $event_type, $ticket_type, $amount, $date, $time, $price);
        $this->request = $request;
        $this->rest_name = $name;
        $this->session = $session;
    }

    public function getTicketType(){
        return $this->ticket_type;
    }
    public function printTicketType(){
        if($this->ticket_type == "food_regular"){
            return 'Regular ticket';
        } elseif($this->ticket_type == "food_kids"){
            return 'Kids ticket';
        } else
            return $this->ticket_type;
    }
    public function getSession()
    {
        return $this->session;
    }

    public function getRequest(){
        return $this->request;
    }
    public function getRestName()
    {
        return $this->rest_name;
    }

}
?>