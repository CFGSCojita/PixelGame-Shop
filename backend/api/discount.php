<?php
    // Aplicamos la configuración CORS para permitir peticiones desde React:
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    // Conexión a la base de datos:
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    $data = json_decode(file_get_contents('php://input'), true); // Obtenemos los datos enviados en el cuerpo de la petición (para POST).
    $user_id = $data['user_id'] ?? $_GET['user_id'] ?? null; // Obtenemos el user_id desde el cuerpo de la petición o desde la URL. Usamos '??' para evitar errores si no está definido.
    $percentage = $data['discount_percentage'] ?? 15; // Por defecto, el descuento es del 15% si no se especifica.

    // Estructura de control 'if'.
    // Si la petición es POST y se proporciona un user_id, generamos un nuevo código de descuento para ese usuario. 
    // Si la petición es GET y se proporciona un user_id, obtenemos los descuentos activos para ese usuario. En caso contrario, devolvemos un error.
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user_id) {
        $code = 'PIXEL-' . strtoupper(bin2hex(random_bytes(4))); // Generamos un código de descuento único.
        $expires = date('Y-m-d H:i:s', strtotime('+30 days')); // El descuento expira en 30 días.
        
        // Preparamos una consulta SQL para insertar el nuevo descuento en la base de datos:
        $stmt = $conn->prepare("INSERT INTO 006_user_discounts (user_id, discount_percentage, discount_code, expires_at) VALUES (?, ?, ?, ?)");

        $stmt->bind_param("idss", $user_id, $percentage, $code, $expires); // Vinculamos los parámetros a la consulta preparada. 'i' para integer, 'd' para double, 's' para string.
        $stmt->execute(); // Ejecutamos la consulta.
        
        echo json_encode(['success' => true, 'code' => $code]); // Devolvemos una respuesta JSON con el código de descuento generado.
    } else if ($_SERVER['REQUEST_METHOD'] === 'GET' && $user_id) {

        // Preparamos una consulta SQL para obtener los descuentos activos del usuario:
        $stmt = $conn->prepare("SELECT * FROM 006_user_discounts WHERE user_id = ? AND used = 0 AND expires_at > NOW()");

        $stmt->bind_param("i", $user_id); // Vinculamos el parámetro user_id a la consulta preparada. 'i' para integer.

        $stmt->execute(); // Ejecutamos la consulta.
        
        echo json_encode(['success' => true, 'data' => $stmt->get_result()->fetch_all(MYSQLI_ASSOC)]); // Devolvemos una respuesta JSON con los descuentos activos del usuario.
    } else {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos']); // Devolvemos una respuesta JSON de error si no se proporcionó un user_id válido o si el método HTTP no es POST o GET.
    }
    
?>