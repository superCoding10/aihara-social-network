<?php

namespace Aihara\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class Mail {
    public static function send($from, $to)  {


$mail = new PHPMailer(true);

// try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    // $mail->oauthUserEmail = "konyukkio@gmail.com";
    // $mail->oauthClientId = "295095013495-ss8q20mpebsr7ovfu3qca9n2hm90f4dl.apps.googleusercontent.com";
    // $mail->oauthClientSecret = "kJT-q4hCyUgddqAW7c-5IJ-M";
    // $mail->oauthRefreshToken = "1//0c-v0bVM9QWQCCgYIARAAGAwSNwF-L9IrQGyBrYu2W7-85Xhy8Tvmzxkn4kgT_yP64MQWj3nUkSN0YaXtz8uVzKqF2W5hrOffpfE";

    $mail->Username   = 'konyukkio@gmail.com';                     // SMTP username
    $mail->Password   = '024668645k';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    // from 'konyukkio@gmail.com'
    // to 'petr_konyuk@mail.ru'
    $mail->setFrom($from);
    $mail->addAddress($to);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content



    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject 2';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
    }
}