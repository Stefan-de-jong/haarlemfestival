<?php
    require APPROOT . '/views/inc/program_functions.php';
    require APPROOT . '/views/inc/header.php';
    $dance = true;
    $food = true;
    $historic = true;
    $favorite = true;

    $fav_food = array();
    $fav_hist = array();
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
        <?php if(isLoggedIn()):?>
        <input onchange="selectChange(this)" type="checkbox" name="favorites" value="favorites"
            <?php if(!$favorite == false) echo "checked";?>>Favorites<br>
        <?php endif;?>
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
                <?php for($i = 10; $i < 25; $i++)
                {
                    echo "<td width='75px'></td>";
                }?>
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
        <div id="favoritesTable">
            <?php if(isLoggedIn()):?>
            Favorites
            <?php endif;?>
            <table id="danceFavoriteTable" border="1" style="font-size: 10px; table-layout: fixed">

            </table>
            <table id="foodFavoriteTable" border="1" style="font-size: 10px; table-layout: fixed">

            </table>
            <table id="historicFavoriteTable" border="1" style="font-size: 10px; table-layout: fixed">

            </table>
        </div>
        <br>
        <script>
            /* beautify preserve:start */ // This comment is needed to leave PHP code intact inside this JS script tag (due to vs code addon beautify)
            function createFavoriteTable(date)
            {
                var foodFavoriteTable = document.getElementById('foodFavoriteTable');
                var danceFavoriteTable = document.getElementById('danceFavoriteTable');
                var historicFavoriteTable = document.getElementById('historicFavoriteTable');

                foodFavoriteTable.innerHTML = "<tr><th width='75px' height='30px'>Food</th></tr>";
                danceFavoriteTable.innerHTML =  "<tr><th width='75px' height='30px'>Dance</th></tr>";
                historicFavoriteTable.innerHTML =  "<tr><th width='75px' height='30px'>Historic</th></tr>";

                if(date == '2020-07-23') {
                    //array: 0 = table content, 1= count of the restaurant. 2+ = al the restaurants id.
                    <?php $fav_food['day23']= fillFoodFavorite("2020-07-23", $data['foodFavorite']);?>
                    var foodTableContent = "<?php echo $fav_food['day23'][0];?>";
                    foodFavoriteTable .innerHTML += foodTableContent;
                }
                else if(date == '2020-07-24') {
                    <?php   $fav_food['day24'] = fillFoodFavorite("2020-07-24", $data['foodFavorite']);?>
                    var foodTableContent = "<?php echo $fav_food['day24'][0];?>";
                    foodFavoriteTable .innerHTML += foodTableContent;
                }
                else if(date == '2020-07-25') {
                    <?php   $fav_food['day25'] = fillFoodFavorite("2020-07-25", $data['foodFavorite']);?>
                    var foodTableContent = "<?php echo $fav_food['day25'][0];?>";
                    foodFavoriteTable .innerHTML += foodTableContent;
                }
                else if(date == '2020-07-26') {
                    <?php $fav_food['day26'] = fillFoodFavorite("2020-07-26", $data['foodFavorite']);?>
                    var foodTableContent = "<?php echo $fav_food['day26'][0];?>";
                    foodFavoriteTable .innerHTML += foodTableContent;
                }
            }
            showTable("2020-07-23");

            function showTable(date) {
                <?php if(isLoggedIn() == true):?>
                createFavoriteTable(date);
                <?php endif;?>
                //als er op een button gedrukt wordt, word deze datum meegegeven...
                var title = document.getElementById("title");
                var danceTable = document.getElementById('danceTable');
                var foodTable = document.getElementById('foodTable');
                var historicTable = document.getElementById('historicTable');
                var foodFavoriteTable  = document.getElementById('foodFavoriteTable');

               var rows = document.getElementById('foodFavoriteTable').rows.length;
                //afhankelijk van de datum wordt een event gezocht....
                switch (date) {
                    case "2020-07-23":
                        <?php $date = '2020-07-23'; ?>
                            //voor iedere kolom (tijden 10u tot 24u) wordt er gekeken is er een event???-> geeft de goede datum en een tijd mee
                        <?php for ($i = 1; $i < 16; $i++):?>
                            //dance table vullen
                            <?php $danceEvent = "dance event dag 1"; ?>//      get($data['danceEvent'], "2020-07-26", ($i+9));   //TO DO maak getter voor event met datum en tijd en return een div met daarin data over event ->zie food                            
                            danceTable.rows[0].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";

                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>";
                            <?php endfor; ?>

                            //historic table vullen                            
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>";
                            <?php endfor;?>

                            <?php for($id = 1; $id <= $fav_food['day23'][1]; $id++):?>
                                <?php $foodFavorite = getEvent($data['foodFavorite'], $date, ($i + 9),$fav_food['day23'][($id+1)]);?>
                                foodFavoriteTable.rows[<?php echo $id;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodFavorite;?>";
                            <?php endfor; ?>
                    <?php endfor; ?>
                        break;

                    case "2020-07-24":
                        <?php $date = '2020-07-24'; ?>
                        <?php for ($i = 1; $i < 16; $i++):?>

                            //dance table vullen
                            <?php $danceEvent = "dance event dag 2"; ?>//      get($data['danceEvent'], "2020-07-26", ($i+9));   //TO DO maak getter voor event met datum en tijd en return een div met daarin data over event ->zie food                            
                            danceTable.rows[0].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";

                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>";
                            <?php endfor; ?>

                            //historic table vullen
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>";
                            <?php endfor; ?>

                            <?php for($id = 1; $id <= $fav_food['day24'][1]; $id++):?>
                                <?php $foodFavorite = getEvent($data['foodFavorite'], $date, ($i + 9), $fav_food['day24'][($id+1)]);?>
                                foodFavoriteTable.rows[<?php echo $id;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodFavorite;?>";
                            <?php endfor; ?>

                        <?php endfor; ?>
                        break;

                    case "2020-07-25":
                        <?php $date = '2020-07-25'; ?>
                        <?php for ($i = 1; $i < 16; $i++):?>

                            //dance table vullen
                            <?php $danceEvent = "dance event dag 3"; ?>//      get($data['danceEvent'], "2020-07-26", ($i+9));   //TO DO maak getter voor event met datum en tijd en return een div met daarin data over event ->zie food                            
                            danceTable.rows[0].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";

                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>";
                            <?php endfor; ?>

                            //historic table vullen                            
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>";
                            <?php endfor; ?>

                            <?php for($id = 1; $id <= $fav_food['day25'][1]; $id++):?>
                                <?php $foodFavorite = getEvent($data['foodFavorite'], $date, ($i + 9), $fav_food['day25'][($id+1)]);?>
                                foodFavoriteTable.rows[<?php echo $id;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodFavorite;?>";
                            <?php endfor; ?>

                    <?php endfor; ?>
                        break;

                    case "2020-07-26":
                        <?php $date = '2020-07-26'; ?>
                        <?php for ($i = 1; $i < 16; $i++):?>

                            //dance table vullen
                            <?php $danceEvent = "dance event dag 4"; ?>//      get($data['danceEvent'], "2020-07-26", ($i+9));   //TO DO maak getter voor event met datum en tijd en return een div met daarin data over event ->zie food                            
                            danceTable.rows[0].cells[<?php echo $i;?>].innerHTML = "<?php echo $danceEvent;?>";

                            //food table vullen
                            <?php for ($id = 1; $id <= $rest_count; $id++):?>
                                <?php $foodEvent = getEvent($data['foodEvent'], $date, ($i + 9), $id); ?>
                                foodTable.rows[<?php echo ($id);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodEvent; ?>";
                            <?php endfor; ?>

                            //historic table vullen                            
                            <?php for ($langId = 1; $langId <= $language_count; $langId++):?>
                                <?php $historicEvent = getEvent($data['historicEvent'], $date, ($i + 9), $langId); ?>
                                historicTable.rows[<?php echo ($langId);?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $historicEvent; ?>";
                            <?php endfor; ?>

                            <?php for($id = 1; $id <= $fav_food['day26'][1]; $id++):?>
                                <?php $foodFavorite = getEvent($data['foodFavorite'], $date, ($i + 9), $fav_food['day26'][($id+1)]);?>
                                foodFavoriteTable.rows[<?php echo $id;?>].cells[<?php echo $i;?>].innerHTML = "<?php echo $foodFavorite;?>";
                            <?php endfor; ?>
                        <?php endfor; ?>
                        break;
                }
            }
            /* beautify preserve:end */ // This comment is needed to leave PHP code intact inside this JS script tag (due to vs code addon beautify)
        </script>
    </div>
</div>

<?php
require APPROOT . '/views/inc/footer.php';
?>