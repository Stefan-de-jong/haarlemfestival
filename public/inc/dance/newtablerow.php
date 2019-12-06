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
foreach ($eventdata as $ed)
{
$date[] = $ed->date;
$time_b[] = substr($ed->begin_time, 0, 5);
$time_e[] = substr($ed->end_time, 0, 5);
$price[] = $ed->price;
$quantity[] = $ed->n_tickets;
}
foreach ($events as $e)
{
    if ($e->artist == $id)
    {
        foreach ($venues as $v)
        {
        if ($e->location = $v->id)
        {
            $place[] = $v->name;
            $address[] = $v->address;
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