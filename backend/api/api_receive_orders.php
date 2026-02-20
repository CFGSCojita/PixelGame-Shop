<?php
    // Cabeceras CORS
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Content-Type: application/json; charset=UTF-8');

    // Gestionamos el preflight request de OPTIONS
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }

    // Conexión a la base de datos
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Leemos los datos recibidos por POST (form-encoded)
    $id_code  = $_POST['id_code']  ?? '';
    $email    = $_POST['email']    ?? '';
    $address  = $_POST['address']  ?? '';
    $quantity = intval($_POST['quantity'] ?? 0);

    // Validamos que tenemos todos los datos necesarios
    if (empty($id_code) || empty($email) || empty($address) || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Datos insuficientes']);
        exit;
    }

    // Obtenemos el ID del videojuego y su precio a partir del código de producto
    $result = mysqli_execute_query($conn, "SELECT videogame_id, price FROM 006_videogames WHERE id_code = ? AND supplier_id = 3 LIMIT 1", [$id_code]);

    $product = mysqli_fetch_assoc($result);

    // Verificamos si el producto existe. Si no, devolvemos un error
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        exit;
    }

    $total = $product['price'] * $quantity; // Calculamos el total multiplicando precio unitario por cantidad

    // Insertamos el pedido en la tabla 006_orders
    $sql = "INSERT INTO 006_orders (videogame_id, quantity, unit_price, total, order_address, order_date)
            VALUES (?, ?, ?, ?, ?, NOW())";

    if (mysqli_execute_query($conn, $sql, [$product['videogame_id'], $quantity, $product['price'], $total, $address])) {
        echo json_encode(['success' => true, 'message' => 'Pedido registrado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar el pedido']);
    }

    mysqli_close($conn);
?>