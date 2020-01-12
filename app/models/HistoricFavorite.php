<?php

class HistoricFavorite extends Favorite
{
    private $language;

    public function __construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type, $language)
    {
        parent::__construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type);
        $this->language = $language;
    }

    public function getLanguage()
    {
        return $this->language;
    }
}
?>