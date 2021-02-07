<?php

//Deactivate block for less secure app: https://myaccount.google.com/lesssecureapps

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '\PHPMailer/src/Exception.php';
require __DIR__ . '\PHPMailer/src/PHPMailer.php';
require __DIR__ . '\PHPMailer/src/SMTP.php';
require __DIR__ . '\PHPMailer/src/OAuth.php';


function sendGmail(){
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'juanmanuel.origgi@gmail.com';          // SMTP username
        $mail->Password   = '19nobosou';                            // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->SMTPAuth = true;

        //Recipients
        $mail->setFrom('juanmanuel.origgi@gmail.com', 'Juan Manuel Origgi');
        $mail->addAddress('origgimanuel@tiscali.it', 'IO'); 
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments  
        //$mail->addAttachment('/tmp/image.jpg', 'name'); 

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>