<?php

function getDatabaseConnection() {
    // Leer el archivo config.ini
    $config = parse_ini_file('config.ini', true);

    if (!$config) {
        die("Error: No se pudo leer el archivo de configuración.");
    }

    // Extraer los datos de la sección 'database'
    $host = $config['database']['host'];
    $username = $config['database']['username'];
    $password = $config['database']['password'];
    $dbname = $config['database']['dbname'];
    $port = $config['database']['port'];

    // Crear la conexión
    $conn = new mysqli($host, $username, $password, $dbname, $port);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;
}