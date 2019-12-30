<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">

    <div class="col-md-12 pt-5 d-flex flex-grow-1 justify-content-around mx-auto">
        <h1>Succes!</h1>
    </div>
    <div class="col-md-12 d-flex flex-grow-1 justify-content-around mx-auto">
        <h3>Thank you for your purchase</h3>

    </div>
    <div class="col-md-12 pt-3 d-flex flex-grow-1 justify-content-around mx-auto">

        <p>Your tickets will download shortly<br>
            They will also be sent by mail with the invoice</p>
    </div>

</div>

<?php
$pdf = new TCPDF();

foreach($data['cart_items'] as $item) {
    if($item->getEventType() == 'Haarlem Dance'){    
        
        // Insert code for ticket generatie
    }
    if($item->getEventType() == 'Haarlem Food'){    
        
        // Insert code for ticket generatie
    }
    if($item->getEventType() == 'Haarlem Historic'){    
        $eventId = $item->getEventId();
        $eventType = $item->getEventType();
        $ticketType = $item->printTicketType();
        $eventDate = date_format(date_create($item->getDate()),"d F Y");
        $eventTime = date_format(date_create($item->getTime()),"H:i") . ' uur';
        $ticketPrice = $item->getPrice();
        $eventLanguage = $item->getLanguage();

        $pdf->addPage();

        $barcode = "{$eventId} {$ticketType} {$eventLanguage}";
        $qrcode = "{$eventId} {$ticketType} {$eventLanguage}";
    
        $html = "
        <ul>
            <li>Name: {$eventType}</li>
            <li>Type: {$ticketType}</li>
            <li>Date: {$eventDate}</li>
            <li>Time: {$eventTime}</li>
            <li>Language: {$eventLanguage}</li>
            <li>Price: € {$ticketPrice}</li>
        </ul>
        <style>
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        </style>
        ";
    
        //line spacing
        $pdf->Ln(2);
    
        //write html
        $pdf->writeHTML($html);
    
        //line spacing
        $pdf->Ln(2);

        $style = array(
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
    
        // BARCODE
        //$pdf->write1DBarcode($barcode, "C39");
        
        // QRCODE
        $pdf->write2DBarcode($qrcode, 'QRCODE,H', 20, 210, 50, 50, $style, 'N');
    }
    if($item->getEventType() == 'Haarlem Jazz'){    
        
        // Insert code for ticket generatie
    }
}
ob_clean();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$attachment = $pdf->Output('tickets.pdf', 'I');



$mail = new PHPMailer(TRUE);
        $mail->setFrom("info@haarlem-festival.nl", "Haarlem Festival");
        $mail->addAddress('sjf.de.jong@gmail.com', 'Stefan de Jong');
        $mail->Subject = "Your Haarlem Festival Tickets";
        $mail->Body = 
        "Thank you for purchasing tickets for the Haarlem Festival.
        You can find your tickets below as an attachment.";
        $mail->addStringAttachment($attachment, "YourTickets.pdf");

        try {
            $mail->send();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }


?>
<?php require APPROOT . '/views/inc/footer.php'; ?>