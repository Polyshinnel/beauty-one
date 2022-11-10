<?php


namespace App\Controllers;


use DI\Container;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailerClass
{
    private $mailer;
    private $container;

    public function __construct(PHPMailer $mailer,Container $container)
    {
        $this->mailer = $mailer;
        $this->container = $container;
    }

    public function sendMail(String $address,array $mailArr) {
        $mail = $this->mailer;
        $mail->CharSet = 'UTF-8';
        $config = $this->container->get('config')['mail'];
        $subject = $mailArr['subject'];
        $body = $mailArr['body'];

        try {
            $mail->isSMTP();
            $mail->Host = $config['hostname'];
            $mail->SMTPAuth = true;
            $mail->SMTPAutoTLS = false;
            $mail->Username = $config['mail_name'];
            $mail->Password = $config['mail_pass'];

            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];

            $mail->setFrom($config['hostname'],$config['hostname']);
            $mail->addAddress($address);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            return true;
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}