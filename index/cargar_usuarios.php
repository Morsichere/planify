<?php
require_once 'db_connection.php';

$conn = getDatabaseConnection();

// Consulta para obtener los usuarios
$sql = "SELECT nombreUsuario FROM usuariosPlanify";
$result = $conn->query($sql);

// Mostrar los usuarios en el select
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['nombreUsuario'] . "'>" . $row['nombreUsuario'] . "</option>";
    }
} else {
    echo "<option>No hay usuarios disponibles</option>";
}

// Cerrar la conexión
$conn->close();
?>
