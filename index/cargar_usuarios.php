<?php
// Conexión a la base de datos
$servername = "mysql-planify.alwaysdata.net"; // MySQL Hostname proporcionado
$username = "planify";             // MySQL Username proporcionado
$password = "proyecto1";            // MySQL Password proporcionada (haz clic en "Show/Hide")
$dbname = "planify_1";       // Nombre de la base de datos
$port = 3306;                           // MySQL Port (por defecto)

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
