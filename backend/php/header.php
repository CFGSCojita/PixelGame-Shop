<?php
    // Iniciamos la sesión
    session_start();

    // Estructura de control 'if'.
    // Si el usuario cambia el idioma (viene por GET), guardamos la cookie.
    if (isset($_GET['lang'])) {
        $idioma = $_GET['lang'];
        
        // Validamos que sea un idioma permitido.
        $idiomas_permitidos = ['es', 'en', 'fr'];
        
        if (in_array($idioma, $idiomas_permitidos)) {
            // Guardamos la cookie por 30 días.
            setcookie('idioma_usuario', $idioma, time() + (30 * 24 * 60 * 60), '/');
            $_COOKIE['idioma_usuario'] = $idioma;
        }
    }
    
    // Obtenemos el idioma actual (cookie o español por defecto).
    $idioma_actual = isset($_COOKIE['idioma_usuario']) ? $_COOKIE['idioma_usuario'] : 'es';

    // Estructura de control 'if'.
    // Verificamos si el usuario está autenticado y tiene permisos.
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
        header('Location: /student006/shop/backend/forms/form_login.php?error=session_required');
        exit();
    }

    // Estructura de control 'if'.
    // Si el usuario es 'guest', no puede acceder al backend.
    if ($_SESSION['role'] === 'guest') {
        header('Location: /student006/shop/backend/forms/form_login.php?error=no_permission');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="<?php echo $idioma_actual; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Panel - PixelGame Shop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- CSS -->
    <link rel="stylesheet" href="/student006/shop/css/header-php.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-unificado py-3">
        <!-- Contenedor principal -->
        <div class="container">
            <!-- Título -->
            <a href="/student006/shop/backend/index.php" class="navbar-brand titulo p-0">
                <?php echo ($_SESSION['role'] === 'admin') ? 'Panel de Admin' : 'Mi Cuenta'; ?> - PixelGame Shop
            </a>

            <!-- Botón de menú colapsable -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: var(--color-primary);">
                <i class="bi bi-list" style="color: var(--color-primary);"></i>
            </button>

            <!-- Menú de navegación colapsable -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Lista de enlaces -->
                <ul class="navbar-nav ms-auto">
                    <!-- Ítems del navbar -->
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-link-personalizado" aria-current="page" href="/student006/shop/backend/php/videogames.php">Videojuegos <i class="bi bi-controller"></i></a>
                    </li>

                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <!-- Solo admin puede ver estas opciones -->
                        <li class="nav-item mx-2">
                            <a class="nav-link nav-link-personalizado" href="/student006/shop/backend/php/users.php">Usuarios <i class="bi bi-people"></i></a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item mx-2">
                        <a class="nav-link nav-link-personalizado" href="/student006/shop/backend/php/orders.php">
                            <?php echo ($_SESSION['role'] === 'customer') ? 'Mis Pedidos' : 'Pedidos'; ?>
                            <i class="bi bi-box-seam"></i>
                        </a>
                    </li>

                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item mx-2 dropdown">
                            <a class="nav-link nav-link-personalizado dropdown-toggle" 
                            href="#" 
                            id="navbarDropdown" 
                            role="button" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                                Manuales <i class="bi bi-book"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="/student006/shop/backend/php/manual_tecnico.php">Manual Técnico</a></li>
                                <li><a class="dropdown-item" href="/student006/shop/backend/php/manual_instalacion.php">Manual de Instalación</a></li>
                                <li><a class="dropdown-item" href="/student006/shop/backend/php/manual_usuario.php">Manual de Usuario</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item mx-2">
                        <a class="nav-link nav-link-personalizado" href="/student006/shop/backend/php/cart.php">
                            <i class="bi bi-cart"></i>
                            <span class="badge bg-danger"><?php echo isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></span>
                        </a>
                    </li>

                    <li class="nav-item mx-2">
                        <!-- Usuario actual -->
                        <span style="color: var(--color-accent);">
                            <i class="bi bi-person-circle"></i>
                            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                        </span>
                        |
                        <!-- Enlace de cierre de sesión -->
                        <a href="/student006/shop/backend/php/logout.php" class="logout-link">
                            Cerrar Sesión
                        </a>
                        |
                        <!-- Selector de idiomas -->
                        <div class="dropdown d-inline">
                            <button class="btn btn-sm dropdown-toggle selector-idioma" type="button" id="selectorIdioma" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-translate"></i>
                                <?php 
                                    // Mostramos el idioma actual con su bandera.
                                    $idiomas = [
                                        'es' => 'ES 🇪🇸',
                                        'en' => 'EN 🇬🇧',
                                        'fr' => 'FR 🇫🇷'
                                    ];
                                    echo $idiomas[$idioma_actual];
                                ?>
                            </button>
                            <!-- Opciones de idiomas -->
                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="selectorIdioma">
                                <li>
                                    <a class="dropdown-item <?php echo ($idioma_actual === 'es') ? 'active' : ''; ?>" 
                                       href="?lang=es">
                                        🇪🇸 Español
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php echo ($idioma_actual === 'en') ? 'active' : ''; ?>" 
                                       href="?lang=en">
                                        🇬🇧 English
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item <?php echo ($idioma_actual === 'fr') ? 'active' : ''; ?>" 
                                       href="?lang=fr">
                                        🇫🇷 Français
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-wrapper">