<?php
function fillFoodFavorite($date, $restauarnts)
{
    //array: 0 = table content, 1= count of the restaurant. 2+ = al the restaurants id.
    $used_rest = "";
    $fav_restaurant_info = array();
    $tableString = "";

    $fav_restaurant_info[0] = "";
    $fav_restaurant_info[1] = 0;


    foreach ($restauarnts as $restaurant) {
        if ($restaurant->getDate() != $date) {continue;}
        else if ($used_rest == $restaurant->getRestName()) {continue;}

        $tableString = $tableString . "<tr>";
        $tableString = $tableString . "<td >" . $restaurant->getRestName() . "</td>";
        for ($i = 1; $i < 16; $i++) {
            $tableString = $tableString . "<td width='75px'></td>";
        }
        $tableString = $tableString . "</tr>";
        $used_rest = $restaurant->getRestName();
        $fav_restaurant_info[1] += 1;
        array_push($fav_restaurant_info, $restaurant->getId());
    }
    $fav_restaurant_info[0] = $tableString;

    return $fav_restaurant_info;
}

function fillHistoricFavorites($date, $favorites){
    
}

function fillDanceFavorites($date, $artist)
{

}


function getEvent($events, $date, $time, $id){
    $eventToShow = null;
    foreach ($events as $event){
        switch ($event->getEventType()){
            case "1";
            if ($event->getDate() == $date && $event->getBeginTime() == $time && $event->getArtistId() == $id)
            {
            $eventToShow = getDanceShowDiv($event);
            }
                break;
            case "2";
                if ($event->getDate() == $date && ($event->getBeginTime() == $time.":00:00"|| $event->getBeginTime() == $time.":30:00" ) && $event->getId() == $id){
                    if( $event->getBeginTime() == $time.":30:00")
                        return getFoodShowDiv($event, 1);
                    else
                        return getFoodShowDiv($event, 0);
                }
                break;
            case "3";
                //kijken of er een event begint op het tijdstip
                if ($event->getDate() == $date && $event->getBeginTime() == $time.":00:00" && $event->getLanguageId() == $id){
                    $eventToShow = getHistShowDiv($event);
                }
                break;
            case "4";
                //dance make div
                break;
        }
    }
    return $eventToShow;
}

function getFoodShowDiv($event, $time_path){
    //base background kleur maken
    $bgColor = "white";
    $duration = 1.5;
    //restuarant ophalen om de achtergond kleur te kunnen bepalen
    $restaurant = $event->getId();
    switch ($restaurant)
    {
        case "1":
            $bgColor = "orange";
            break;
        case "2":
            $duration = 2;
            $bgColor = "hotpink";
            break;
        case "3":
            $duration = 2;
            $bgColor = "red";
            break;
        case "4":
            $bgColor = "blue";
            break;
        case "5":
            $bgColor = "black";
            break;
        case "6":
            $bgColor = "green";
            break;
        case "7":
            $bgColor = "brown";
            break;
        case "8":
            $bgColor = "purple";
            break;
    }
    //aanmaken van de div
    $margin = 0;
    if($time_path == 1)
        $margin = 50;

    $eventShow =
        "<div id='rest_div' style='background-color: " . $bgColor . "; margin-left:".$margin."%; width: ".($duration * 103)."% '>Session: ".$event->getSession()."<br></div>";

    return $eventShow;
}
function getHistShowDiv($event){
    $duration = 1.5;
    $language = $event->getLanguage();
    switch ($language){
        case "Nederlands":
            $bgColor = "orange";
            $textColor = "black";
            break;
        case "English":
            $bgColor = "blue";
            $textColor = "white";
            break;
        case "Chinese":
            $bgColor = "red";
            $textColor = "white";
            break;
    }
    $margin = 0;
    $eventShow = "<div id='rest_div' style='background-color: " . $bgColor . "; color: " . $textColor . "; margin-left:".$margin."%; width: ".($duration * 103)."% '>Guide: ".$event->getGuide()."<br></div>";
    return $eventShow;
}

function getDanceShowDiv($event){
    $id = $event->getId();
    $start = $event->getBeginTime();
    $end = $event->getEndTime();
    if (substr($start, 0, 1) != "0") //look if starting time has a leading 0, which means we only need the second digit
    {$beginhour = substr($start, 0, 2);}
    else if ((substr($start, 0, 1) == "0")) //if not we need both leading digits
    {$beginhour = substr($start, 0, 1);}
    if (substr($end, 0, 1) != "0") //do the same for ending time
    {$endhour = substr($end, 0, 2);}
    else if (substr($end, 0, 1) == "0")
    {$endhour = substr($start, 0, 1);}
    $duration = $endhour - $beginhour; //get the difference of the endhour and beginning hour
    if ($duration < 0) //in some cases, for example a show that goes past 24:00, the duration will be negative.
    {$duration = $duration + 24;} //if the duration is negative, make it positive.
    $restduration = substr($end, 3, 1); //get 4th character to decide resting time
    {$duration += ($restduration/6);} //add the rest time
    $eventShow =
    "<div id='rest_div' style='background-color: red; margin-left:0%; width: ".($duration * 100)."%; height: 100%; '> " . $event->getVenue() . "<br></div>";
    return $eventShow;
    }
?>