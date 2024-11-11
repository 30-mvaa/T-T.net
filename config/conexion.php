<?php

$servername = "localhost";
$database = "t&t";
$username = "root";
$password = "";

// Crear la conexión
$conexion = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conexion) {  // Cambié de $conn a $conexion para mantener consistencia
    die("Connection failed: " . mysqli_connect_error());
}



?>
