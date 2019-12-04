<?php require APPROOT . '/views/inc/header.php'; ?>
    <section id="bg-image" style="position: absolute;"><img src="<?php echo URLROOT; ?>/img/dance/bg-left.png" style="position: absolute;"><img style="position: absolute;margin-left: 1539px;" src="<?php echo URLROOT; ?>/img/dance/bg-right.png"></section>
    <section class="text-left" id="main-content" style="position: absolute;background-color: rgb(255,104,104);width: 1156px;height: 979px;margin-left: 384px;">
        <ol class="breadcrumb" style="background-color: rgb(255,255,255);">
            <li class="breadcrumb-item"><a href="#"><span>Home</span></a></li>
            <li class="breadcrumb-item"><a href="#"><span>dance information page</span></a></li>
        </ol>
        <h4 class="text-center">Click an artist to view information and tickets.<br></h4>
        <section class="text-center"></section><img id="t" src="<?php echo URLROOT; ?>/img/dance/tiesto.png" style="position: absolute;margin-left: 578px;width: 578px;"><img id="nr" src="<?php echo URLROOT; ?>/img/dance/Nicky%20Romoro.png" style="position: absolute;width: 578px;"><img id="aj" src="<?php echo URLROOT; ?>/img/dance/afrojack.png" style="position: absolute;width: 578px;margin-top: 250.859px;">
        <img
            id="hw" style="position: absolute;background-color: rgb(255,104,104);width: 578px;height: 250.859px;margin-left: 578px;margin-top: 250.859px;" src="<?php echo URLROOT; ?>/img/dance/hardwell.png"><img id="avb" src="<?php echo URLROOT; ?>/img/dance/armin.png" style="position: absolute;width: 578px;margin-top: 501.718px;"><img id="mx" src="<?php echo URLROOT; ?>/img/dance/martin.png" style="position: absolute;width: 578px;margin-top: 501.718px;margin-left: 578px;">
            <div class="container text-left visible"
                id="pnl" style="width: 1152px;height: 750px;display: block;margin-left: 50px;margin-right: 0px;"><img style="position: absolute;width: 576px;height: 250px;" src="<?php echo URLROOT; ?>/img/dance/765-default-avatar.png" width="250px" height="250px">
                <p style="position: absolute;margin-left: 576px;margin-bottom: 600px;">&lt;artist biography&gt;</p>
                <section>
                    <div class="table-responsive" style="position: absolute;overflow: visible;margin-top: 302px;width: 836px;height: 200px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Artist</th>
                                    <th>Venue</th>
                                    <th>Tickets</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $id = getCorrectArtist(1) ?>
                            <?php include "newtablerow.php"; ?> <!-- has to add rows equal to the amount of venues the artist performs at -->
                            </tbody>
                        </table>
                    </div>
                    <p style="position: absolute;padding-left: 845px;padding-top: 320px;"><strong>Select your tickets</strong></p><div id=dropdown>
                    <div id=buttons>
                    <?php include "newentry.php"; ?>
                    <?php include "newentry.php"; ?>
                    <?php include "newentry.php"; ?>
                    <?php include "newentry.php"; ?>
                    <?php include "newentry.php"; ?>
                    <div>
<button class="btn btn-primary" id="back" type="button" style="background-color: rgb(255,184,2);">RETURN TO ARTIST PAGE</button></section>
            </div>
    </section>
    <section>
        <h1 style="position: absolute;width: 400px;height: 800px;margin-top: 890px;margin-left: 400px;">ALL-ACCESS PASS</h1>
    </section>
    <p style="position: absolute;margin-top: 884px;margin-left: 754px;width: 250px;">Get access to all venues!<br>Select a day:</p><div id=dropdown>
<div id=dal>
<dropdown>
    <select>
      <option value="fri">Friday</option>
      <option value="sat">Saturday</option>
      <option value="sun">Sunday</option>
    </select>
</dropdown>
</div>
</div><button class="btn btn-primary" type="button" style="position: absolute;margin-top: 889px;margin-left: 1210px;height: 50px;">BUY ALL ACCESS-PASS</button>
<?php require APPROOT . '/views/inc/footer.php'; ?>