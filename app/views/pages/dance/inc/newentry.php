<?php if (!isset($entry_counter)){$entry_counter = 0;} ?>
<div id=d1>
<dropdown>
    <select id=<?php echo "s" . $entry_counter?>>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
    </select>
</dropdown>
</div>
<button class="btn btn-primary" id=<?php echo "b" . $entry_counter; ?> type="button" style="position: relative;margin-left: 912px;height: 74px;" >ADD TO CART</button>
<?php if(isLoggedIn() == true){echo "<td> <i class='fa fa-star' id=" . $entry_counter . " style='font-size:24px'></i> </td>";} ?>
<?php $entry_counter++; ?>