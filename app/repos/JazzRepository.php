<?php

class JazzRepository{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getArtists(){ 
        $this->db->query('SELECT *
        FROM artist WHERE style = 6'
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

    public function getEventDataByDay(){ 
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
 
        $events = $this->getEventDataByDay();
        foreach ($events as $event)
        {
            if ($event->date == $date) //artist & location moeten nog 
            {
                if ($event->price == 0)
                {
                    $event->price = "free";
                }
                $table = $table . "<tr> <td>" . $event->date . "</td> 
                <td>" . $event->artistname . "</td> <td>" . $event->eventlocation . "</td> <td>" . $event->begin_time . " until " . $event->end_time . "</td> <td> " . $event->price . " </td> <td> <input type='submit' value='Buy tickets' class='ChooseTicket'/> </td> </tr>";
            }
        }
        $table = $table . "</table>";
        return $table;
            
    }

    public function getArtistsJazz()
    {
        $artists = $this->getArtists();
        $artistlist = [];
        foreach ($artists as $artist)
        {
            if ($artist->style == 6)
            {
                //$newArtist = new Artist($artist->id, $artist->name, $artist->bio, $artist->style);
                array_push($artistlist, $artist);
            }
        }

        return $artistlist;
    }

    public function getArtistNames()
    {
        $artistlist = $this->getArtistsJazz();
        $artistNameList = "";
        foreach ($artistlist as $artist)
        {
            $artistNameList = $artistNameList . "<p location.href = '" . URLROOT . "/jazz/jazztickets?artist='" . $artist->name . "'</p><br/>";
        }
        return $artistNameList;
    }


    public function GetImageJazzOne()
    {
        //echo URLROOT . "/img/jazz/JazzImage1.png"
    }
}

    
?>