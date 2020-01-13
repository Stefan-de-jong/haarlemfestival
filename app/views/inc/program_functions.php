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
                //dance make div
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
    $duration = 2.5;
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
?>