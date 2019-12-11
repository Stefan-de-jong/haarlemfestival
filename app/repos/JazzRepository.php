<?php

class JazzRepository{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getArtist(){ 
        $this->db->query('SELECT *
        FROM artist WHERE artist.'
        );
       $results = $this->db->resultSet();
       return $results;
    }

    public function getEvents(){
        $this->db->query('SELECT je.location, je.artist, ev.price, ev.begin_time, ev.end_time, ev.date, ev.n_tickets
            FROM event AS ev JOIN jazzevent AS je ON ev.id = je.id'
        );
       $results = $this->db->resultSet();
       return $results;
    }

    public function getDailyEvents(){
        $this->db->query('SELECT * FROM jazzevent');
       $results = $this->db->resultSet();
       return $results;
    }

    public function getEventData(){ 
        $this->db->query('SELECT ev.date, ev.begin_time, ev.end_time, ev.price, ev.n_tickets, ar.name AS artistname, ve.name AS eventlocation
                        FROM event AS ev 
                        LEFT JOIN jazzevent AS je ON ev.id = je.id 
                        LEFT JOIN artist AS ar ON je.artist = ar.id 
                        LEFT JOIN venue AS ve ON je.location = ve.id 
                        WHERE event_type = 4'); //jazz is 4?
        $results = $this->db->resultSet();
        return $results;
    }


    public function getEventsByDate($date)
    {
        $array = explode("-", $date);
        $table = "<h1 class='title'>Shows on " . end($array) . " / " . prev($array) . "</h1><br/><table style='width:100%' class='ticket_table'>"; 
 
        $events = $this->getEventData();
        foreach ($events as $event)
        {
            if ($event->date == $date) //artist & location moeten nog 
            {
                $table = $table . "<tr> <td>" . $event->date . "</td> 
                <td>" . $event->artistname . "</td> <td>" . $event->eventlocation . "</td> <td>" . $event->begin_time . " until " . $event->end_time . "</td> <td> " . $event->price . " </td> <td> <input type='submit' value='Buy tickets' class='ChooseTicket'/> </td> </tr>";
            }
        }
        $table = $table . "</table>";
        return $table;
            
        }
    }
?>