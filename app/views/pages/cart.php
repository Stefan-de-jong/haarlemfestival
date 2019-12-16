<?php
require APPROOT . '/views/inc/header.php';
?>
<div class="payment_body">
    <div class="cart_container">
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
        ---------------------------------------------------------nieuwe-----------------------------------------------------------------------------------------------
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
        ---------------------------------------------------------Test van
        Stefan-------------------------------------------------------------------------------------<br>

        <?php foreach($data['cart_items'] as $item) : ?>

        <table border="1">
            <tr>
                <td rowspan="3" width="200px" height="200px">Foto</td>
                <td width="450px"><?php echo $item->getEventType(); ?></td>
                <td width="450px"><?php echo $item->getTicketType(); ?></td>
                <td width="100px">
                    <select>
                        <?php for ($i=0; $i < 12; $i++) {                             
                            echo '<option value="'.$i.'" '.(($i==$item->getAmount())?'selected="selected"':"").'>'.$i.'</option>';
                        };?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo $item->getLanguage(); ?></td>
                <td><?php echo $item->getDate() . ', ' . $item->getTime() . ' uur'; ?></td>
                <td><?php echo 'p/s ' . $item->getPrice() . '<br>'; ?>
                    <?php echo 'total ' . $item->getSubTotal(); ?></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2" align="right">Verwijderen</td>
            </tr>
        </table>
        <br>
        <?php endforeach; ?>
        <button style="float: right">Continue to order</button>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>