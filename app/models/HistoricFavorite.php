<?php

class HistoricFavorite extends Favorite
{
    private $language;
    private $guide;

    public function __construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type, $language, $guide)
    {
        parent::__construct($customer_id, $event_id, $date, $begin_time, $end_time, $event_type);
        $this->language = $language;
        $this->guide = $guide;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function getGuide()
    {
        return $this->guide;
    }

    public function getLanguageId(){
        if($this->language == 'Nederlands'){
            return 1;
        } elseif($this->language == 'English'){
            return 2;
        } else
        return 3;
    }        
}
?>