<?php
    function enviar_pedidos_bruno(array $items, string $email, string $address, $conn) {

        // Obtenemos URL y api_key de Bruno
        $supplier = mysqli_fetch_assoc(mysqli_query($conn, "SELECT api_key, url_send_orders FROM 006_suppliers WHERE supplier_id = 2"));

        // Enviamos POST con cURL - un pedido por cada item (Bruno usa $_POST, no JSON)
        foreach ($items as $i) {
            $ch = curl_init($supplier['url_send_orders']);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => [
                    'api_key'  => $supplier['api_key'],
                    'id_code'  => $i['id_code'],
                    'email'    => $email,
                    'address'  => $address,
                    'quantity' => $i['quantity']
                ],
                CURLOPT_SSL_VERIFYPEER => false  // Solo necesario en local con WAMP
            ]);
            $response = curl_exec($ch);

            // DEBUG TEMPORAL - quitar después
            error_log("URL: " . $supplier['url_send_orders']);
            error_log("Respuesta: " . $response);
            error_log("Error cURL: " . curl_error($ch));
        }
    }
?>