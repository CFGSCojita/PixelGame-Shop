<?php

    // Importamos las clases núcleo de la librería PHPMailer
    require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

    // Importamos clases de espacio de nombres:
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    // Creamos una función para enviar el email del pedido realizado al usuario comprador:
    function enviar_email_pedido($email, $nombre, $pedidos, $total) {
        $mail = new PHPMailer(true);
        
        try {
            // Configuración SMTP:
            $mail->isSMTP();
            $mail->Host = 'smtp.remotehost.es';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@remotehost.es';
            $mail->Password = 'Justfortesting26#';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            
            // Remitente y destinatario:
            $mail->setFrom('no-reply@remotehost.es', 'PixelGame Shop');
            $mail->addAddress($email, $nombre);
            
            // Contenido:
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de Pedido - PixelGame Shop';
            $mail->Body = generar_html($nombre, $pedidos, $total);
            
            $mail->send();
            return true;
            
        } catch (Exception $e) {
            error_log("Error email: {$mail->ErrorInfo}");
            return false;
        }
    }

    // Creamos una función para generar el HTML del email:
    function generar_html($nombre, $pedidos, $total) {
        $items = '';
        foreach ($pedidos as $p) {
            $items .= "<tr>
                <td style='padding:10px;border-bottom:1px solid #E6E6E6'>{$p['titulo']}</td>
                <td style='padding:10px;border-bottom:1px solid #E6E6E6;text-align:center'>{$p['cantidad']}</td>
                <td style='padding:10px;border-bottom:1px solid #E6E6E6;text-align:right'>{$p['precio_unitario']}€</td>
                <td style='padding:10px;border-bottom:1px solid #E6E6E6;text-align:right;font-weight:bold'>{$p['subtotal']}€</td>
            </tr>";
        }
        
        return "
        <body style='margin:0;padding:0;font-family:Arial,sans-serif;background-color:#0A0A0A'>
            <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#0A0A0A'>
                <tr><td align='center' style='padding:40px 20px'>
                    <table width='600' cellpadding='0' cellspacing='0' style='background-color:#1A1A1A;border-radius:10px'>
                        
                        <tr><td style='padding:30px;text-align:center;background:linear-gradient(135deg,#FF3366,#00CCFF);border-radius:10px 10px 0 0'>
                            <h1 style='margin:0;color:#FCFCFC;font-size:28px'>🎮 PixelGame Shop</h1>
                        </td></tr>
                        
                        <tr><td style='padding:30px'>
                            <p style='color:#FCFCFC;font-size:18px;margin:0 0 20px 0'>Hola <strong>{$nombre}</strong>,</p>
                            <p style='color:#E6E6E6;font-size:16px;line-height:1.6;margin:0 0 30px 0'>
                                ¡Gracias por tu pedido! Tu compra ha sido procesada correctamente.
                            </p>
                            
                            <table width='100%' cellpadding='0' cellspacing='0' style='background-color:#0A0A0A;border-radius:5px'>
                                <tr style='background-color:#FF3366'>
                                    <th style='padding:15px;text-align:left;color:#FCFCFC'>Producto</th>
                                    <th style='padding:15px;text-align:center;color:#FCFCFC'>Cantidad</th>
                                    <th style='padding:15px;text-align:right;color:#FCFCFC'>Precio</th>
                                    <th style='padding:15px;text-align:right;color:#FCFCFC'>Subtotal</th>
                                </tr>
                                {$items}
                                <tr>
                                    <td colspan='3' style='padding:20px 10px;text-align:right;font-size:18px;font-weight:bold;color:#FCFCFC;border-top:2px solid #FF3366'>TOTAL:</td>
                                    <td style='padding:20px 10px;text-align:right;font-size:18px;font-weight:bold;color:#00CCFF;border-top:2px solid #FF3366'>{$total}€</td>
                                </tr>
                            </table>
                            
                            <p style='color:#E6E6E6;font-size:14px;margin:30px 0 0 0'>
                                Recibirás una notificación cuando tu pedido sea enviado.
                            </p>
                        </td></tr>
                        
                        <tr><td style='padding:20px;text-align:center;background-color:#0A0A0A;border-radius:0 0 10px 10px'>
                            <p style='color:#E6E6E6;font-size:12px;margin:0'>© 2026 PixelGame Shop</p>
                        </td></tr>
                        
                    </table>
                </td></tr>
            </table>
        </body>";
    }
?>