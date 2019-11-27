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
        <div class="row" id="route">
            <div class="col">
                <ul class="list-unstyled d-flex flex-grow-1 justify-content-between" id="route-list">
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                    <li>Item 4</li>
                    <li>Item 5</li>
                    <li>Item 6</li>
                    <li>Item 7</li>
                    <li>Item 8</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
                <p class="text-justify"><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet
                    libero eros. Nunc commodo justo scelerisque arcu commodo eleifend. Pellentesque ornare felis dictum
                    ex facilisis, accumsan iaculis tellus ullamcorper. Donec
                    convallis eros a vehicula pharetra. Quisque sollicitudin neque mi, vel pulvinar urna interdum porta.
                    Pellentesque a erat tincidunt, auctor odio ullamcorper, porttitor sem. Aliquam rhoncus ac ex vel
                    ultrices. Donec in turpis risus.
                    Fusce ut libero dui.&nbsp;<br><br></p>
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img>todo: echo img url vanuit db
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img>todo: echo img url vanuit db
            </div>
        </div>
    </section>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>