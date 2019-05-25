<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Emailme extends CI_Model{
    
    function notify($correo,$user,$subject,$body){
        try {
           
            $mail = new PHPMailer(true);

            $mail->isSMTP(true);
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'prgdwes@gmail.com';
            $mail->Password = 'proofness88';
            $mail->SMTPSecure = 'ssl';           
            $mail->Port = 465;
            $mail->setFrom('prgdwes@gmail.com', 'Administrador');
            $mail->addAddress($correo, $user);     
            $mail->isHTML(true);                                
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}