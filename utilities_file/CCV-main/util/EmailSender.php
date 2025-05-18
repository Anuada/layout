<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class EmailSender
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isHTML(true);
        $this->mail->isSMTP();
        $this->mail->SMTPAuth = true;
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Username = 'frenchcries12@gmail.com';
        $this->mail->Password = 'ehlxzxdcksskipfe';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
        $this->mail->setFrom($this->mail->Username, "ElevateHer Team");
    }

    public function requestPasswordReset($email, $accountId, $username, $token)
    {
        $this->mail->addAddress($email);
        $this->mail->Subject = "ElevateHer | Password Reset";
        $host = $_SERVER['HTTP_HOST'];
        ob_start();
        include "../misc/mail/request.reset.password.php";
        $this->mail->Body = ob_get_clean();

        $this->mail->send();
    }

    public function requestAccountVerification($email, $accountId, $username, $token)
    {
        $this->mail->addAddress($email);
        $this->mail->Subject = "ElevateHer | Account Verification";
        $host = $_SERVER['HTTP_HOST'];
        ob_start();
        include "../misc/mail/request.account.verification.php";
        $this->mail->Body = ob_get_clean();

        $this->mail->send();
    }

}