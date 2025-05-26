<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendConfirmationEmail($email, $username, $verifyLink): bool {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'zigiwinws@gmail.com';
        $mail->Password   = 'mmjngxdcewjvzhnc'; // использовать app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('zigiwinws@gmail.com', 'CertiCraft');
        $mail->addAddress($email, $username);
        $mail->isHTML(false);
        $mail->Subject = 'Подтверждение регистрации';
        $mail->Body    = "Здравствуйте, $username!\n\nПерейдите по ссылке для подтверждения регистрации:\n$verifyLink";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Mail Error: " . $mail->ErrorInfo);
        return false;
    }
}
