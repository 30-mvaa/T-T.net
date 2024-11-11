<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto si tu servidor de base de datos está en otro lugar
$username = "root"; // Reemplaza con tu usuario de la base de datos
$password = ""; // Reemplaza con tu contraseña de la base de datos
$dbname = "t&t"; // Reemplaza con el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$tipo_gasto = $_POST['expenseType'];
$monto = $_POST['amount'];
$descripcion = $_POST['description'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO gastos (tipo_gasto, monto, descripcion) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sds", $tipo_gasto, $monto, $descripcion);

if ($stmt->execute()) {
    // Redirigir a una página de éxito con un mensaje de alerta
    echo "<script>
        alert('Gasto registrado con éxito.');
       window.location.href = '../vista/admi.html';// Reemplaza con la URL a la que deseas redirigir
    </script>";
} else {
    // Mostrar un mensaje de error si la consulta falla
    echo "<script>
        alert('Error al registrar el gasto: " . $stmt->error . "');
        window.location.href = '../vista/admi.html'; // Reemplaza con la URL a la que deseas redirigir
    </script>";
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
