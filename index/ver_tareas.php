<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['nombreUsuario'])) {
    echo 'Usuario no autenticado';
    exit;
}

require_once 'db_connection.php';

$conn = getDatabaseConnection();

// Obtener el usuario autenticado
$nombreUsuario = $_SESSION['nombreUsuario'];

// Buscar las tareas donde esté involucrado el usuario
$sql = "SELECT * FROM tareas WHERE usuario LIKE '%$nombreUsuario%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>Tarea:</strong> " . $row['nombre_tarea'] . " | <strong>Usuarios:</strong> " . $row['usuario'] . " | <strong>Fecha Inicio:</strong> " . $row['fecha_inicio'] . " | <strong>Fecha Límite:</strong> " . $row['fecha_limite'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No hay tareas para mostrar.";
}

// Cerrar la conexión
$conn->close();
?>
