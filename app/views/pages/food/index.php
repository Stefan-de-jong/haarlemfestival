<?php require APPROOT . '/views/inc/header.php'; ?>
    <div id="food_body">
    <div class="food_container">
    <div class="food_breadcrums"><a href="<?php echo URLROOT;?>">Home </a> > Restaurant overview</div>
    <article class="food_intro">
        <h2>Haarlem culinaire is al about the culiniare activity!</h2>
        <br>
        <p>
            During the festival, multiple restaurant participate to show their culinair style. Each restaurant has serveral sessions a day that are bookable. It's a great opportunity to have a nice evening and
            explore the special cuisines with your friend(s), husband, kids or familiy.
        </p>
        Filter cuisine:
        <select onchange="selectedOption(this.value)">
            <?php $kitchen = $_GET['kitchen'];?>
            <option value="0">All</option>
            <option value="1" <?php if($kitchen == 1){ echo "selected";}?>>Dutch</option>
            <option value="2"<?php if($kitchen == 2){ echo "selected";}?>>French</option>
            <option value="3"<?php if($kitchen == 3){ echo "selected";}?>>Asian</option>
            <option value="4"<?php if($kitchen == 4){ echo "selected";}?>>Argentinian</option>
            <option value="5"<?php if($kitchen == 5){ echo "selected";}?>>Fish</option>
            <option value="6"<?php if($kitchen == 6){ echo "selected";}?>>Steak</option>
        </select>

        <script>
            function selectedOption(val)
            {
                if (val == 0)
                    location.href = '<?php echo URLROOT;?>/food/index';
                else {
                    <?php $kitchen = "val";?>
                    location.href = '<?php echo URLROOT;?>/food/filter?kitchen=' +<?php echo $kitchen;?>;
                }
            }
        </script>

    </article>
    <br>
    <section class="food_grid-container">

<?php
$rest_kitchens = array("dutch", "french", "asian", "argentinian", "fish", "steak");
foreach($data['restaurants'] as $restaurant) :?>
    <div>
        <img class="rest_img_overview" src="<?php echo URLROOT.$restaurant->getRestImg(); ?>">
        <?php echo $restaurant->name;?>
        <br>
        <br>
        Stars:
        <img class="starImg" src="<?php echo URLROOT; ?>/img/food/legeSter.png">
        <?php if($restaurant->getStars() == 4){?> <img class="starImg" src="<?php echo URLROOT; ?>/img/food/ster.png">
        <?php } else { ?> <img class="starImg" src="<?php echo URLROOT; ?>/img/food/legeSter.png"><?php }?>
        <img class="starImg" src="<?php echo URLROOT; ?>/img/food/ster.png">
        <img class="starImg" src="<?php echo URLROOT; ?>/img/food/ster.png">
        <img class="starImg" src="<?php echo URLROOT; ?>/img/food/ster.png">
        <br>
        <br>
        Cuisine:
        <img class="cuisineImg" src="<?php echo URLROOT; ?>/img/food/<?php echo $rest_kitchens[($restaurant->getKitchen1()) -1 ];?>.png">
        <?php if($restaurant->kitchen2 != null){?><img class="cuisineImg" src="<?php echo URLROOT; ?>/img/food/<?php echo $rest_kitchens[($restaurant->getKitchen2()) -1 ];?>.png"> <?php }?>

        <br>
        <br>
        <br>
        <a href="<?php echo URLROOT;?>/food/info?restaurant=<?php echo $restaurant->getInfoPage()?>"  class="food_a"> More information/reservate---></a>
    </div>
<?php endforeach; ?>

    </section>
    </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>