<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Emailme extends CI_Model{
    
    function notify($correo, $user, $subject, $body){
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
            $mail->Body = $this->constructBody($body);

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    function constructBody($body){

        $response = "";

        $response .= "<h2><strong> Horarios de los encuentros de su equipo: </strong></h2>";
        $response .=
        "<table style='border:1px solid black; width:100%; text-align:center;'>
            <thead style='padding: 0.3em'>
                <tr>
                    <th>Fecha</th>
                    <th>Local</th>
                    <th>Visitante</th>
                    <th>Resultados</th>
                    <th>Ganador</th>
                    <th>Lugar</th>
                </tr>
            </thead>
        <tbody style='padding: 0.3em'>";
        foreach($body as $encuentro){
            $response .= "<tr>
            <td>". $encuentro['fecha']. "</td>
            <td>". $encuentro['local']. "</td>
            <td>". $encuentro['visitante']. "</td>
            <td>". $encuentro['resultadoLocal']. "--". $encuentro['resultadoVisitante']. "</td>
            <td>". $encuentro['resultado']."</td>
            <td>". $encuentro['lugar']."</td>
            </tr>";
        }
        $response .="</tbody></table>";

        return $response;

    }
}