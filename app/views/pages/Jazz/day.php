<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="blue_bg"> 
<div class="emptyspace">
<?php
    include APPROOT . '/controllers/Jazz.php';
    //$controller = new Jazz;
    $controller->loadTickets();
?>
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










































































































































































































































































































































































































































































































































































































































































































































































































































