<?php
require APPROOT . '/views/inc/header.php';
$events = $data['event'];
$page = $data['page'];?>

<div id="food_body">
  <div class="food_container">
      <div class="food_errorMessage"><?php echo $data['error_message']; ?></div>
    <div class="food_breadcrums"><a href="<?php echo URLROOT;?>">Home </a> >  <a href="<?php echo URLROOT;?>/food/index">Restaurant overview </a> > Info & reservate</div>
    <article>
      <img class="rest_img" src="<?php echo URLROOT.$page->url; ?>">
        <?php echo $page->html; ?>
        <br>
        <button onclick="toggleReservationPanel()">Make your reservation</button>
      </section>
  </div>
</div>

<div id="food_reservate_panel" style="display: none">
    <button onclick="toggleReservationPanel()">Cancel</button>
    <b>To reservate your ticket(s), select your session and ticket amount.</b><br>
    <br>
    Date:
    <select id="reservateDate" style="float: right" onchange="reservateDate()">
        <option value="2020-07-23">Thursday 23 Juli</option>
        <option value="2020-07-24">Friday 24 Juli</option>
        <option value="2020-07-25">Saturday 25 Juli</option>
        <option value="2020-07-26">Sunday 26 Juli</option>
    </select>
    <br>
    <form action="<?php echo URLROOT;?>/food/reservate?restaurant=<?php echo $events[0]->getRestaurant()?>" method="post">
        <input type="hidden" name="reservateDate" id="dateText">
    Session:
    <select name ="session">
      <option value="1">1</option>
      <option value="2">2</option>
        <?php if($events[0]->getRestaurant() != 3)
        {
            echo "<option value=\"3\">3</option>";
        }?>
    </select>

    <table id="reservateTable" border="1">
        <tr>
            <th>
                Session 1
            </th>
            <th>
                Session 2
            </th>
            <?php if($events[0]->getRestaurant() != 3)
            {
              echo "      <th>
                Session 3
            </th>";
            }?>

        </tr>
        <tr>
            <td>

            </td>
            <td>

            </td>
            <?php if($events[0]->getRestaurant() != 3)
            {
                echo "<td>
                Session 3
            </td>";
            }?>
        </tr>
        <tr>
            <td>

            </td>
            <td>

            </td>
            <?php if($events[0]->getRestaurant() != 3)
            {
                echo "<td>
                Session 3
            </td>";
            }?>
        </tr>
    </table>

  Regular ticket(s):
 <input name= "regularTickets" type="number" value="0" min="0"><br>
  Kids ticket(s):
  <input name = "childTickets" type="number" value="0" min="0"><br>
  <br>
  Special request? (allergies, wheelchair etc.)
  <textarea maxlength="55" name="specialRequest"></textarea>
    <br>
        <button style="margin-left: 75px" name="favorite" <?php if(isLoggedIn() == false):?>disabled<?php endif?>>Add to favorites</button>
        <button style="float: right; margin-right: 100px" name="reservation">Add to cart</button>
    </form>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
<script>
  date();
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
      var dateText = document.getElementById('dateText');
      dateText.value = date;
      createTable('reservateTable', date);
  }

  function createTable(tableId, date)
  {
      table = document.getElementById(tableId);

      switch (date) {
          case "2020-07-23":
          <?php
          $date = "2020-07-23";
          for($r = 0; $r < 3; $r++)
          {
          foreach ($events as $event)
          {
              if($event->getDate() == $date && $event->getSession() == ($r + 1))
              {
                  $begin_time = date_create($event->getBeginTime());
                  $end_time = date_create($event->getEndTime());
                  $seats = $event->n_tickets;
              }
          }?>
              table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
              table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
          }?>
              break;
          case "2020-07-24":
          <?php
          $date = "2020-07-24";
          for($r = 0; $r < 3; $r++)
          {
          foreach ($events as $event)
          {
              if($event->getDate() == $date && $event->getSession() == ($r + 1))
              {
                  $begin_time = date_create($event->getBeginTime());
                  $end_time = date_create($event->getEndTime());
                  $seats = $event->getNTickets();
              }
          }?>
              table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
              table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
          }?>
              break;
          case "2020-07-25":
          <?php
          $date = "2020-07-25";
          for($r = 0; $r < 3; $r++)
          {
          foreach ($events as $event)
          {
              if($event->getDate() == $date && $event->getSession() == ($r + 1))
              {
                  $begin_time = date_create($event->getBeginTime());
                  $end_time = date_create($event->getEndTime());
                  $seats = $event->getNTickets();
              }
          }?>
              table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
              table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
          }?>
              break;
          case "2020-07-26":
          <?php
          $date = "2020-07-26";
          for($r = 0; $r < 3; $r++)
          {
          foreach ($events as $event)
          {
              if($event->getDate() == $date && $event->getSession() == ($r + 1))
              {
                  $begin_time = date_create($event->getBeginTime());
                  $end_time = date_create($event->getEndTime());
                  $seats = $event->getNTickets();
              }
          }?>
              table.rows[1].cells[<?php echo $r;?>].innerHTML = "<?php echo date_format($begin_time,"H:i"). "-" . date_format($end_time,"H:i");?>";
              table.rows[2].cells[<?php echo $r;?>].innerHTML = "Seats available: <?php echo $seats;?>";<?php
          }?>
              break;
      }
  }
</script>




