<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public static function sendPedidoConfirmacao($nome, $email, $endereco, $total, $frete)
    {
        try {
            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = getenv('SMTP_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = getenv('SMTP_USERNAME');
            $mail->Password = getenv('SMTP_PASSWORD');
            $mail->SMTPSecure = getenv('SMTP_ENCRYPTION');
            $mail->Port = getenv('SMTP_PORT');

            $mail->setFrom(getenv('SMTP_FROM_EMAIL'), getenv('SMTP_FROM_NAME'));
            $mail->addAddress($email, $nome);

            $mail->isHTML(true);
            $mail->Subject = 'Confirmação de Pedido';

            $body = "
                <h1>Olá {$nome}, seu pedido foi realizado com sucesso!</h1>
                <p><strong>Endereço:</strong> {$endereco}</p>
                <p><strong>Total:</strong> R$ " . number_format($total, 2, ',', '.') . "</p>
                <p><strong>Frete:</strong> R$ " . number_format($frete, 2, ',', '.') . "</p>
                <p>Obrigado por comprar conosco!</p>
            ";

            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}
