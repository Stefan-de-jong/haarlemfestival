<?php
require APPROOT . '/views/inc/header.php';
?>
<div class="payment_body">
    <div class="cart_container"  style="height: auto; overflow: scroll">
        <button onclick="showTable(this.value)" value="2020-07-26" style="margin-left: 220px">Thursday 26 juli</button>
        <button onclick="showTable(this.value)" value="2020-07-27">Friday 27 juli</button>
        <button onclick="showTable(this.value)" value="2020-07-28">Saturday 28 juli</button>
        <button onclick="showTable(this.value)" value="2020-07-29">Sunday 29 juli</button>
        <br>
        <table id="programTable" style="margin-left: 75px; font-size: 10px" border="1">
            <tr>
                <th ></th>
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

                <?php for($i = 10; $i < 25; $i++)
                {
                    echo "<td valign='top'></td>";
                }?>
            </tr>
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

        <script>
            function showTable(date) {
                //als er op een button gedrukt wordt, word deze datum meegegeven...
                table = document.getElementById('programTable');

                //afhankelijk van de datum wordt een event gezocht....
                switch (date) {
                    case "2020-07-26":<?php
                            //voor iedere kolom (tijden 10u tot 24u) wordt er gekeken is er een event???-> geeft de goede datum en een tijd mee
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 1";//      get($data['danceEvent'], "2020-07-26", ($i+9));   //TO DO maak getter voor event met datum en tijd en return een div met daarin data over event ->zie food
                            $foodEvent = getEvent($data['foodEvent'], "2020-07-26", ($i + 9));
                            $historicEvent = "Historic event dag 1";// get($data['historicEvent'], "2020-07-26", ($i+9));  //TO DOmaak getter voor event met datum en tijd en return een div met daarin data over event ->zie food

                            //voor de kolom het mogelijk opgehaalde event tonen.
                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            ?>table.rows[2].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            ?>table.rows[3].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[4].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";<?php
                        }
                        ?>
                        break;
                    case "2020-07-27":<?php
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 2";
                            $foodEvent = getEvent($data['foodEvent'], "2020-07-27", ($i + 9));
                            $historicEvent = "Historic event dag 2";

                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            ?>table.rows[2].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            ?>table.rows[3].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[4].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";<?php
                        }
                        ?>
                        break;
                    case "2020-07-28":<?php
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 3";
                            $foodEvent = getEvent($data['foodEvent'], "2020-07-28", ($i + 9));
                            $historicEvent = "Historic event dag 3";

                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            ?>table.rows[2].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            ?>table.rows[3].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[4].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";<?php
                        }
                        ?>
                        break;
                    case "2020-07-29":<?php
                        for ($i = 1; $i < 16; $i++)
                        {
                            $danceEvent = "dance event dag 4";
                            $foodEvent = getEvent($data['foodEvent'], "2020-07-29", ($i + 9));
                            $historicEvent = "Historic event dag 4";

                            ?>table.rows[1].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";<?php
                            ?>table.rows[2].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent;?>";<?php
                            ?>table.rows[3].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent;?>";<?php
                            ?>table.rows[4].cells[<?php echo $i;?>].innerHTML = "jazz-not inplemented";<?php
                        }
                        ?>
                        break;
                }
            }
        </script>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';

function getEvent($events, $date, $time)
{
    //array om alle opgehaalde event in op te slaan.
    $eventsToShow = array();
    foreach ($events as $event)
    {
        //kijken of er een event begint op het tijdstip
        if ($event->getDate() == $date && ($event->getBeginTime() == $time.":00:00"|| $event->getBeginTime() == $time.":30:00" ))
        {
            switch ($event->getEventType())
            {
                case "1";
                    //dance make div
                    break;
                case "2";
                    $eventToShow = getFoodShowDiv($event, "START");
                    break;
                case "3":
                    //historic make div
                    break;
                    case "4";
                    //not implemented
                    break;
            }
            array_push($eventsToShow, $eventToShow);
        }
        //kijken of er een event eindigd op het tijdstip
        if ($event->getDate() == $date && ($event->getEndTime() == $time.":00:00"|| $event->getEndTime() == $time.":30:00" ))
        {
            switch ($event->getEventType())
            {
                case "1";
                    //dance make div
                    break;
                case "2";
                    $eventToShow = getFoodShowDiv($event, "END");
                    break;
                case "3":
                    //historic make div
                    break;
                case "4";
                    //not implemented
                    break;
            }
            array_push($eventsToShow, $eventToShow);
        }
    }
    //string met divjes die event info tonen
    $returnEvents = "";
    //alle event divjes toevoegen aan de string
    foreach ($eventsToShow as $evToShow)
    {
        $returnEvents = $returnEvents.$evToShow;
    }
    return $returnEvents;
}
function getFoodShowDiv($event, $type)
{
    //base background kleur maken
    $bgColor = "white";
    //restuarant ophalen om de achtergond kleur te kunnen bepalen
    $restaurant = $event->getRestaurant();
    switch ($restaurant)
    {
        case "Restaurant Mr. & Mrs.":
            $bgColor = "orange";
            break;
        case "Ratatouille":
            $bgColor = "pink";
            break;
        case "Restaurant ML":
            $bgColor = "red";
            break;
        case "Restaurant Fris":
            $bgColor = "blue";
            break;
        case "Specktakel":
            $bgColor = "black";
            break;
        case "Grand Cafe Brinkman":
            $bgColor = "green";
            break;
        case "Urban Frenchy Bistro Toujours":
            $bgColor = "brown";
            break;
        case "The Golden Bull":
            $bgColor = "purple";
            break;
    }
    //aanmaken van de div
    $eventShow =
        "<div style='background-color: ".$bgColor."'> ".$type."<br>".$restaurant."<br> Session:".$event->getSession()."</div>";
    return $eventShow;
}

?>
