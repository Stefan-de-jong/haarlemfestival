<?php
require APPROOT . '/views/inc/header.php';
?>
<div class="program_body">
    <div class="program_container" style="height: auto">
        <br>
        <button onclick="showTable(this.value)" value="2020-07-26" style="margin-left: 27%;">Thursday 26 juli</button>
        <button onclick="showTable(this.value)" value="2020-07-27">Friday 27 juli</button>
        <button onclick="showTable(this.value)" value="2020-07-28">Saturday 28 juli</button>
        <button onclick="showTable(this.value)" value="2020-07-29">Sunday 29 juli</button>
        <br>
        <br>
        <h1 id="title">title</h1>
        <table id="programTable" style="margin-left: 75px; font-size: 10px" border="1">
            <tr>
                <th></th>
                <?php for($i = 10; $i < 25; $i++)
                    {
                        echo "<td >$i:00</td>";
                    }?>
            </tr>
            <tr>
                <th>Dance</th>
                <?php for($i = 10; $i < 25; $i++)
                {
                    echo "<td></td>";
                }?>
            </tr>
            <tr>
                <th>Food</th>
            </tr>
            <?php
                $used_res = "";
                foreach ($data['foodEvent'] as $restaurant)
                {
                    if($used_res == $restaurant->getRestaurant())
                        continue;
                    echo "<tr><td width='10%' height='30px'>".$restaurant->getRestaurant()."</td>";
                    for ($i = 10; $i < 25; $i++) {
                    echo "<td></td>";
                    }
                    echo "</tr>";
                    $used_res = $restaurant->getRestaurant();
                }
            ?>
            <tr>
                <th>Historic</th>
                <?php for($i = 10; $i < 25; $i++)
                {
                    echo "<td></td>";
                }?>
            </tr>
            <tr>
                <th>Dance</th>
                <?php for($i = 10; $i < 25; $i++)
                {
                    echo "<td></td>";
                }?>
            </tr>
        </table>
        <br>
        <script>
            /* beautify preserve:start */ // This comment is needed to leave PHP code intact inside this JS script tag (due to vs code addon beautify)

            showTable("2020-07-26");
            function showTable(date) {
                //als er op een button gedrukt wordt, word deze datum meegegeven...
                table = document.getElementById('programTable');


                title = document.getElementById("title");


                //afhankelijk van de datum wordt een event gezocht....
                switch (date) {
                    case "2020-07-26":<?php
                            //voor iedere kolom (tijden 10u tot 24u) wordt er gekeken is er een event???-> geeft de goede datum en een tijd mee
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 1";//      get($data['danceEvent'], "2020-07-26", ($i+9));   //TO DO maak getter voor event met datum en tijd en return een div met daarin data over event ->zie food
                            $historicEvent = "Historic event dag 1";// get($data['historicEvent'], "2020-07-26", ($i+9)); (als id netzoals ik bij restaurant dee, de talen doen) //TO DOmaak getter voor event met datum en tijd en return een div met daarin data over event ->zie food

                            //voor de kolom het mogelijk opgehaalde event tonen.
                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            for($id = 1; $id < 9; $id++)
                            {
                                $foodEvent = getEvent($data['foodEvent'], "2020-07-26", ($i + 9), $id);
                                //id + 2 omdat de eerste 2 rijen voor iets anders zijn
                                ?>table.rows[<?php echo $id + 2;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            }
                            ?>table.rows[11].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[12].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";
                            title.innerHTML = "Thursday 26 Juli";
                            <?php
                        }
                        ?>
                        break;
                    case "2020-07-27":<?php
                        $date = "27 Juli";
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 2";
                            $historicEvent = "Historic event dag 2";

                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            for($id = 1; $id < 9; $id++)
                            {
                                $foodEvent = getEvent($data['foodEvent'], "2020-07-27", ($i + 9), $id);
                                ?>table.rows[<?php echo $id + 2;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            }
                            ?>table.rows[11].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[12].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";
                            title.innerHTML = "Friday 27 Juli";
                            <?php
                        }
                        ?>
                        break;
                    case "2020-07-28":<?php
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 3";
                            $historicEvent = "Historic event dag 3";

                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            for($id = 1; $id < 9; $id++)
                            {
                                $foodEvent = getEvent($data['foodEvent'], "2020-07-28", ($i + 9), $id);
                                ?>table.rows[<?php echo $id + 2;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            }
                            ?>table.rows[11].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[12].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";
                            title.innerHTML = "Saturday 28 Juli";<?php
                        }
                        ?>
                        break;
                    case "2020-07-29":<?php
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 4";
                            $historicEvent = "Historic event dag 4";

                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            for($id = 1; $id < 9; $id++)
                            {
                                $foodEvent = getEvent($data['foodEvent'], "2020-07-29", ($i + 9), $id);
                                ?>table.rows[<?php echo $id + 2;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            }
                            ?>table.rows[11].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[12].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";
                            title.innerHTML = "Sunday 29 Juli";<?php
                        }
                        ?>
                        break;
                }
            }
            /* beautify preserve:end */ // This comment is needed to leave PHP code intact inside this JS script tag (due to vs code addon beautify)
        </script>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';

function getEvent($events, $date, $time, $id)
{
    //array om alle opgehaalde event in op te slaan.
    $eventToShow = "";
    foreach ($events as $event)
    {
        //kijken of er een event begint op het tijdstip
        if ($event->getDate() == $date && ($event->getBeginTime() == $time.":00:00"|| $event->getBeginTime() == $time.":30:00" ) && $event->getId() == $id)
        {
            switch ($event->getEventType())
            {
                case "1";
                    //dance make div
                    break;
                case "2";
                //kijken of hij niet op het uur begint..
                    if( $event->getBeginTime() == $time.":30:00")
                        $eventToShow = getFoodShowDiv($event, 1);
                    else
                        $eventToShow = getFoodShowDiv($event, 0);
                    break;
                case "3":
                    //historic make div
                    break;
                    case "4";
                    //not implemented
                    break;
            }
        }
    }

    return $eventToShow;
}
function getFoodShowDiv($event, $time_path)
{
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
        "<div id='rest_div' style='background-color: " . $bgColor . "; margin-left:".$margin."%; width: ".($duration * 100)."% '>Session: ".$event->getSession()."<br></div>";

    return $eventShow;
}

?>