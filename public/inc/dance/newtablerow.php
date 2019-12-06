<?php
if (!isset($count))
{$count = 0;}
$date = array();
$time_b = array();
$time_e = array();
$price = array();
$quantity = array();
$place = array();
$address = array();
foreach ($events as $e) //loop through each event
{
    if ($e->artist == $dance_id) //if at an event the current selected artist plays...
    {
        foreach ($venues as $v)//loop through each venue
        {
        if ($e->location == $v->id)//search for the appropriate location where the artist plays at
        {
            $place[] = $v->name;
            $address[] = $v->address;
        }    
        }
        foreach ($eventdata as $ed)
        {
        if ($ed->id == $e->id)
        {
        $date[] = $ed->date;
        $time_b[] = substr($ed->begin_time, 0, 5);
        $time_e[] = substr($ed->end_time, 0, 5);
        $price[] = $ed->price;
        $quantity[] = $ed->n_tickets;
        }
}
    }
}
?>
                                <tr>
                                    <td><?php echo $date[$count] ?></td>
                                    <td><?php echo $time_b[$count] . "-" . $time_e[$count] ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $place[$count]?></td>
                                    <td><?php echo $address[$count]?></td>
                                    <td><?php echo $quantity[$count]?></td>
                                    <td><?php echo $price[$count]?></td>
                                    <?php $count++ ?>
                                </tr>