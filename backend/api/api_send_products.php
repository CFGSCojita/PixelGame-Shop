<?php
    // Conexión a la base de datos:
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include($root_DIR . '/student006/shop/backend/config/db_connect.php');

    // Configuración de headers para API:
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    $api_key = $_GET['api_key'] ?? ''; // Obtenemos la API key desde la URL. Usamos '??' para evitar errores si no está definida.

    // Realizamos una consulta para seleccionar el vendedor asociado a la API key:
    $sql = "SELECT seller_id FROM 006_sellers WHERE api_key = '$api_key' LIMIT 1";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

    $seller = mysqli_fetch_assoc($result); // Obtenemos el vendedor como un array asociativo.
    $seller_id = $seller['seller_id'] ?? ''; // Obtenemos el seller_id o una cadena vacía si no existe.

    // Estructura de control 'if'.
    // Si no se encuentra un vendedor con la API key proporcionada, devolvemos un error y salimos del script.
    // En caso contrario, continuamos con la ejecución normal del script.
    if (empty($seller_id)) {
        // Respuesta de error:
        echo json_encode([
            'success' => false,
            'error' => 'API key inválida o no autorizada'
        ]);
        mysqli_close($conn); // Cerramos la conexión a la base de datos.
        exit; // Salimos del script.
    }

    // Realizamos una consulta para obtener el id, título y precio de los videojuegos:
    $sql = "SELECT videogame_id, title, price 
        FROM 006_videogames 
        WHERE videogame_id in (SELECT product_id FROM 006_product_sellers WHERE seller_id = '$seller_id')";

    $result = mysqli_query($conn, $sql); // Ejecutamos la consulta.

    // Estructura de control 'if'.
    // Si la consulta falla, devolvemos un error y salimos del script.
    if (!$result) {
        // Respuesta de error:
        echo json_encode([
            'success' => false,
            'error' => 'Error en la consulta',
            'details' => mysqli_error($conn)
        ]);
        mysqli_close($conn); // Cerramos la conexión a la base de datos.
        exit; // Salimos del script.
    }

    $products = mysqli_fetch_all($result, MYSQLI_ASSOC); // Obtenemos todos los productos como un array asociativo.

    // Respuesta exitosa:
    echo json_encode([
        'success' => true,
        'total' => count($products),
        'products' => $products
    ]);

    mysqli_close($conn); // Cerramos la conexión a la base de datos.
?>