<?php
    // Incluimos la configuración de sesión y verificamos autenticación
    $root_DIR = $_SERVER['DOCUMENT_ROOT'];
    include_once($root_DIR . '/student006/shop/backend/config/session_config.php');
    
    requireLogin();
    
    requireAdmin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration Panel - PixelGame Shop</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        
        /* Guardamos la paleta de colores del proyecto. */
        :root {
            --color-primary: #FF3366;
            --color-accent: #00CCFF;
            --color-bg: #0A0A0A;
            --color-card-bg: #1A1A1A;
            --color-text: #FCFCFC;
            --color-text-secondary: #E6E6E6;
        }

        /* Cuerpo de la página. */
        body {
            background-color: var(--color-bg);
            color: var(--color-text-secondary);
            display: flex; 
            flex-direction: column; 
            min-height: 100vh;
        }
        
        .content-wrapper {
            flex-grow: 1;
        }

        /* Navbar unificado */
        .navbar-unificado {
            background-color: var(--color-card-bg);
            border-bottom: 2px solid #2A2A2A;
        }
        
        /* Texto del título */
        .titulo {
            color: var(--color-text);
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .titulo:hover {
            color: var(--color-primary);
        }

        /* Enlaces de navegación */
        .nav-link-personalizado {
            color: var(--color-text-secondary) !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-link-personalizado:hover {
            color: var(--color-primary) !important;
        }

        /* Estilos simples para logout */
        .logout-link {
            color: var(--color-primary) !important;
            text-decoration: none;
            font-weight: 600;
        }

        .logout-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-unificado py-3">
        <div class="container">
            <a href="/student006/shop/backend/index.php" class="navbar-brand titulo p-0">
                Panel de Administración - PixelGame Shop
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border-color: var(--color-primary);">
                <i class="bi bi-list" style="color: var(--color-primary);"></i>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-link-personalizado" aria-current="page" href="/student006/shop/backend/php/videogames.php">Videojuegos <i class="bi bi-controller"></i></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-link-personalizado" href="/student006/shop/backend/php/users.php">Usuarios <i class="bi bi-people"></i></a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link nav-link-personalizado" href="/student006/shop/backend/php/orders.php">Pedidos <i class="bi bi-box-seam"></i></a>
                    </li>
                    <li class="nav-item mx-2">
                        <span style="color: var(--color-accent);">
                            <i class="bi bi-person-circle"></i>
                            <?php echo htmlspecialchars(getCurrentUserName()); ?>
                        </span>
                        |
                        <a href="/student006/shop/backend/php/logout.php" class="logout-link">
                            Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="content-wrapper">