<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Sin contraseña por defecto en XAMPP
$dbname = "planify"; // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
