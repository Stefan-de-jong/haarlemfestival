
<?php require APPROOT . '/views/inc/header.php'; ?>

        <section class="text-center">
<section class="text-center" style="background-color: rgb(162,22,220); padding-left: 15px; padding-right: 15px; padding-bottom: 15px">
<div style="float:left;">
          <a href="<?php echo URLROOT; ?>"><span>Home</span></a> >
         <span>Volunteer</span>
</div>
<br>
    <?php
    echo $data['content'];
    ?>

    <div class="contact-clean" style="margin-left: 500px">
        <form method="post">
            <h2 class="text-center">Volunteer now!</h2>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
            <div class="form-group"><input class="form-control is-invalid" type="email" name="email" placeholder="Email"><small class="form-text text-danger">Please enter a correct email address.</small></div>
            <div class="form-group"><textarea class="form-control" name="message" placeholder="Why do you want to volunteer?" rows="14"></textarea></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">send </button></div>
        </form>
    </div>

</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>