<?php require APPROOT . '/views/inc/header.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-4 d-flex flex-grow-1 justify-content-around mx-auto" id="top-menu">
            <a class="d-inline-block align-self-center" href="<?php echo URLROOT;?>/historic/about">Haarlem</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic">Route</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic/tickets">Tickets</a></div>
    </div>

    <?php flash('ticketAdded_succes'); ?>
    <h1><?php echo $data['title']?></h1>
    <div class="row">
        <div class="col">
            <!-- ToDo add snippet explaining Historic -->
        </div>
        <div class="col-md-4">
            <h4><?php foreach ($data['snippets'] as $snippet => $value) {
                    if ($value->getname() == 'intro_titel')
                        echo nl2br($value->getText());
                } ?></h4>
            <p><?php foreach ($data['snippets'] as $snippet => $value) {
                    if ($value->getname() == 'intro_text')
                        echo nl2br($value->getText());
                } ?></p>
        </div>
    </div>
</div>

<div class="row mt-3 mb-3">
    <div id="tour-buttons" class="tour-route mx-auto">

        <?php foreach($data['locations'] as $location) : ?>
        <div class="button-wrapper">
            <p><?php echo $location->getName();?></p>
            <a href="#" id="<?php echo $location->getId();?>"
                class="tour-btn view_data <?php if($location->getId() == 1){ echo "active";}?>"></a>
        </div>
        <?php endforeach; ?>

    </div>
</div>
<div class=" container">

    <!-- Div below will contain loaded AJAX content -->
    <div class="row mb-5" id="location_details">
        <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
            <p class="text-justify"><?php echo $data['locations'][0]->getDescription(); ?></p>
        </div>
        <?php if($location->getURL1() != '') : ?>
        <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
            <img src="<?php echo URLROOT;?>/img/<?php echo $data['locations'][0]->getURL1(); ?>"
                class="rounded shadow-sm img-fluid">
        </div>
        <?php endif; ?>
        <?php if($location->getURL2() != '') : ?>
        <div class="col d-xl-flex justify-content-xl-center align-items-xl-center">
            <img src="<?php echo URLROOT;?>/img/<?php echo $data['locations'][0]->getURL2(); ?>"
                class="rounded shadow-sm img-fluid">
        </div>
        <?php endif; ?>
    </div>

</div>
<script>
    /* beautify preserve:start */
$(document).ready(function(){
    $('.view_data').click(function(){
        var location_id = $(this).attr("id");
        $.ajax({
            url:"<?php echo URLROOT;?>/historic/select",
            method:"post",
            data:{location_id:location_id},
            success:function(data){
                    $('#location_details').html(data);
            }
        });
    });
});
</script>
<script>
    // Add active class to the current button (highlight it)
    var header = document.getElementById("tour-buttons");
    var btns = header.getElementsByClassName("tour-btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function () {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
    /* beautify preserve:end */
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>