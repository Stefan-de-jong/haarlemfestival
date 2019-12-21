<?php
class Ticket
{
    public $id;
    public $event;
    public $type;
    public $price;
    public $buyer_email;

    public function __construct($event, $type, $price)
    {
        $this->event = $event;
        $this->type = $type;
        $this->price = $price;
    }


    public function getId()
    {
        return $this->id;
    }
    public function getEvent()
    {
        return $this->event;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getBuyerEmail()
    {
        return $this->buyer_email;
    }


}
?>