<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $sector = $_POST['sector'];
    $tarifa = $_POST['tarifa'];

    // Consulta SQL para actualizar el cliente
    $sql = "UPDATE clientes SET 
            nombres = '$nombres', 
            fecha_nacimiento = '$fecha_nacimiento', 
            direccion = '$direccion', 
            sector = '$sector', 
            tarifa = '$tarifa'
            WHERE cedula = '$cedula'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        header("Location: ../vista/gestion_clientes.php?mensaje=Cliente actualizado correctamente");
    } else {
        echo "Error al actualizar el cliente: " . mysqli_error($conexion);
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
