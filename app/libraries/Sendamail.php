<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class sendamail{
    /*PHP mailer class, requires destination email address, subject and content in the constructor and then sends the mail automagically,
    no other functions required. destionation email (to) can also be an array.
    */
    public function __construct($to,$subject,$msg) {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host       = 'mail.smtp2go.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = '625583@student.inholland.nl';
        $mail->Password   = 'APy6jeAZ5MhM';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 2525;
        $mail->setFrom('625583@student.inholland.nl', 'Haarlem Festival');
        if (gettype($to)==="string"){
            $mail->addAddress($to);
        }
        else if (gettype($to)==="array"){
            if (count($to)===1){
                $mail->addAddress($to[0]);
            }else{
                $mail->addAddress($to[0]);
                $skipfirst=true;
                foreach ($to as $em) {
                    if ($skipfirst){
                        $skipfirst=false;
                        continue;
                    }
                    $mail->addBCC($em);
                }
            }
        }
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $msg;
        $mail->send();
    }
}