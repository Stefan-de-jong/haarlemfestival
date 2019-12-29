<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 d-flex flex-grow-1 justify-content-around mx-auto" id="top-menu">
            <a class="d-inline-block align-self-center" href="<?php echo URLROOT;?>/historic/about">Haarlem</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic">Route</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic/tickets">Tickets</a></div>
    </div>
    <section>
        <h1><?php echo $data['title']?></h1>
        <div class="row">
            <div class="col">
                <?php flash('ticketNotAdded_alert'); ?>
            </div>
        </div>
    </section>
    <section>
        <div class="row d-xl-flex justify-content-xl-center align-items-xl-center">

            <form action="<?php echo URLROOT;?>/historic/order" method="post">
                <div class="col-auto mx-auto">
                    <div class="row">
                        <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">Which day would
                                you
                                like to take the tour?</label></div>
                        <div class="col-4 d-xl-flex align-items-xl-center">
                            <select name="selected_day" id="daySelect" onchange="selectedOption(this.value)">
                                <?php $tourdate = $_GET['tourdate'];?>
                                <optgroup label="Tour day">
                                    <option value="2020-07-24" <?php if($tourdate == "2020-07-24"){ echo "selected";}?>>
                                        Friday</option>
                                    <option value="2020-07-25" <?php if($tourdate == "2020-07-25"){ echo "selected";}?>>
                                        Saturday</option>
                                    <option value="2020-07-26" <?php if($tourdate == "2020-07-26"){ echo "selected";}?>>
                                        Sunday</option>
                            </select></div>

                        <script>
                            /* beautify preserve:start */
                            function selectedOption(value)
                            {
                                if (value == 0)
                                    location.href = '<?php echo URLROOT;?>/historic/tickets';
                                else {
                                    <?php $tourdate = "value";?>
                                    location.href = '<?php echo URLROOT;?>/historic/tickets?tourdate=' +<?php echo $tourdate;?>;
                                }
                            }

                    /* beautify preserve:end */
                        </script>


                    </div>
                    <div class="row">
                        <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">What time would
                                you
                                like to take the tour?</label></div>
                        <div class="col-4 d-xl-flex align-items-xl-center"><select name="selected_time">
                                <optgroup label="Tour time">
                                    <!-- ToDo pakt id van tour die overeenkomt met dag,tijd,taal na OnChange -->
                                    <!-- ToDo id vervolgens gebruiken om betreffende tour mee te geven bij POST naar order -->
                                    <option value="10:00:00">10:00</option>
                                    <option value="13:00:00">13:00</option>
                                    <option value="16:00:00">16:00</option>
                                </optgroup>
                            </select></div>
                    </div>
                    <div class="row">
                        <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">What language
                                would
                                you like the tour to be?</label></div>
                        <div class="col-4 d-xl-flex align-items-xl-center"><select name="selected_language">
                                <optgroup label="Tour language">
                                    <!-- ToDo pakt id van tour die overeenkomt met dag,tijd,taal na OnChange -->
                                    <!-- ToDo id vervolgens gebruiken om betreffende tour mee te geven bij POST naar order -->
                                    <option value="Nederlands">Nederlands</option>
                                    <option value="English">English</option>
                                    <option value="Chinese">Chinese</option>
                                </optgroup>
                            </select></div>
                    </div>
                    <div class="row" id="single_tickets">
                        <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">Single ticket
                                17.50</label></div>
                        <div class="col-4 d-xl-flex align-items-xl-center"><select name="selected_singleTickets">
                                <optgroup label="Number of single tickets">
                                    <option value="0" selected="">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </optgroup>
                            </select></div>
                    </div>
                    <div class="row" id="family_tickets">
                        <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">Family tickets
                                60.00</label></div>
                        <div class="col-4 d-xl-flex align-items-xl-center"><select name="selected_famTickets">
                                <optgroup label="Number of family tickets">
                                    <option value="0" selected="">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </optgroup>
                            </select></div>
                    </div>
                    <div class="row">

                        <div class="col-md-4 text-center mx-auto"><input type="submit" value="Continue"
                                class="btn btn-primary btn-block btn-lg"></div>
                    </div>
                </div>
            </form>

            <div class="col-auto mx-auto" id="tickets_table">
                <h5 class="text-center">Tickets available:</h5>
                <div class="table-responsive">
                    <!-- ToDo ombouwen naar 2d array? -->
                    <!-- ToDo alle dagen, tijden en talen inladen als eigen arrays zodat een for loop hier doorheen kan -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <?php //ToDo: foreach distinct language in $data['tours'] ?>
                                <th class="text-center"><?php // echo language ?>Dutch</th>
                                <th class="text-center"><?php // echo language ?>English</th>
                                <th class="text-center"><?php // echo language ?>Chinese</th>
                                <?php //endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // foreach($data['tours'] as $tour) : ?>
                            <?php // AJAX call with GET request on selected value of date? ?>
                            <tr>
                                <th><?php // echo time ?>10:00</th>
                                <?php foreach($data['tours'] as $tour) : ?>
                                <?php if(($tour->getBeginTime() == '10:00:00') && ($tour->getLanguage() == 'Nederlands')) : ?>
                                <td><?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($tour->getBeginTime() == '10:00:00') && ($tour->getLanguage() == 'English')) : ?>
                                <td> <?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($tour->getBeginTime() == '10:00:00') && ($tour->getLanguage() == 'Chinese')) : ?>
                                <td> <?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th><?php // echo time ?>13:00</th>
                                <?php foreach($data['tours'] as $tour) : ?>
                                <?php if(($tour->getBeginTime() == '13:00:00') && ($tour->getLanguage() == 'Nederlands')) : ?>
                                <td> <?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($tour->getBeginTime() == '13:00:00') && ($tour->getLanguage() == 'English')) : ?>
                                <td> <?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($tour->getBeginTime() == '13:00:00') && ($tour->getLanguage() == 'Chinese')) : ?>
                                <td> <?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th><?php // echo time ?>16:00</th>
                                <?php foreach($data['tours'] as $tour) : ?>
                                <?php if(($tour->getBeginTime() == '16:00:00') && ($tour->getLanguage() == 'Nederlands')) : ?>
                                <td><?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($tour->getBeginTime() == '16:00:00') && ($tour->getLanguage() == 'English')) : ?>
                                <td><?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($tour->getBeginTime() == '16:00:00') && ($tour->getLanguage() == 'Chinese')) : ?>
                                <td><?php echo $tour->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <?php  ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    /* beautify preserve:start */
    function selectedDay(value) {
        <?php $tourdate = "value"; ?>
        location.href = '<?php echo URLROOT;?>/historic/tickets/' + <?php echo $tourdate; ?> ;
    }
    /* beautify preserve:end */
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>