
<?php require_once APPROOT . '/views/inc/header.php';
?>
<style> footer{margin-top: 979.031px;}</style>
<container class="text-center" style="width: 100%">
    <section id="bg-image" style="position: absolute;"><img src="<?php echo URLROOT; ?>/img/dance/bg-left.png" style="position: absolute;"><img style="position: absolute;margin-left: 1536px;" src="<?php echo URLROOT; ?>/img/dance/bg-right.png"></section>
    <section class="text-center" id="welcome-message" style="width: 1154px;background-color: rgb(255,69,69);height: 64px;margin-left: 384px;position: absolute;">
        <h1>Are you ready to party?</h1>
    </section>
    <section id="main-content" style="position: absolute;background-color: rgb(255,104,104);width: 1154px;margin-top: 63px;height: 916px;margin-left: 384px;">
        <ol class="breadcrumb" style="background-color: rgb(255,255,255);">
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a href="<?php echo URLROOT; ?>/dance/index"><span>dance information page</span></a></li>
        </ol>
        <h4 class="text-center"><?php foreach ($data['snippets'] as $snippet){if (strpos($snippet->getName(), "intro") !== false){echo $snippet->getText();}} ?></h4>
        <section><img src="<?php echo URLROOT; ?>/img/dance/artist%20image.png" style="position: absolute;width: 537px;"></section>
        <section>
            <h4 class="text-left" style="background-color: rgb(255,62,62);width: 464px;margin-left: 66px;margin-bottom: 0px;">Friday</h4>
            <h4 class="text-left" style="background-color: rgb(255,255,255);width: 464px;margin-left: 66px;margin-top: 0px;margin-bottom: 0px;"><?php foreach ($data['snippets'] as $snippet){if (strpos($snippet->getName(), "friday") !== false){echo $snippet->getText();}} ?></h4>
            <section style="background-color: #ffffff;margin-top: 0px;width: 464px;margin-left: 66px;"><button class="btn btn-primary" type="button" style="margin-right: 328px;margin-top: 20px;margin-bottom: 20px;"><a class="btn_url" href="<?php echo URLROOT; ?>/dance/purchase">BUY TICKETS</a></button></section>
</form></button></section>
            <section style="margin-top: 20px;">
                <h4 class="text-left" style="background-color: rgb(255,62,62);width: 464px;margin-left: 66px;margin-bottom: 0px;">Saturday</h4>
                <h4 class="text-left" style="background-color: rgb(255,255,255);width: 464px;margin-left: 66px;margin-top: 0px;margin-bottom: 0px;"><?php foreach ($data['snippets'] as $snippet){if (strpos($snippet->getName(), "saturday") !== false){echo $snippet->getText();}} ?></h4>
                <section style="background-color: #ffffff;margin-top: 0px;width: 464px;margin-left: 66px;"><button class="btn btn-primary" type="button" style="margin-right: 328px;margin-top: 20px;margin-bottom: 20px;"><a class="btn_url" href="<?php echo URLROOT; ?>/dance/purchase">BUY TICKETS</a></button></section>
            </section>
            <section style="margin-top: 20px;">
                <h4 class="text-left" style="background-color: rgb(255,62,62);width: 464px;margin-left: 66px;margin-bottom: 0px;">Sunday</h4>
                <h4 class="text-left" style="background-color: rgb(255,255,255);width: 464px;margin-left: 66px;margin-top: 0px;margin-bottom: 0px;"><?php foreach ($data['snippets'] as $snippet){if (strpos($snippet->getName(), "sunday") !== false){echo $snippet->getText();}} ?></h4>
                <section style="background-color: #ffffff;margin-top: 0px;width: 464px;margin-left: 66px;"><button class="btn btn-primary" type="button" style="margin-right: 328px;margin-top: 20px;margin-bottom: 20px;"><a class="btn_url" href="<?php echo URLROOT; ?>/dance/purchase">BUY TICKETS</a></button></section>
            </section>
        </section>
    </section>
</container>
<?php require APPROOT . '/views/inc/footer.php'; ?>
