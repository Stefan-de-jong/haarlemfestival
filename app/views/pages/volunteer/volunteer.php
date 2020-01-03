
<?php require APPROOT . '/views/inc/header.php'; ?>

        <section class="text-center">
<section class="text-center" style="background-color: rgb(162,22,220); padding-left: 15px; padding-right: 15px; padding-bottom: 15px">
<div style="float:left;">
          <a href="<?php echo URLROOT; ?>"><span>Home</span></a> >
         <span>Volunteer</span>
</div>
<br>
            <h1>Want to help out with the festival? Volunteer!</h1>
            <p style="font-size: 16px;">Being a volunteer at Haarlem Festival is a great way to get some people experience. A lot of different people attend Haarlem Festival, so you will get to meet a lot of different people with different needs. For Haarlem Festival activities
                you can help with, but are not limited to:<br><br><strong>Ticket sales;</strong><br><br><strong>Guiding tours;</strong><br><br><strong>Setting up the venues;</strong><br><br><strong>Providing beverages to our guests.</strong><br><br>If
                this sounds interesting to you, please fill out the form below.</p>

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