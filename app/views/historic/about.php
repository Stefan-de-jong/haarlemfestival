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
            <div class="col align-self-center">
                <p class="text-justify"><?php foreach ($data['snippets'] as $snippet => $value) {
                    if ($value->getname() == 'about_p1')
                        echo nl2br($value->getText());
                } ?></p>
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center d-flex justify-content-center">
                <img class="rounded img-fluid shadow-sm" src="../img/historic/haarlem1.jpg"></div>
        </div>
        <div class="row">
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img
                    class="rounded img-fluid shadow-sm img-center" src="../img/historic/haarlem2.jpg"></div>
            <div class="col align-self-center">
                <p class="text-justify"><?php foreach ($data['snippets'] as $snippet => $value) {
                    if ($value->getname() == 'about_p2')
                        echo nl2br($value->getText());
                } ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col align-self-center">
                <p class="text-justify"><?php foreach ($data['snippets'] as $snippet => $value) {
                    if ($value->getname() == 'about_p3')
                        echo nl2br($value->getText());
                } ?></p>
            </div>
            <div class="col d-xl-flex justify-content-xl-center align-items-xl-center"><img
                    class="rounded img-fluid shadow-sm" src="../img/historic/haarlem3.jpg">
            </div>
        </div>
    </section>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>