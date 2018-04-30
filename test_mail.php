<?php
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'solocalms-fr.mail.protection.outlook.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
    $mail->Username = 'gaylord.petit@solocalms.fr';                 // SMTP username
    $mail->Password = 'fripon02!!!';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 25;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('gaylord.petit@solocalms.fr', 'Gaylord PETIT');
    $mail->addAddress('gaylord.petit@solocalms.fr', 'Gaylord PETIT');     // Add a recipient
    $mail->addReplyTo('gaylord.petit@solocalms.fr', 'Gaylord PETIT');

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Inscription outil production';
    $mail->Body    = 'Pour vous connecter à l\outil, veuillez cliquer sur le lien suivant:<br><a href="factory-rec.solocalms.intra/login.php">lien</a>';

    $mail->send();
    echo 'Message envoyé';
} catch (Exception $e) {
	echo 'le message n\a pas pu être envoyé: ', $mail->ErrorInfo;
}
    ?>