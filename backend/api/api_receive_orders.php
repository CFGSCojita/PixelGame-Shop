<?php
    // Conexión a la base de datos
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $data = json_decode(file_get_contents('php://input'), true); // Leemos el cuerpo de la solicitud como JSON.

    // Declaramos las variables de los datos que esperamos recibir.
    $id_code  = $data['id_code']  ?? '';
    $email    = $data['email']    ?? '';
    $address  = $data['address']  ?? '';
    $quantity = $data['quantity'] ?? 0;

    // Validamos que tenemos todos los datos
    if (empty($id_code) || empty($email) || empty($address) || $quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Datos insuficientes']);
        exit;
    }

    // Realizamos una consulta preparada para obtener el ID del videojuego y su precio a partir del código de producto.
    $result = mysqli_execute_query($conn, "SELECT videogame_id, price FROM 006_videogames WHERE id_code = ? AND supplier_id = 3 LIMIT 1", [$id_code]);

    $product = mysqli_fetch_assoc($result);

    // Verificamos si el producto existe. Si no existe, devolvemos un mensaje de error.
    if (!$product) {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        exit;
    }

    $total = $product['price'] * $quantity; // Calculamos el total del pedido multiplicando el precio unitario por la cantidad.

    // Realizamos otra consulta preparada para insertar el pedido en la tabla 006_orders.
    $sql = "INSERT INTO 006_orders (videogame_id, quantity, unit_price, total, order_address, order_date)
            VALUES (?, ?, ?, ?, ?, NOW())";

    if (mysqli_execute_query($conn, $sql, [$product['videogame_id'], $quantity, $product['price'], $total, $address])) {
        echo json_encode(['success' => true, 'message' => 'Pedido registrado correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar el pedido']);
    }

    mysqli_close($conn);
?>