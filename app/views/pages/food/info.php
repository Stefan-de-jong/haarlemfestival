<?php
require APPROOT . '/views/inc/header.php';
$events = $data['event'];
$date = "2020-07-26";
foreach($data['page'] as $page) {
  ?>
<div id="food_body">
  <div class="food_container">
    <div class="food_breadcrums"><a href="<?php echo URLROOT;?>">Home </a> >  <a href="<?php echo URLROOT;?>/food/index">Restaurant overview </a> > Info & reservate</div>
    <article>
      <img class="rest_img" src="<?php echo URLROOT.$page->url; ?>">
<?php
  echo $page->html;
}
?>



        <br>
        <button onclick="toggleReservationPanel()">Make your reservation</button>
      </section>
  </div>
</div>

<div id="food_reservate_panel" style="display: none">
  <button onclick="toggleReservationPanel()">Cancel</button>
  <br>
  <b>To reservate your ticket(s), select your session and ticket amount.</b><br><br>
    Date:
    <select>
      <option value="">Thursday 26 Juli</option>
      <option value="">Friday 27 Juli</option>
      <option value="">Saturday 28 Juli</option>
      <option value="">Sunday 29 Juli</option>
    </select>
    <br>
    Session:
    <select>
      <option value="">1</option>
      <option value="">2</option>
      <option value="">3</option>
    </select>
  <table border="2">
    <tr>
      <th>
        Session 1
      </th>
      <th>
        Session 2
      </th>
      <th>
        Session 3
      </th>
    </tr>
    <tr>
      <td>
        18:00-19:30
      </td>
      <td>
        19:30-21:00
      </td>
      <td>
        21:00-22:30
      </td>
    </tr>
    <tr>
      <td>
        Seats available: 40
      </td>
      <td>
        Seats available: 40
      </td>
      <td>
        Seats available: 40
      </td>
    </tr>
  </table>

  Regular ticket(s):
 <input type="number"><br>
  Kids ticket(s):
  <input type="number"><br>
  <br>
  Special request? (allergies, wheelchair etc.)
  <textarea></textarea>
<br>
  <button style="margin-left: 75px">Add to favorites</button>
  <button style="margin-left: 150px">Add to cart</button>
</div>


<?php require APPROOT . '/views/inc/footer.php';
?>



<script>
    createTable();

  function toggleReservationPanel()
  {
    var res_panel = document.getElementById("food_reservate_panel");

    if (res_panel.style.display === "none") {
      res_panel.style.display = "block";
      document.getElementById("food_body").style.opacity = 0.2;
      res_panel.style.opacity= 1;
    } else {
      res_panel.style.display = "none";
      document.getElementById("food_body").style.opacity = 1;
    }
  }

  function date() {
      var x = document.getElementById('date').value;
      createTable();
  }

  function createTable()
  {
      var date = document.getElementById('date').value;
      table = document.getElementById('avaibleTabel');

      switch (date) {
          case "2020-07-26":
              <?php
              for($r = 0; $r < 3; $r++)
              {
                  foreach ($events as $event)
                  {
                      if($event->date == "2020-07-26" && $event->session == ($r + 1))
                      {
                          $seats = $event->n_tickets;
                      }
                  }?>
                    table.rows[2].cells[<?php echo $r;?>].innerHTML = <?php echo $seats;?>;<?php
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
                  $seats = $event->n_tickets;
              }
          }?>
              table.rows[2].cells[<?php echo $r;?>].innerHTML = <?php echo $seats;?>;<?php
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
                  $seats = $event->n_tickets;
              }
          }?>
              table.rows[2].cells[<?php echo $r;?>].innerHTML = <?php echo $seats;?>;<?php
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
                  $seats = $event->n_tickets;
              }
          }?>
              table.rows[2].cells[<?php echo $r;?>].innerHTML = <?php echo $seats;?>;<?php
          }?>
              break;
      }
  }
</script>

