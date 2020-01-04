<?php
    require APPROOT . '/views/inc/header.php';
    $dance = true;
    $food = true;
    $historic = true;
?>
<div class="program_body">
    <div class="program_container" style="height: auto">
        <br>
        <button onclick="showTable(this.value)" value="2020-07-23" style="margin-left: 325px;">Thursday 23 july</button>
        <button onclick="showTable(this.value)" value="2020-07-24">Friday 24 july</button>
        <button onclick="showTable(this.value)" value="2020-07-25">Saturday 25 july</button>
        <button onclick="showTable(this.value)" value="2020-07-26">Sunday 26 july</button><br>

        <input onchange="selectChange(this)" type="checkbox" name="dance" value="dance"
            <?php if(!$dance == false) echo "checked";?>>Dance<br>
        <input onchange="selectChange(this)" type="checkbox" name="food" value="food"
            <?php if(!$food == false) echo "checked";?>>Food<br>
        <input onchange="selectChange(this)" type="checkbox" name="historic" value="historic"
            <?php if(!$historic == false) echo "checked";?>>Historic<br>
        <input onchange="selectChange(this)" type="checkbox" name="jazz" value="jazz" checked>Jazz<br>
        <script>
            function selectChange(option) {
                if (option.checked == false) {
                    var table = document.getElementById(option.value + "Table");
                    table.style.display = "none";
                } else {
                    var table = document.getElementById(option.value + "Table");
                    table.style.display = "table";
                }
            }
        </script>
        <table border="1" style="font-size: 16px; table-layout: fixed">
            <tr>
                <th width='75px'></th>
                <?php for($i = 10; $i < 25; $i++)
                {
                    echo "<td width='75px'>$i:00</td>";
                }?>
            </tr>
        </table>
        <table id="danceTable" style="font-size: 10px" border="1">
            <tr>
                <th width='75px'>Dance</th>
                <?php 
                $used_artist = "";
                $artist_count = 0;
                $artists = array();
                foreach($data['danceEvent'] as $artist)
                {
                    if (!in_array($artist->getArtist(), $artists, true))
                    {array_push($artists, $artist->getArtist());}
                }
                $artist = $data['danceEvent'];
                for($i = 0; $i < count($artists); $i++)
                {
                    if($used_artist == $artist[$i]->getArtist())
                    continue;
                    echo "<tr><td width='75px' height='30px'>".$artist[$i]->getArtist()."</td>";
                for ($j = 10; $j < 25; $j++) {
                    echo "<td width='75px'></td>";
                }
                echo "</tr>";
                $artist_count+=1;
                $used_artist = $artist[$i]->getArtist();
            }
                ?>
            </tr>
        </table>
        <table id="foodTable" border="1" style="font-size: 10px; table-layout: fixed">
            <tr>
                <th width='75px'>Food</th>
            </tr>
            <?php
            $used_res = "";
            $rest_count = 0;
            foreach ($data['foodEvent'] as $restaurant)
            {
                if($used_res == $restaurant->getRestaurant())
                    continue;
                echo "<tr><td width='75px' height='30px'>".$restaurant->getRestaurant()."</td>";
                for ($i = 10; $i < 25; $i++) {
                    echo "<td width='75px'></td>";
                }
                echo "</tr>";
                $rest_count+=1;
                $used_res = $restaurant->getRestaurant();
            }
            ?>
        </table>
        <table id="historicTable" style="font-size: 10px" border="1">
            <tr>
                <th width='75px'>Historic</th>
            </tr>
            <?php
            $used_languages = "";
            $language_count = 0;
            foreach ($data['historicEvent'] as $historic)
            {
                if($used_languages == $historic->getLanguage())
                    continue;
                echo "<tr><td width='75px' height='30px'>".$historic->getLanguage()."</td>";
                for ($i = 10; $i < 25; $i++) {
                    echo "<td width='75px'></td>";
                }
                echo "</tr>";
                $language_count+=1;
                $used_languages = $historic->getLanguage();
            }
            ?>
        </table>
        <table id="jazzTable" style="font-size: 10px" border="1">
            <tr>
                <th width='75px'>Jazz</th>
                <?php for($i = 10; $i < 25; $i++)
                {
                    echo "<td width='75px'>Jazz not implemented</td>";
                }?>
            </tr>
        </table>
        <br>
        <script>
            /* beautify preserve:start */ // This comment is needed to leave PHP code intact inside this JS script tag (due to vs code addon beautify)

            showTable("2020-07-23");
            function showTable(date) {
                //als er op een button gedrukt wordt, word deze datum meegegeven...
                var title = document.getElementById("title");
                var danceTable = document.getElementById('danceTable');
                var foodTable = document.getElementById('foodTable');
                var historicTable = document.getElementById('historicTable');

                //afhankelijk van de datum wordt een event gezocht....
                switch (date) {
                    case "2020-07-23":
                        <?php $date = '2020-07-23'; ?>
                            //voor iedere kolom (tijden 10u tot 24u) wordt er gekeken is er een event???-> geeft de goede datum en een tijd mee
                        <?php for ($i = 1; $i < 16; $i++):?>

                            //dance heeft niks op 2020-07-23
                            <?php for ($id = 1; $id <= $artist_count; $id++):?>
                                <?php $danceEvent = "No events"; ?>
                                danceTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent; ?>"
                            <?php endfor; ?>

                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>"
                            <?php endfor; ?>

                            //historic table vullen                            
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>"
                            <?php endfor; ?>

                        <?php endfor; ?>
                        break;

                    case "2020-07-24":
                        <?php $date = '2020-07-24'; ?>
                        <?php for ($i = 1; $i < 16; $i++):?>

                            //dance table vullen
                            <?php for ($id = 1; $id <= $artist_count; $id++):?>
                                <?php $danceEvent = getEvent($data['danceEvent'], $date, ($i + 9), $id); ?>
                                danceTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent; ?>"
                            <?php endfor; ?>


                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>"
                            <?php endfor; ?>

                            //historic table vullen
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>"
                            <?php endfor; ?>

                        <?php endfor; ?>
                        break;

                    case "2020-07-25":
                        <?php $date = '2020-07-25'; ?>
                        <?php for ($i = 1; $i < 16; $i++):?>

                            <?php for ($id = 1; $id <= $artist_count; $id++):?>
                                <?php $danceEvent = getEvent($data['danceEvent'], $date, ($i + 9), $id); ?>
                                danceTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent; ?>"
                            <?php endfor; ?>

                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>"
                            <?php endfor; ?>

                            //historic table vullen                            
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>"
                            <?php endfor; ?>

                        <?php endfor; ?>
                        break;

                    case "2020-07-26":
                        <?php $date = '2020-07-26'; ?>
                        <?php for ($i = 1; $i < 16; $i++):?>

                            <?php for ($id = 1; $id <= $artist_count; $id++):?>
                                <?php $danceEvent = getEvent($data['danceEvent'], $date, ($i + 9), $id); ?>
                                danceTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent; ?>"
                            <?php endfor; ?>

                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>"
                            <?php endfor; ?>

                            //historic table vullen                            
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>"
                            <?php endfor; ?>

                        <?php endfor; ?>
                        break;
                }
            }
            /* beautify preserve:end */ // This comment is needed to leave PHP code intact inside this JS script tag (due to vs code addon beautify)
        </script>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';

function getEvent($events, $date, $time, $id){    
    $eventToShow = "";
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
                    $eventToShow = getFoodShowDiv($event, 1);
                    else
                    $eventToShow = getFoodShowDiv($event, 0);
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
if (substr($end, 3, 1) == "3") //if the 4th character is a 3 we know it's half an hour
{$duration += 0.5;} //add half an hour to the duration
$eventShow =
"<div id='rest_div' style='background-color: red; margin-left:0%; width: ".($duration * 100)."%; height: 100%; '> " . $event->getVenue() . "<br></div>";
return $eventShow;
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

?>
