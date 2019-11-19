<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-3">
    <div class="col-md-6">
        <h1>Test Index</h1>
    </div>
</div>
<?php foreach($data['tests'] as $test) : ?>
<div class="card card-body mb-3">
    <h4 class="card-title"><?php echo $test->title; ?></h4>
    <p class="card-text"><?php echo $test->body;?></p>
</div>
<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>