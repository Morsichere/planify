<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Servidor local (XAMPP)
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // Sin contraseña por defecto
$dbname = "planify"; // El nombre de la base de datos que creaste

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recoger los datos enviados por el formulario
$nombreCompleto = $_POST['nombreCompleto'];
$nombreUsuario = $_POST['nombreUsuario'];
$correo = $_POST['correoElectronico'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$contrasena = $_POST['contrasena'];

// Verificar si el nombre de usuario o el correo ya existen
$sqlUsuario = "SELECT * FROM usuariosPlanify WHERE nombreUsuario = '$nombreUsuario'";
$sqlCorreo = "SELECT * FROM usuariosPlanify WHERE correoElectronico = '$correo'";
$resultUsuario = $conn->query($sqlUsuario);
$resultCorreo = $conn->query($sqlCorreo);

// Verificar si el nombre de usuario ya existe
if ($resultUsuario->num_rows > 0) {
    echo "<script>alert('Error: El nombre de usuario ya existe.'); window.history.back();</script>";
    exit();
}

// Verificar si el correo electrónico ya existe
if ($resultCorreo->num_rows > 0) {
    echo "<script>alert('Error: El correo electrónico ya existe.'); window.history.back();</script>";
    exit();
}

// Verificar si la fecha de nacimiento es válida
$fechaActual = date("Y-m-d");
if ($fechaNacimiento > $fechaActual) {
    echo "<script>alert('Error: La fecha de nacimiento no puede ser superior a la fecha actual.'); window.history.back();</script>";
    exit();
}

// Cifrar la contraseña antes de guardarla en la base de datos
$hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

// SQL para insertar los datos en la tabla 'usuariosPlanify'
$sql = "INSERT INTO usuariosPlanify (nombreCompleto, nombreUsuario, correoElectronico, fechaNacimiento, contrasena) 
        VALUES ('$nombreCompleto', '$nombreUsuario', '$correo', '$fechaNacimiento', '$hashed_password')";

// Ejecutar la consulta y comprobar si se insertó correctamente
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Registro exitoso!'); window.location.href='login.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
