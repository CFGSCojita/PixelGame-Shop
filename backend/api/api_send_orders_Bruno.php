<?php
function enviar_pedidos_bruno(array $items, string $email, string $address, $conn) {

    // Obtenemos URL y api_key de Bruno
    $supplier = mysqli_fetch_assoc(mysqli_query($conn, "SELECT api_key, url_send_orders FROM 006_suppliers WHERE supplier_id = 2"));

    // Construimos el JSON
    $payload = json_encode([
        'api_key' => $supplier['api_key'],
        'orders'  => array_map(fn($i) => [
            'videogame_id'  => $i['videogame_id'],
            'email'         => $email,
            'order_address' => $address,
            'quantity'      => $i['quantity']
        ], $items)
    ]);

    // Enviamos POST con cURL
    $ch = curl_init($supplier['url_send_orders']);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => ['Content-Type: application/json']
    ]);
    curl_exec($ch);
    curl_close($ch);
}
?>