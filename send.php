<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/SMTP.php';

if (isset($_POST["send"])) {
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = 'chaimae.chairi@etu.uae.ac.ma';
    $mail->Password = 'wikj insk grxi eanq';
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom('chaimae.chairi@etu.uae.ac.ma');
    $mail->addAddress($_POST["email"]);
    $mail->isHTML(true);

    $mail->Subject = $_POST["subject"];
    $mail->Body = $_POST["message"];

    try {
        $mail->send();
        echo "Message sent!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    

    echo
    "
    <script>
    alert('Send Message');
    document.location.href = 'sendEmail.php';
    </script>
    ";


}
?>