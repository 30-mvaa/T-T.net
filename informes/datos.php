<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Cambiar si es necesario
$password = ""; // Cambiar si es necesario
$dbname = "t&t"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar la recaudación mensual de la tabla `pagos`
$sql_ingresos = "SELECT MONTH(fecha_pago) as mes, SUM(recaudacion) as total_ingreso 
                 FROM pagos GROUP BY MONTH(fecha_pago)";
$result_ingresos = $conn->query($sql_ingresos);

$ingresos_data = [];
$meses = [];
if ($result_ingresos->num_rows > 0) {
    while($row = $result_ingresos->fetch_assoc()) {
        $meses[] = $row["mes"]; // Los meses en el eje X
        $ingresos_data[] = $row["total_ingreso"]; // Ingresos por mes
    }
}

// Consultar el egreso de la tabla `gastos`
$sql_egresos = "SELECT SUM(monto) as total_egreso FROM gastos";
$result_egresos = $conn->query($sql_egresos);
$total_egreso = 0;

if ($result_egresos->num_rows > 0) {
    $row = $result_egresos->fetch_assoc();
    $total_egreso = $row["total_egreso"]; // Total de egresos
}

// Calcular el saldo (Ingresos totales - Egresos)
$total_ingreso = array_sum($ingresos_data);
$saldo = $total_ingreso - $total_egreso;

// Preparar los datos para enviarlos en formato JSON
$data = [
    'meses' => $meses,
    'ingresos' => $ingresos_data,
    'egresos' => $total_egreso,
    'saldo' => $saldo,
    'total_ingreso' => $total_ingreso
];

echo json_encode($data);

// Cerrar la conexión
$conn->close();
?>


