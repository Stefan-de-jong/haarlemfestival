<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(TRUE);

    $mail->isSMTP();
    $mail->Host = 'mail.smtp2go.com';
    $mail->SMTPAuth = true;
    $mail->Username = '625583@student.inholland.nl';
    $mail->Password = 'APy6jeAZ5MhM';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;

    $mail->setFrom("info@haarlem-festival.nl", "Haarlem Festival"); // From who
    $mail->addAddress($data['customer_email'], 'Dear customer');   // To who (hardcoded for testing)
    $mail->Subject = "Your Haarlem Festival Tickets";
    $mail->Body = 
    "Thank you for purchasing tickets for the Haarlem Festival.
    You can find your tickets below as an attachment.";
    $mail->addStringAttachment($data['invoice'], "Invoice.pdf");
    $mail->addStringAttachment($data['attachment'], "YourTickets.pdf");

    try {
        $mail->send();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    } catch (\Exception $ex) {
        echo $ex->getMessage();
    }
?>

<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">

    <div class="col-md-12 pt-5 d-flex flex-grow-1 justify-content-around mx-auto">
        <h1>Succes!</h1>
    </div>
    <div class="col-md-12 d-flex flex-grow-1 justify-content-around mx-auto">
        <h3>Thank you for your purchase</h3>

    </div>
    <div class="col-md-12 pt-3 d-flex flex-grow-1 justify-content-around mx-auto">

        <p>Your tickets will be sent by mail with the invoice</p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>