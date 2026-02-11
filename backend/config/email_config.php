<?php

    // Importamos los archivos de PHPMailer:
    require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/Exception.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/PHPMailer.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/PHPMailer/src/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    /**
     * Función para enviar el email de confirmación de pedido:
     */
    function enviar_email_pedido($email, $nombre, $pedidos, $total) {
        $mail = new PHPMailer(true);
        
        try {
            // Configuración SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.remotehost.es';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@remotehost.es';
            $mail->Password = 'Justfortesting26#';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';
            
            // Remitente y destinatario
            $mail->setFrom('no-reply@remotehost.es', 'PixelGame Shop');
            $mail->addAddress($email, $nombre);
            
            // Contenido
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

    /**
     * Función para generar el HTML del email:
     */
    function generar_html($nombre, $pedidos, $total) {
        $items = '';
        foreach ($pedidos as $p) {
            $items .= "<tr>
                <td>{$p['titulo']}</td>
                <td>{$p['cantidad']}</td>
                <td>{$p['precio_unitario']}€</td>
                <td>{$p['subtotal']}€</td>
            </tr>";
        }
        
        return "
        <h1>🎮 PixelGame Shop</h1>
        <p>Hola <strong>{$nombre}</strong>,</p>
        <p>¡Gracias por tu pedido! Tu compra ha sido procesada correctamente.</p>
        
        <table border='1'>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
            {$items}
            <tr>
                <td colspan='3'><strong>TOTAL:</strong></td>
                <td><strong>{$total}€</strong></td>
            </tr>
        </table>
        
        <p>Recibirás una notificación cuando tu pedido sea enviado.</p>
        <p>© 2026 PixelGame Shop</p>";
    }
?>