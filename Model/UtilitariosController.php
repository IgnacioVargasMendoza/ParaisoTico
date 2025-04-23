<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function EnviarCorreo(string $asunto, string $contenido, string $destinatario): bool {

    require_once $_SERVER['DOCUMENT_ROOT'] . '/ParaisoTico/Controller/PHPMailer/src/Exception.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ParaisoTico/Controller/PHPMailer/src/PHPMailer.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/ParaisoTico/Controller/PHPMailer/src/SMTP.php';


    $correoSalida      = 'ivargas30298@ufide.ac.cr';
    $contrasennaSalida = 'xxxx'; 

    $mail = new PHPMailer(true);
    try {

        $mail->SMTPDebug   = 2;
        $mail->Debugoutput = 'html';

        $mail->isSMTP();
        $mail->Host       = 'smtp.office365.com';
        $mail->Port       = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth   = true;
        $mail->Username   = $correoSalida;
        $mail->Password   = $contrasennaSalida;


        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
                'allow_self_signed'=> true,
            ],
        ];

        $mail->setFrom($correoSalida, 'Paraíso Tico');
        $mail->addReplyTo($correoSalida, 'Paraíso Tico');
        $mail->addAddress($destinatario);

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $asunto;
        $mail->Body    = $contenido;

        return $mail->send();
    } catch (Exception $e) {
        error_log('Mailer Error: ' . $mail->ErrorInfo);
        return false;
    }
}
