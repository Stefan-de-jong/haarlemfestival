<?php
require APPROOT . '/views/inc/header.php';
$data['total'] = 0;
?>

    <div class="payment_body">
        <div class="cart_container" style="  display: flex;  flex-wrap: wrap; height: auto;">
             <div style="width: 33.3%; padding-left: 10px">
                 <h3> ❶ Email or login </h3>
                 <hr style="background-color: white">
                 <div style="background-color: azure; float:right; width: 1px; height: 100%"></div>
                 Do you have an account?<br>
                 Login-> <button>Login</button><br>
                 <br>
                <br>
                 Would you like to get the<br>
                 benifites of an account?<br>
                 Register-> <button>Register</button><br>
                 <br>
                 No account needed? <br>
                 The tickets will be send to you by e-mail<br>
                 <br>
                 Please enter your e-mail and city:<br>
                 <br>
                 Country: <?php require APPROOT . '/views/inc/countrys.html'; ?><br>
                 <br>
                 Zip-code: <input style="float: right; margin-right: 15px" type="text"><br>
                 <br>
                 E-mail: <input style="float: right; margin-right: 15px" type="text"><br>
                 <br>
                 Re-enter e-mail: <input style="float: right; margin-right: 15px" type="text"><br>
             </div>

            <div style="width: 33.3%; padding-left: 10px">
                <h3>❷ Choose payment method</h3>
                <hr style="background-color: white">
                <div style="background-color: azure; float:right; width: 1px; height: 100%"></div>

                <input type="radio" name="pay_method">iDEAL<br>
                <input type="radio" name="pay_method">MasterCard<br>
                <input type="radio" name="pay_method">VISA<br>
            </div>

            <div style="width: 33.3%; padding-left: 10px">
                <h3>❸ Check your order and pay</h3>
                <hr style="background-color: white">

<div style="overflow: scroll; height: 600px">
                <?php if(!empty($data['cart_items'])) : ?>
                    <?php foreach($data['cart_items'] as $item) : ?>
                        <?php if($item->getEventType() == 'Haarlem Food') : ?>
                            <img height="50px" width="50px"src="<?php echo URLROOT; ?>/img/food.jpg">
                            <?php   $date = date_create($item->getDate());
                            $time = date_create($item->getTime());
                            echo $item->getEventType(). "<br> ".
                                $item->getRestName(). ", <br> Request: ".
                                $item->getRequest() . '<br> Ticket type: '.
                                $item->getTicketType(). "<br> amount: ".
                                $item->getAmount(). ", price: ".
                                ($item->getPrice() * $item->getAmount()). ' <br><br>';
                            $data['total'] += $item->getPrice() * $item->getAmount();
                            ?>
                        <?php endif; ?>

                        <?php if($item->getEventType() == 'Haarlem Dance') : ?>
                            <img height="50px" width="50px"src="<?php echo URLROOT; ?>/img/dance.jpg">

                        <?php endif; ?>

                        <?php if($item->getEventType() == 'Haarlem Historic') : ?>
                            <img height="50px" width="50px"src="<?php echo URLROOT; ?>/img/historic.jpg">
                        <?php endif; ?>

                    <?php endforeach; ?>
                <?php endif; ?>
</div>
                Total: € <?php echo $data['total'];?><br>
                <button style="width: 100px; float: right; margin-right: 125px">Pay</button>
            </div>
        </div>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>