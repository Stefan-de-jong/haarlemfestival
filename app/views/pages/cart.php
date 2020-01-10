<?php
require APPROOT . '/views/inc/header.php';
?>
<div class="payment_body">
    <div class="cart_container" style="padding-bottom: 40px">
        ---------------------------------------------------------statisch
        voorbeeld---------------------------------------------------------------------------------------
        <table border="1">
            <tr>
                <td rowspan="3" width="200px" height="200px">Foto</td>
                <td width="450px">Naam</td>
                <td width="450px">Datum</td>
                <td width="100px">
                    <select>
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Plaats</td>
                <td>Tijd</td>
                <td>Bedrag</td>
            </tr>
            <tr>
                <td>Opmerking</td>
                <td colspan="2" align="right">Verwijderen</td>
            </tr>
        </table>
        ---------------------------------------------------------------hieronder
        dynamisch------------------------------------------------

        <?php if(!empty($data['cart_items'])) : ?>
        <?php foreach($data['cart_items'] as $item) : ?>

        <?php if($item->getEventType() == 'Haarlem Dance') : ?>
        <?php   $date = date_create($item->getDate());
                    $time = date_create($item->getTime());

                    ?>
        <table border="1">
            <tr>
                <td rowspan="3"><img height="200px" width="200px" src="<?php echo URLROOT; ?>/img/dance.jpg"></td>
                <td width="450px"><?php echo $item->getEventType();?></td>
                <td width="450px"><?php echo $item->getArtist(); ?></td>
                <td width="100px">
                    <form method="post">
                        <?php if(strpos($item->getTicketType(), "dance_ticket") !== false)
                                            $name = "dance_ticket_amount" . $item->getEventId();
                                        else if (strpos($item->getTicketType(), "all_access") !== false)
                                            $name = "all_access_amount" . $item->getEventId();
                                        ?>
                        <select name="<?php echo $name;?>" onchange="this.form.submit()">
                            <?php               if(strpos($item->getTicketType(), "dance_ticket") !== false)
                            {
                                                for ($i = 0; $i < 12; $i++) {
                                                echo '<option value="' . $i . '" ' . (($i == $item->getAmount()) ? 'selected="selected"' : "") . '>' . $i . '</option>';
                                            } } else {echo '<option value="' . 1 . '" ' . (($i == $item->getAmount()) ? 'selected="selected"' : "") . '>' . 1 . '</option>';}?>
                        </select>
                        <?php
                                            if(isset($_POST['dance_ticket_amount'.$item->getEventId()]))
                                            {
                                                $id = $item->getEventId();
                                                $amount = $_POST['dance_ticket_amount'.$item->getEventId()];

                                                $_SESSION['cart'][$id]["dance_ticket"] = $amount;
                                                echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                            }
                                            if(isset($_POST['all_access_amount'.$item->getEventId()]))
                                            {
                                                $id = $item->getEventId();
                                                $amount = $_POST['all_access_amount'.$item->getEventId()];

                                                $_SESSION['cart'][$id]["all_access"] = $amount;
                                                echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                            }
                                        ?>
                    </form>
                </td>
            </tr>
            <tr>
                <td><?php if(strpos($item->getTicketType(), "all_access") !== false){if (substr($item->getTicketType(), 3, -3) == 'all'){echo date_format($date,"d F Y");}else{echo "No specific date";}} else{echo date_format($time, "H:i") . "<br>". date_format($date,"d F Y");} ?>
                </td>;
                <td><?php if(strpos($item->getTicketType(), "dance_ticket") !== false){echo $item->getVenue() . "<br>" . $item->getAddress();}?>
                </td>
                <td><?php echo 'p/s: ' . $item->getPrice() . '<br>'; ?>
                    <?php echo 'total: ' . $item->getSubTotal(); ?></td>
            </tr>
            <tr>
                <td>
                    <?php $item->printTicketType() . " "; if(substr($item->getTicketType(), -3) == 'fri'){echo "Friday";}else if(substr($item->getTicketType(), -3) == 'sat'){echo "Saturday";}else if(substr($item->getTicketType(), -3) == 'sun'){echo "Sunday";}else if(substr($item->getTicketType(), -3) == 'all'){echo "All festival days";}?>
                </td>
                <td colspan="2" align="right">
                    <form method="post">
                        <button name="delete<?php echo $item->getEventId();?>">Delete</button>
                        <?php
                                        //als delete wordt gedrukt dan wordt de id meegegeven, dit id wordt gebruikt om de cart item te deleten samen met het type
                                      
                                        if(isset($_POST['delete'.$item->getEventId()]))
                                        {
                                            $id = $item->getEventId();
                                            unset($_SESSION['cart'][$id]);
                                            echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                        }
                                        ?>
                    </form>
                </td>
            </tr>
        </table>
        <br>
        <?php endif; ?>

        <?php if($item->getEventType() == 'Haarlem Food') : ?>
        <?php   $date = date_create($item->getDate());
                    $time = date_create($item->getTime());
                    ?>
        <table border="1">
            <tr>
                <td rowspan="3"><img height="200px" width="200px" src="<?php echo URLROOT; ?>/img/food.jpg"></td>
                <td width="450px"><?php echo $item->getEventType(); ?></td>
                <td width="450px"><?php echo $item->getTicketType(); ?></td>
                <td width="100px">
                    <form method="post">
                        <?php if($item->getTicketType() == "Regular ticket")
                                          $name = "regularTicket_amount" . $item->getEventId();
                                          else
                                              $name = "kidsTicket_amount" . $item->getEventId();
                                          ?>
                        <select name="<?php echo $name;?>" onchange="this.form.submit()">
                            <?php for ($i = 0; $i < 12; $i++) {
                                                echo '<option value="' . $i . '" ' . (($i == $item->getAmount()) ? 'selected="selected"' : "") . '>' . $i . '</option>';
                                            }; ?>
                        </select>
                        <?php
                                            if(isset($_POST['regularTicket_amount'.$item->getEventId()]))
                                            {
                                                $id = $item->getEventId();
                                                $amount = $_POST['regularTicket_amount'.$item->getEventId()];

                                                $_SESSION['cart'][$id]["food_regular_ticket"] = $amount;
                                                echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                            }
                                            if(isset($_POST['kidsTicket_amount'.$item->getEventId()]))
                                            {
                                                $id = $item->getEventId();
                                                $amount = $_POST['kidsTicket_amount'.$item->getEventId()];

                                                $_SESSION['cart'][$id]["food_kids_ticket"] = $amount;
                                                echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                            }
                                        ?>
                    </form>
                </td>
            </tr>
            <tr>
                <td><?php echo $item->getRestName(). "<br>". date_format($date,"d F Y") ; ?></td>
                <td><?php echo 'Time: '. date_format($time,"H:i") .'<br> Session: '. $item->getSession();?></td>
                <td><?php echo 'p/s: ' . $item->getPrice() . '<br>'; ?>
                    <?php echo 'total: ' . $item->getSubTotal(); ?></td>
            </tr>
            <tr>
                <td>
                    <?php echo $item->getRequest();?>
                </td>
                <td colspan="2" align="right">
                    <form method="post">
                        <button name="delete<?php echo $item->getEventId();?>">Delete</button>
                        <?php
                                        //als delete wordt gedrukt dan wordt de id meegegeven, dit id wordt gebruikt om de cart item te deleten samen met het type
                                        if(isset($_POST['delete'.$item->getEventId()]))
                                        {
                                            if($item->getTicketType() == "Regular ticket")
                                                $type = "food_regular_ticket";
                                            else if($item->getTicketType() == "Kids ticket")
                                                $type = "food_kids_ticket";

                                            $id = $item->getEventId();
                                            unset($_SESSION['cart'][$id][$type]);
                                            echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                        }
                                        ?>
                    </form>
                </td>
            </tr>
        </table>
        <br>
        <?php endif; ?>

        <?php if($item->getEventType() == 'Haarlem Historic') : ?>
        <table border="1">
            <tr>
                <td rowspan="3" width="200px" height="200px"><img height="200px" width="200px"
                        src="<?php echo URLROOT; ?>/img/historic.jpg"></td>
                <td width="450px"><?php echo $item->getEventType(); ?></td>
                <td width="450px"><?php echo $item->printTicketType(); ?></td>
                <td width="100px">
                    <form method="post">
                        <?php if($item->printTicketType() == "Single ticket")
                                            $name = "historic_single_ticket_ammount" . $item->getEventId();
                                        else
                                            $name = "historic_fam_ticket_ammount" . $item->getEventId();
                                        ?>
                        <select name="<?php echo $name;?>" onchange="this.form.submit()">
                            <?php for ($i = 0; $i < 12; $i++) {
                                                echo '<option value="' . $i . '" ' . (($i == $item->getAmount()) ? 'selected="selected"' : "") . '>' . $i . '</option>';
                                            }; ?>
                        </select>
                        <?php
                                            if(isset($_POST['historic_single_ticket_ammount'.$item->getEventId()]))
                                            {
                                                $id = $item->getEventId();
                                                $amount = $_POST['historic_single_ticket_ammount'.$item->getEventId()];
                                                $ticket = array(
                                                    'historic_single_ticket' => $amount                                                    
                                                );
                                                $_SESSION['cart'][$id]['historic_single_ticket']=$ticket['historic_single_ticket'];     
                                                echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                            }
                                            if(isset($_POST['historic_fam_ticket_ammount'.$item->getEventId()]))
                                            {
                                                $id = $item->getEventId();
                                                $amount = $_POST['historic_fam_ticket_ammount'.$item->getEventId()];
                                                $ticket = array(
                                                    'historic_fam_ticket' => $amount                                                    
                                                );
                                                $_SESSION['cart'][$id]['historic_fam_ticket']=$ticket['historic_fam_ticket'];     
                                                echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                            }
                                        ?>
                    </form>
                </td>
            </tr>
            <tr>
                <td><?php echo $item->getLanguage(); ?></td>
                <td><?php echo $item->getDate() . ', ' . $item->getTime() . ' uur'; ?></td>
                <td><?php echo 'p/s: ' . $item->getPrice() . '<br>'; ?>
                    <?php echo 'total: ' . $item->getSubTotal(); ?></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="right">
                    <form method="post">
                        <?php if($item->printTicketType() == "Single ticket")
                                            $deleteName = "historic_single_ticket_delete" . $item->getEventId();
                                        else
                                            $deleteName = "historic_fam_ticket_delete" . $item->getEventId();
                                        ?>
                        <button name="<?php echo $deleteName;?>">Delete</button>
                        <?php
                                        //als delete wordt gedrukt dan wordt de id meegegeven, dit id wordt gebruikt om de cart item te deleten samen met het type
                                        if(isset($_POST['historic_single_ticket_delete'.$item->getEventId()]))
                                        {
                                            $id = $item->getEventId();
                                            $_SESSION['cart'][$id]["historic_single_ticket"] = 0;
                                            echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                        }
                                        if(isset($_POST['historic_fam_ticket_delete'.$item->getEventId()]))
                                        {
                                            $id = $item->getEventId();
                                            $_SESSION['cart'][$id]["historic_fam_ticket"] = 0;
                                            echo "<meta http-equiv=\"refresh\" content=\"0\">";
                                        }

                                        ?>
                    </form>
                </td>
                </td>
            </tr>
        </table>
        <br>
        <?php endif; ?>

        <?php if($item->getEventType() == 'Haarlem Jazz') : ?>
        <!--  Code voor printen van tabel voor Jazz -->
        <?php endif; ?>

        <?php endforeach; ?>
        <?php endif; ?>

        <button onclick="window.location.href='<?php echo URLROOT;?>/cart/paymentdetails'" style="float: right">Continue
            to
            order</button>
    </div>
</div>




<?php
require APPROOT . '/views/inc/footer.php'; ?>

