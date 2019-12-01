<?php
require APPROOT . '/views/inc/header.php'; ?>

<?php foreach($data['page'] as $page) : ?>

  <?php echo $page->html;?>

<?php endforeach; ?>

<?php require APPROOT . '/views/inc/footer.php';
?>