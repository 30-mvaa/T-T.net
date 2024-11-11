<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include("../config/conexion.php");

// Verificar si se ha recibido el ID del cliente a eliminar a través de la URL
if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Preparar la consulta SQL para eliminar el cliente
    $sql = "DELETE FROM clientes WHERE cedula = '$cedula'";

    // Ejecutar la consulta
    if (mysqli_query($conexion, $sql)) {
        // Si la eliminación es exitosa, redirigir a la página de gestión de clientes
        header("Location: ../vista/gestion_clientes.php?mensaje=Cliente eliminado correctamente");
    } else {
        // Si hay un error, mostrar un mensaje de error
        echo "Error al eliminar el cliente: " . mysqli_error($conexion);
    }
} else {
    // Si no se recibió un ID, redirigir a la página de gestión de clientes
    header("Location: ../vista/gestion_clientes.php");
}


// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
