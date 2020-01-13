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
            <p class="text-justify"><?php 
                if(!empty($_SESSION['cart'])){
                    print_r($_SESSION['cart']);
                    };?>
            </p>
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

<div class="row mt-3 mb-5">
    <div class="col-md-10 d-flex flex-grow-1 mx-auto">
        <ul class=" list-unstyled d-flex flex-grow-1 justify-content-between" id="tour-route">
            <?php foreach($data['locations'] as $location) : ?>

            <li class="route-location">
                <input type="button" name="view" value="<?php echo $location->getName(); ?>"
                    id="<?php echo $location->getId(); ?>" class="btn btn-info btn-xs view_data">
            </li>

            <?php endforeach; ?>
        </ul>
    </div>
</div>
<div class="container">

    <!-- Div below with container loaded AJAX content -->
    <div class="row" id="location_details">
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
/* beautify preserve:end */
</script>
<?php require APPROOT . '/views/inc/footer.php'; ?>