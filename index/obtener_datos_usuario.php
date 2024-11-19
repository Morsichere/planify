<?php
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['id'])) {
    // Preparar los datos del usuario
    $response = array(
        'id' => $_SESSION['id'],
        'nombreUsuario' => $_SESSION['nombreUsuario'],
        'nombreCompleto' => $_SESSION['nombreCompleto'],
        'correoElectronico' => $_SESSION['correoElectronico']
    );

    // Devolver los datos en formato JSON
    echo json_encode($response);
} else {
    // Si no está autenticado, devolver un error
    echo json_encode(array('error' => 'Usuario no autenticado'));
}
?>
