<?php
if (!isset($count))
{$count = 0;}
$date = array(); $time_b = array(); $time_e = array(); $price = array(); $quantity = array(); $place = array(); $address = array(); $id = array();
foreach ($events as $e) //loop through each event
{
    $save = $e->getId();
    if ($e->getArtist() == $dance_id) //if at an event the current selected artist plays...
    {
        foreach ($venues as $v)//loop through each venue
        {
        if ($e->getLocation() == $v->getId())//search for the appropriate location where the artist plays at
        {
            $place[] = $v->getName();
            $address[] = $v->getAddress();
        }    
        }
        foreach ($eventdata as $ed) //select the right eventdata
        {
        if ($ed->getId() == $e->getId() && $ed->getArtistId() == $dance_id)
        {
        $date[] = $ed->getDate(); $time_b[] = substr($ed->getBeginTime(), 0, 5); $time_e[] = substr($ed->getEndTime(), 0, 5); $price[] = $ed->getPrice(); $quantity[] = $ed->getNTickets(); $id[] = $ed->getId();
        }
}
    }
}
?> 
                                <tr>
                                    <td><?php echo $date[$count]; ?></td>
                                    <td><?php echo $time_b[$count] . "-" . $time_e[$count]; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $place[$count];?></td>
                                    <td><?php echo $address[$count];?></td>
                                    <td id = <?php echo "q" . $count;?>><?php echo $quantity[$count];?></td>
                                    <td><?php echo $price[$count] . ".00";?></td>
                                    <?php $count++; ?>
                                </tr>
<script>
var srow = localStorage.getItem('row'); //get the localStorage row (made in panel_script.js)
var ids = new Array(); //make a new array
ids = srow.split(','); //get the ids stored in local storage and fill them in the new array
var count = ids.length; //get the length of the array
if (row == undefined || row.length == count) //make a new row if there is not already a row, or if the row.length is greater than the length of the localStorage row
{var row = []}                               //if we do not check for the length of the row, the localStorage row will never be reset and will keep adding values to itself
var string = '<?php echo $id[$count-1] ;?>';
var number = parseInt(string);
row.push(number);
</script>