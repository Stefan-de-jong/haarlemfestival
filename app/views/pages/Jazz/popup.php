<html lang=en>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/jazz.css">
</head>
<body class="centered", id="gray">
  <h1 class="titlespace">
    Ticketname
  </h1>  
  <p>choose the amount of tickets</p>
    <dropdown>
    <select>
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
    <div class="titlespace">
    </div>
    <p>Price: 00,00<p>
    <input
		type="submit"
		value="add to cart"
		class="jazzcart"
    onclick="javascript:window.close()"
    />
    <input
		type="submit"
		value="add & go to cart"
		class="jazzcart"
    onclick="window.location.href='no'"
    />
</body>
</html>