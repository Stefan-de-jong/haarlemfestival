<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 d-flex flex-grow-1 justify-content-around mx-auto" id="top-menu"><a
                class="d-inline-block align-self-center" href="<?php echo URLROOT;?>/pages/abouthaarlem">Haarlem</a><a
                class="align-self-center" href="<?php echo URLROOT;?>/pages/historic">Route</a><a
                class="align-self-center" href="<?php echo URLROOT;?>/pages/historictickets">Tickets</a></div>
    </div>
    <section>
        <h1><?php echo $data['title']?></h1>
        <div class="row">
            <div class="col align-self-center">
                <p class="text-justify">Haarlem is a city and municipality in the Netherlands. It is the capital of the
                    province of North Holland and is situated at the northern edge of the Randstad, one of the most
                    populated metropolitan areas in Europe.</p>
                <p class="text-justify">Haarlem has a rich history dating back to pre-medieval times. Haarlem became
                    wealthy with toll revenues that it collected from ships and travellers moving on the busy
                    North-South route. However, as shipping became increasingly important
                    economically, the city of Amsterdam became the main Dutch city of North Holland during the Dutch
                    Golden Age. The town of Halfweg became a suburb, and Haarlem became a quiet bedroom community, and
                    for this reason Haarlem still has
                    many of its central medieval buildings intact. Nowadays many of them are on the Dutch Heritage
                    register known as Rijksmonuments.</p>
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center d-flex justify-content-center">
                <img class="rounded img-fluid shadow-sm" src="assets/img/_DSC1661.jpg">todo: echo url vanuit db</div>
        </div>
        <div class="row">
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img
                    class="rounded img-fluid shadow-sm img-center" src="assets/img/20190921_140054.jpg">todo: echo url
                vanuit db</div>
            <div class="col align-self-center">
                <p class="text-justify">The city is located on the river Spaarne, giving it its nickname 'Spaarnestad'
                    (Spaarne city). It is situated about 20 km (12 mi) west of Amsterdam and near the coastal dunes.
                    Haarlem has been the historical centre of the tulip bulb-growing
                    district for centuries and bears its other nickname 'Bloemenstad' (flower city) for this
                    reason.<br><br></p>
                <p class="text-justify">Beer brewing has been a very important industry for Haarlem going back to the
                    15th century, when there were no fewer than 100 breweries in the city. When the town's 750th
                    anniversary was celebrated in 1995 a group of enthusiasts re-created
                    an original Haarlem beer and brewed it again. The beer is called Jopenbier, or Jopen for short,
                    named after an old type of beer barrel.</p>
            </div>
        </div>
        <div class="row">
            <div class="col align-self-center">
                <p class="text-justify">In 1658, Peter Stuyvesant, the Director-General of the Dutch colony of Nieuw
                    Nederland (New Netherland), founded the settlement of Nieuw Haarlem in the northern part of
                    Manhattan Island as an outpost of Nieuw Amsterdam (New Amsterdam)
                    at the southern tip of the island. </p>
                <p class="text-justify">After the English capture of New Netherland in 1664, the new English colonial
                    administration renamed both the colony and its principal city "New York," but left the name of
                    Haarlem more or less unchanged. The spelling changed to Harlem
                    in keeping with contemporary English usage, and the district grew (as part of the borough of
                    Manhattan) into the vibrant centre of African American culture in New York City and the United
                    States generally by the 20th century.</p>
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img
                    class="rounded img-fluid shadow-sm" src="assets/img/20190921_170857.jpg">todo: echo url vanuit db
            </div>
        </div>
    </section>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>