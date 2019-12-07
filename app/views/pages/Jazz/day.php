<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="blue_bg"> 
<div class="emptyspace">
    <?php
    $day = 2;
    if(isset($_POST["thursday"])) {
        $day = "2018-07-26";
        }
            if(isset($_POST["friday"])) {
                $day =  "2018-07-27";
        }
            if(isset($_POST["saturday"])) {
                $day = "2018-07-28";
        } 
        if(isset($_POST["sunday"])) {
            $day = "2018-07-29";
            }

            $array = explode("-", $day); //kleine change
    ?>
<h1 class="title">Shows on <?php echo end($array) . "/" . prev($array); ?></h1>
<table style="width:100%" class="ticket_table">
<?php 
 
include APPROOT . '/repos/JazzRepository.php';
$repo = new JazzRepository;
$events = $repo->GetEvents();
foreach ($events as $event)
{
    if ($event->date == $day) //artist & location moeten nog van nummer naar text maar he het is een begin
    {
        echo "<tr> <td>" . $event->date . "</td> 
        <td>" . $event->artist . "</td> <td>" . $event->location . "</td> <td>" . $event->begin_time . " until " . $event->end_time . "</td> <td> " . $event->price . " </td> <td> <input type='submit' value='Buy tickets' class='ChooseTicket'/> </td> </tr>";
    }

}
?>
</table>
<p></p>
<table style="width:100%">
<tr>
    <td>   
        <?php echo "date"; ?>
    </td>
    <td>   
        <?php echo "artist"; ?>
    </td>
    <td>   
        <?php echo "location"; ?>
    </td>
    <td>   
        <?php echo "hall"; ?>
    </td>
    <td>   
        <?php echo "time"; ?>
    </td>
    <td>   
        <?php echo "price"; ?>
    </td>
    <td>   
        <input
		    type="submit"
		    value="Buy tickets"
		    class="ChooseTicket"
	    />
    </td>
</tr>
<tr>
    <td>   
        <?php echo "date"; ?>
    </td>
    <td>   
        <?php echo "artist"; ?>
    </td>
    <td>   
        <?php echo "location"; ?>
    </td>
    <td>   
        <?php echo "hall"; ?>
    </td>
    <td>   
        <?php echo "time"; ?>
    </td>
    <td>   
        <?php echo "price"; ?>
    </td>
    <td>   
        <input
		    type="submit"
		    value="Buy tickets"
		    class="ChooseTicket"
	    />
    </td>
</tr>
</table>
</div>
</div>










































































































































































































































































































































































































































































































































































































































































































































































































































