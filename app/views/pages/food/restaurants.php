test stefan

<?php foreach($data['restaurants'] as $restaurant) : ?>
<div class="card card-body mb-3">
    <h4 class="card-title"><?php echo $restaunt->name; ?></h4>
    <p class="card-text"><?php echo $restaunt->kitchen1;?></p>
</div>
<?php endforeach; ?>