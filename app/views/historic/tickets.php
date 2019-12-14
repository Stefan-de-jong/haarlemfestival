<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 d-flex flex-grow-1 justify-content-around mx-auto" id="top-menu">
            <a class="d-inline-block align-self-center" href="<?php echo URLROOT;?>/historic/about">Haarlem</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic">Route</a>
            <a class="align-self-center" href="<?php echo URLROOT;?>/historic/tickets">Tickets</a></div>
    </div>
    <section>
        <div class="row">
            <div class="col">
                <h4>Tickets</h4>
            </div>

        </div>
    </section>
    <section>
        <div class="row d-xl-flex justify-content-xl-center align-items-xl-center">
            <div class="col-auto mx-auto">
                <div class="row">
                    <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">Which day would you
                            like to take the tour?</label></div>
                    <div class="col-4 d-xl-flex align-items-xl-center"><select name="selected_day" id="daySelect"
                            onchange="daySelected()">
                            <optgroup label="Tour day">
                                <!-- ToDo laat dag route default staan -->
                                <option value="2020-07-24">Friday</option>
                                <option value="2020-07-25">Saturday</option>
                                <option value="2020-07-26">Sunday</option>
                            </optgroup>
                        </select></div>
                </div>
                <div class="row">
                    <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">What time would you
                            like to take the tour?</label></div>
                    <div class="col-4 d-xl-flex align-items-xl-center"><select>
                            <optgroup label="Tour time">
                                <option value="10:00:00" selected="">10:00</option>
                                <option value="13:00:00">13:00</option>
                                <option value="16:00:00">16:00</option>
                            </optgroup>
                        </select></div>
                </div>
                <div class="row">
                    <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">What language would
                            you like the tour to be?</label></div>
                    <div class="col-4 d-xl-flex align-items-xl-center"><select>
                            <optgroup label="Tour language">
                                <option value="Nederlands">Nederlands</option>
                                <option value="English">English</option>
                                <option value="Chinese">Chinese</option>
                            </optgroup>
                        </select></div>
                </div>
                <div class="row" id="single_tickets">
                    <div class="col d-xl-flex align-items-xl-center"><label class="col-form-label">Single ticket
                            17.50</label></div>
                    <div class="col-4 d-xl-flex align-items-xl-center"><select>
                            <optgroup label="Number of single tickets">
                                <option value="1" selected="">1</option>
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
                    <div class="col-4 d-xl-flex align-items-xl-center"><select>
                            <optgroup label="Number of family tickets">
                                <option value="1" selected="">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </optgroup>
                        </select></div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center mx-auto"><button class="btn btn-primary btn-block btn-lg"
                            type="button">Continue</button></div>
                </div>
            </div>
            <div class="col-auto mx-auto" id="tickets_table">
                <h5 class="text-center">Tickets available:</h5>
                <div class="table-responsive">
                    <!-- ToDo ombouwen naar 2d array? -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <?php //foreach distinct language in $data['events'] ?>
                                <th class="text-center"><?php // echo language ?>Dutch</th>
                                <th class="text-center"><?php // echo language ?>English</th>
                                <th class="text-center"><?php // echo language ?>Chinese</th>
                                <?php //endforeach ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php // foreach($data['events'] as $event) : ?>
                            <?php // AJAX call with GET request on selected value of date? ?>
                            <tr>
                                <th><?php // echo time ?>10:00</th>
                                <?php foreach($data['events'] as $event) : ?>
                                <?php if(($event->getBeginTime() == '10:00:00') && ($event->getLanguage() == 'Nederlands')) : ?>
                                <td><?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($event->getBeginTime() == '10:00:00') && ($event->getLanguage() == 'English')) : ?>
                                <td> <?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($event->getBeginTime() == '10:00:00') && ($event->getLanguage() == 'Chinese')) : ?>
                                <td> <?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th>13:00</th>
                                <?php foreach($data['events'] as $event) : ?>
                                <?php if(($event->getBeginTime() == '13:00:00') && ($event->getLanguage() == 'Nederlands')) : ?>
                                <td> <?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($event->getBeginTime() == '13:00:00') && ($event->getLanguage() == 'English')) : ?>
                                <td> <?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($event->getBeginTime() == '13:00:00') && ($event->getLanguage() == 'Chinese')) : ?>
                                <td> <?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <th>16:00</th>
                                <?php foreach($data['events'] as $event) : ?>
                                <?php if(($event->getBeginTime() == '16:00:00') && ($event->getLanguage() == 'Nederlands')) : ?>
                                <td><?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($event->getBeginTime() == '16:00:00') && ($event->getLanguage() == 'English')) : ?>
                                <td><?php echo $event->getNTickets(); ?></td>
                                <?php endif; ?>
                                <?php if(($event->getBeginTime() == '16:00:00') && ($event->getLanguage() == 'Chinese')) : ?>
                                <td><?php echo $event->getNTickets(); ?></td>
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
    function daySelected() {
        var selector = document.getElementById("daySelect");
        var date = selector.options[selector.selectedIndex].value;
        window.location.href = "http://localhost/haarlemfestival/historic/tickets/" + date;
    }
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>