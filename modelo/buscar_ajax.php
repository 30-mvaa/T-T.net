<?php
include("../config/conexion.php");

header('Content-Type: application/json');

$cedula = isset($_GET['cedula']) ? htmlspecialchars($_GET['cedula']) : '';

if ($cedula) {
    $stmt = $conexion->prepare("SELECT * FROM clientes WHERE cedula = ?");
    $stmt->bind_param("s", $cedula);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);

    $stmt->close();
} else {
    echo json_encode([]);
}

$conexion->close();
?>
