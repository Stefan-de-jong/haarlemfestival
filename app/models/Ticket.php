<?php
class Ticket
{
    public $id;
    public $event;
    public $type;
    public $price;
    public $buyer_email;

    /**
     * Ticket constructor.
     * @param $id
     * @param $event
     * @param $type
     * @param $price
     * @param $buyer_email
     */
    public function __construct($event, $type, $price)
    {
        $this->event = $event;
        $this->type = $type;
        $this->price = $price;
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
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
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
    public function getBuyerEmail()
    {
        return $this->buyer_email;
    }


}
?>