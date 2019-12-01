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
                    <div class="col-4 d-xl-flex align-items-xl-center"><select>
                            <optgroup label="Tour day">
                                <option value="12" selected="">This is item 1</option>
                                <option value="13">This is item 2</option>
                                <option value="14">This is item 3</option>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">Dutch</th>
                                <th class="text-center">English</th>
                                <th class="text-center">Chinese</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>10:00</td>
                                <td name="dutch_10">Cell 1</td>
                                <td name="english_10">Cell 2</td>
                                <td name="chinese_10">Cell 2</td>
                            </tr>
                            <tr>
                                <td>13:00</td>
                                <td name="dutch_13">Cell 3</td>
                                <td name="english_13">Cell 4</td>
                                <td name="chinese_13">Cell 4</td>
                            </tr>
                            <tr>
                                <td>16:00</td>
                                <td name="dutch_16">Cell 3</td>
                                <td name="english_16">Cell 4</td>
                                <td name="chinese_16">Cell 4</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>