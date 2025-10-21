<?php

    // Estructura de control 'if'.
    // Iniciamos la sesión si no está ya iniciada
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    /**
     * Verificamos si el usuario está autenticado
     * @return bool - true si está autenticado, false si no.
     */
    function isLoggedIn() {
        return isset($_SESSION['user_id']) && isset($_SESSION['role']);
    }

    /**
     * Verificamos si el usuario tiene un rol específico
     * @param string $role - El rol a verificar ('admin', 'user', 'guest').
     * @return bool - true si el usuario tiene ese rol, false si no.
     */
    function hasRole($role) {
        return isLoggedIn() && $_SESSION['role'] === $role;
    }

    /**
     * Verificamos si el usuario es administrador.
     * @return bool
     */
    function isAdmin() {
        return hasRole('admin');
    }

    /**
     * Redirigimos al login si el usuario no está autenticado.
     */
    function requireLogin() {
        if (!isLoggedIn()) {
            header('Location: /student006/shop/backend/forms/form_login.php');
            exit();
        }
    }

    /**
     * Redirigimos al login si el usuario no es administrador.
     */
    function requireAdmin() {
        if (!isAdmin()) {
            header('Location: /student006/shop/backend/forms/form_login.php?error=no_permission');
            exit();
        }
    }

    /**
     * Obtenemos el nombre del usuario actual.
     * @return string|null
     */
    function getCurrentUserName() {
        return $_SESSION['user_name'] ?? null;
    }

    /**
     * Obtenemos el ID del usuario actual.
     * @return int|null
     */
    function getCurrentUserId() {
        return $_SESSION['user_id'] ?? null;
    }
    
    /**
     * Cerramos la sesión y redirigimos al login.
     */
    function logout() {
        session_unset(); // Eliminamos todas las variables de sesión.
        session_destroy(); // Destruimos la sesión.
        header('Location: /student006/shop/backend/forms/form_login.php');
        exit();
    }
?>