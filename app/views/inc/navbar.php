<!-- Hier komt de Navbar die Pascal maakt -->
<link rel="stylesheet" type="text/css" href="<?php echo URLROOT; ?>/css/header.css">
<!--
<a href="<?php echo URLROOT;?>" class="btn btn-light">Home</a>
<a href="<?php echo URLROOT;?>/customers/login" class="btn btn-light">Customer Login</a>
<a href="<?php echo URLROOT;?>/pages/cms" class="btn btn-light">CMS Login</a>
<a href="<?php echo URLROOT;?>/historic" class="btn btn-light">Historic</a>
<a href="<?php echo URLROOT;?>/restaurants/index" class="btn btn-light">Food</a>
-->
<input
		type="submit"
		value="Dance"
        class="big_button"
        id="DanceBut"
        onclick="window.location.href='<?php echo URLROOT;?>/pages/dance'"
    />
    <input
		type="submit"
		value="Food"
        class="big_button"
        id="FoodBut"
        onclick="window.location.href='<?php echo URLROOT;?>/restaurants/index'"
    />
    <input
		type="submit"
		value="History"
        class="big_button"
        id="HistoryBut"
        onclick="window.location.href='<?php echo URLROOT;?>/historic'"
    />
    <input
		type="submit"
		value="Jazz"
        class="big_button"
        id="JazzBut"
        onclick="window.location.href='<?php echo URLROOT;?>/jazz/jazz'"
    />