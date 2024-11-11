<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "t&t";

$conexion = mysqli_connect($servername, $username, $password, $database);

if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si las claves existen en el array $_POST
    if (isset($_POST['usuario']) && isset($_POST['contrasenia'])) {
        $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
        $pass = mysqli_real_escape_string($conexion, $_POST['contrasenia']);
        
        // Encriptar la contraseña con password_hash
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        // Asegúrate de que el nombre de la tabla es correcto
        $sql = "INSERT INTO administrador (usuario, contrasenia) VALUES ('$user', '$hashed_password')";
        
        if (mysqli_query($conexion, $sql)) {
            echo "<script>
                alert('Administrador registrado con éxito.');
                window.location.href = '../vista/admi.html'; // Reemplaza con la URL a la que deseas redirigir
            </script>";
        } else {
            echo "Error al registrar el administrador: " . mysqli_error($conexion);
        }
    } else {
        echo "Los campos 'usuario' y 'contrasenia' son requeridos.";
    }
    
    mysqli_close($conexion);
}
?>
