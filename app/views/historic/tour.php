<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 d-flex flex-grow-1 justify-content-around mx-auto" id="top-menu">
            <a class="d-inline-block align-self-center" href="<?php echo URLROOT;?>/historic/about">Haarlem</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic">Route</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic/tickets">Tickets</a></div>
    </div>
    <section>
        <h1><?php echo $data['title']?></h1>
        <div class="row">
            <div class="col">
                <p class="text-justify">Paragraph</p>
            </div>
            <div class="col-md-4">
                <h4>#HaarlemHistoric</h4>
                <p>Post your own pictures on Instagram, along with #HaarlemHistoric #HaarlemFestival and a hashtag
                    corresponding to your location, and you might win a dinner for two at one of our partner
                    restaurants!</p>
            </div>
        </div>
        <div class="row">
            <ul class="list-unstyled d-flex flex-grow-1 justify-content-between" id="tour-route">
                <?php foreach($data['locations'] as $location) : ?>
                <li class="route-location"><?php echo $location->getName(); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php foreach($data['locations'] as $location) : ?>
        <div class="row">
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
                <p class="text-justify"><?php echo $location->getDescription(); ?></p>
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img>todo: echo img url vanuit db
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img>todo: echo img url vanuit db
            </div>
        </div>
        <?php endforeach; ?>
    </section>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>