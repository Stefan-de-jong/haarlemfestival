

function getEvent()
{
    var date = document.getElementById("reservateDate").value;
    var session = document.getElementById("session").value;
    var regularTickets = document.getElementById("regularTickets").value;
    var childTickets = document.getElementById("childTickets").value;
    var specialRequest = document.getElementById("specialRequest").value;

    alert("date: " + date + " session: " + session + " regulars: " + regularTickets +  " childs: " + childTickets+ " special request: " + specialRequest)
}
function toggleReservationPanel()
{
    var res_panel = document.getElementById("food_reservate_panel");

    if (res_panel.style.display === "none") {
        res_panel.style.display = "block";
        document.getElementById("food_body").style.opacity = 0.2;
        res_panel.style.opacity= 1;
        reservateDate();
    } else {
        res_panel.style.display = "none";
        document.getElementById("food_body").style.opacity = 1;
    }
}

function date() {
    var date = document.getElementById('date').value;
    createTable('avaibleTabel', date);
}

function reservateDate() {
    var date = document.getElementById('reservateDate').value;
    createTable('reservateTable', date);
}

function createTable(tableId, date)
{
    table = document.getElementById(tableId);

    switch (date ) {
        case "2020-07-26":
        <?php
            for($r = 0; $r < 3; $r++)
            {
                foreach ($events as $event)
                {
                    if($event->date == "2020-07-26" && $event->session == ($r + 1))
                    {
                        $begin_time = date_create($event->begin_time);
                        $end_time = date_create($event->end_time);
                        $seats = $event->n_tickets;
                    }
                }?>
                table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
                table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
            }?>
            break;
        case "2020-07-27":
        <?php
            for($r = 0; $r < 3; $r++)
            {
                foreach ($events as $event)
                {
                    if($event->date == "2020-07-27" && $event->session == ($r + 1))
                    {
                        $begin_time = date_create($event->begin_time);
                        $end_time = date_create($event->end_time);
                        $seats = $event->n_tickets;
                    }
                }?>
                table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
                table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
            }?>
            break;
        case "2020-07-28":
        <?php
            for($r = 0; $r < 3; $r++)
            {
                foreach ($events as $event)
                {
                    if($event->date == "2020-07-28" && $event->session == ($r + 1))
                    {
                        $begin_time = date_create($event->begin_time);
                        $end_time = date_create($event->end_time);
                        $seats = $event->n_tickets;
                    }
                }?>
                table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
                table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
            }?>
            break;
        case "2020-07-29":
        <?php
            for($r = 0; $r < 3; $r++)
            {
                foreach ($events as $event)
                {
                    if($event->date == "2020-07-29" && $event->session == ($r + 1))
                    {
                        $begin_time = date_create($event->begin_time);
                        $end_time = date_create($event->end_time);
                        $seats = $event->n_tickets;
                    }
                }?>
                table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
                table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
            }?>
            break;
    }
}

