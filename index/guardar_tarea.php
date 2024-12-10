<?php
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = getDatabaseConnection();

// Recoger los datos enviados por el formulario
$task_name = $_POST['task_name'];
$task_users = explode(',', $_POST['task_user']); // Array con múltiples usuarios
$task_start = $_POST['task_start'];
$task_deadline = $_POST['task_deadline'];

// Verificar si los datos son válidos antes de proceder
if (empty($task_name) || empty($task_users) || empty($task_start) || empty($task_deadline)) {
    echo "Error: Todos los campos son obligatorios.";
    exit();
}

// Comenzar una transacción para guardar las tareas
$conn->begin_transaction();

try {
    // Insertar la tarea en la tabla de tareas para cada usuario
    foreach ($task_users as $user) {
        $sql = "INSERT INTO tareas (nombre_tarea, usuario, fecha_inicio, fecha_limite) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $task_name, $user, $task_start, $task_deadline);
        $stmt->execute();
    }

    // Confirmar la transacción
    $conn->commit();
    echo "Tarea creada exitosamente para los usuarios seleccionados.";
} catch (Exception $e) {
    // Si hay un error, deshacer la transacción
    $conn->rollback();
    echo "Error al crear la tarea: " . $e->getMessage();
}

// Cerrar la conexión
$conn->close();
?>
