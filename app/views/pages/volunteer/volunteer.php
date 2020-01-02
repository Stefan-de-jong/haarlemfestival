
<?php require APPROOT . '/views/inc/header.php'; ?>

<section class="text-center">
<section id="bg-image" style="position: absolute;"><img src="<?php echo URLROOT; ?>/img/volunteer/bg.png" style="position: absolute;height: 979px;"><img style="position: absolute;margin-left: 1539px;height: 979px;" src="<?php echo URLROOT; ?>/img/volunteer/bg.png"></section>
    <section class="text-left" id="main-content" style="position: absolute;background-color: rgb(162,22,174);width: 1200px;height: 979px;margin-left: 384px;">
        <ol class="breadcrumb" style="background-color: rgb(255,255,255);">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/volunteer/index"><span>Volunteer</span></a></li>
        </ol>
        <section class="text-center">
            <h1>Want to help out with the festival? Volunteer!</h1>
            <p style="font-size: 16px;">Being a volunteer at Haarlem Festival is a great way to get some people experience. A lot of different people attend Haarlem Festival, so you will get to meet a lot of different people with different needs. For Haarlem Festival activities
                you can help with, but are not limited to:<br><br><strong>Ticket sales;</strong><br><br><strong>Guiding tours;</strong><br><br><strong>Setting up the venues;</strong><br><br><strong>Providing beverages to our guests.</strong><br><br>If
                this sounds interesting to you, please fill out the form below.</p>
                </section>
    </section>
    <div class="contact-clean" style="position: absolute;margin-top: 450px;margin-left: 735px;display: block;">
    <div class="contact-clean" >
        <form method="post">
            <h2 class="text-center">Volunteer now!</h2>
            <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name"></div>
            <div class="form-group"><input class="form-control is-invalid" type="email" name="email" placeholder="Email"><small class="form-text text-danger">Please enter a correct email address.</small></div>
            <div class="form-group"><textarea class="form-control" name="message" placeholder="Why do you want to volunteer?" rows="14"></textarea></div>
            <div class="form-group"><button class="btn btn-primary" type="submit">send </button></div>
        </form>
    </div>

</section>

<style> footer{margin-top: 979.031px;}</style> 
<?php require APPROOT . '/views/inc/footer.php'; ?>