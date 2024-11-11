<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include("../config/conexion.php");

// Obtener el valor de búsqueda si existe
$buscar_cedula = isset($_GET['cedula']) ? trim($_GET['cedula']) : '';

// Validar si se ha ingresado una cédula para buscar
if (empty($buscar_cedula)) {
    echo '<tr><td colspan="8" style="color: red; text-align: center;">No se encontró ningún cliente con la cédula: ' . htmlspecialchars($cedula) . '</td></tr>';
   
} else {
    // Consultar los clientes, filtrando por cédula
    $sql = "SELECT * FROM clientes WHERE cedula LIKE '%" . mysqli_real_escape_string($conexion, $buscar_cedula) . "%'";
    $resultado = mysqli_query($conexion, $sql);

    // Contar el número de filas encontradas
    $num_rows = mysqli_num_rows($resultado);

    // Mostrar un mensaje si no se encontraron resultados
    if ($num_rows === 0) {
        echo '<tr><td colspan="8" style="color: red; text-align: center;">No se encontró ningún cliente con la cédula: ' . htmlspecialchars($buscar_cedula) . '</td></tr>';
    } else {
        // Mostrar los resultados
        while ($cliente = mysqli_fetch_array($resultado)) {
            ?>
            <tr>
                <td><?php echo htmlspecialchars($cliente['cedula']); ?></td>
                <td><?php echo htmlspecialchars($cliente['nombres']); ?></td>
                <td><?php echo htmlspecialchars($cliente['fecha_nacimiento']); ?></td>
                <td><?php echo htmlspecialchars($cliente['direccion']); ?></td>
                <td><?php echo htmlspecialchars($cliente['sector']); ?></td>
                <td><?php echo htmlspecialchars($cliente['tarifa']); ?></td>
                <td>
                    <!-- Ícono para modificar -->
                    <a href="#" onclick="mostrarFormulario('<?php echo htmlspecialchars($cliente['cedula']); ?>')">
                        <img src="../images/modificar.jfif" alt="Modificar">
                    </a>
                </td>
                <td>
                    <!-- Ícono para eliminar -->
                    <a href="../modelo/eliminar_cliente.php?cedula=<?php echo urlencode($cliente['cedula']); ?>" onclick="return confirm('¿Estás seguro de eliminar este cliente?')">
                        <img src="../images/eliminar.jfif" alt="Eliminar">
                    </a>
                </td>
            </tr>
            <!-- Fila oculta con el formulario de modificación -->
            <tr id="form-<?php echo htmlspecialchars($cliente['cedula']); ?>" style="display:none;">
                <td colspan="8">
                    <form action="../modelo/actualizar_cliente.php" method="POST">
                        <input type="hidden" name="cedula" value="<?php echo htmlspecialchars($cliente['cedula']); ?>">
                        
                        <label for="nombres">Nombres:</label>
                        <input type="text" name="nombres" value="<?php echo htmlspecialchars($cliente['nombres']); ?>"><br>

                        <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" value="<?php echo htmlspecialchars($cliente['fecha_nacimiento']); ?>"><br>

                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>"><br>

                        <label for="sector">Sector:</label>
                        <input type="text" name="sector" value="<?php echo htmlspecialchars($cliente['sector']); ?>"><br>

                        <label for="tarifa">Tarifa:</label>
                        <input type="text" name="tarifa" value="<?php echo htmlspecialchars($cliente['tarifa']); ?>"><br>

                        <input type="submit" value="Actualizar Cliente">
                    </form>
                </td>
            </tr>
            <?php
        }
    }
}
?>
