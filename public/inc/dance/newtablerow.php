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
foreach ($_SESSION["eventdata"] as $ed)
{
$date[] = $ed->date;
$time_b[] = $ed->begin_time;
$time_e[] = $ed->end_time;
$price[] = $ed->price;
$quantity[] = $ed->n_tickets;
}
foreach ($_SESSION["events"] as $e)
{
    if ($e->artist == $id)
    {
        foreach ($_SESSION["venues"] as $v)
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
                                    <td><?php echo $time_b[$count] . " - " . $time_e[$count] ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo $place[$count]?></td>
                                    <td><?php echo $address[$count]?></td>
                                    <td><?php echo $quantity[$count]?></td>
                                    <td><?php echo $price[$count]?></td>
                                    <?php $count++ ?>
                                </tr>