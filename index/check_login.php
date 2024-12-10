<?php
// Iniciar sesión
session_start();

require_once 'db_connection.php';

$conn = getDatabaseConnection();

// Recoger los datos enviados por el formulario
$loginUsuario = $_POST['loginUsuario'];
$loginContrasena = $_POST['loginContrasena'];

// Buscar el nombre de usuario en la base de datos
$sql = "SELECT * FROM usuariosPlanify WHERE nombreUsuario = '$loginUsuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si el usuario existe, verificar la contraseña
    $row = $result->fetch_assoc();
    
    if (password_verify($loginContrasena, $row['contrasena'])) {
        // Contraseña correcta, guardar los datos del usuario en la sesión
        $_SESSION['id'] = $row['id'];
        $_SESSION['nombreUsuario'] = $row['nombreUsuario'];
        $_SESSION['correoElectronico'] = $row['correoElectronico'];
        $_SESSION['nombreCompleto'] = $row['nombreCompleto'];

        // Redirigir al usuario a la página de usuario
        header("Location: http://planify-1ppq.onrender.com/PaginaUsuario.html");
        exit(); // Asegura que el script se detenga después de la redirección
    } else {
        // Contraseña incorrecta, redirigir al login con el parámetro de error
        header("Location: http://planify-1ppq.onrender.com/Login.html?error=incorrect_password");
        exit();
    }
} else {
    // Usuario no encontrado, redirigir al login con el parámetro de error
    header("Location: http://planify-1ppq.onrender.com/Login.html?error=user_not_found");
    exit();
}

// Cerrar la conexión
$conn->close();
?>
