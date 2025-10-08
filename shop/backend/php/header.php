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
        
        :root {
            --color-primary: #FF3366;
            --color-accent: #00CCFF;
            --color-bg: #0A0A0A;
            --color-card-bg: #1A1A1A;
            --color-text: #FCFCFC;
            --color-text-secondary: #E6E6E6;
        }
        
        body {
            background-color: var(--color-bg);
            color: var(--color-text-secondary);
            min-height: 100vh;
        }
        
        .header-custom {
            background-color: var(--color-card-bg);
            border-bottom: 2px solid #2A2A2A;
        }
        
        .brand-logo {
            color: var(--color-text);
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .brand-logo:hover {
            color: var(--color-primary);
        }

    </style>
</head>
<body>
    <header class="header-custom py-3">
        <div class="container">
            <div class="text-center">
                <a href="/student006/shop/backend/php/index.php" class="brand-logo">
                    Panel de Administración
                </a>
            </div>
        </header>