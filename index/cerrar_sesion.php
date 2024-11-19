<?php
session_start(); // Inicia la sesión

// Limpiar todas las variables de sesión
$_SESSION = [];

// Si se utilizan cookies de sesión, destruirlas
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio
header("Location: index.html");
exit(); // Asegura que el script se detenga después de la redirección
?>

