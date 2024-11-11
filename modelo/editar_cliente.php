<?php
// Incluir el archivo de configuración para la conexión a la base de datos
include("../config/conexion.php");

// Consultar todos los clientes
$sql ="SELECT * FROM clientes";
$resultado = mysqli_query($conexion, $sql);

while($cliente = mysqli_fetch_array($resultado)){
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
            <a href="#" onclick="mostrarFormulario('<?php echo $cliente['cedula']; ?>')">
                <img src="../images/modificar.jfif" alt="Modificar">
            </a>
        </td>
       
    </tr>
    <!-- Fila oculta con el formulario de modificación -->
    <tr id="form-<?php echo $cliente['cedula']; ?>" style="display:none;">
        <td colspan="8">
            <form action="../modelo/actualizar_cliente.php" method="POST">
                <input type="hidden" name="cedula" value="<?php echo $cliente['cedula']; ?>">
                
                <label for="nombres">Nombres:</label>
                <input type="text" name="nombres" value="<?php echo $cliente['nombres']; ?>"><br>

                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" value="<?php echo $cliente['fecha_nacimiento']; ?>"><br>

                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" value="<?php echo $cliente['direccion']; ?>"><br>

                <label for="sector">Sector:</label>
                <input type="text" name="sector" value="<?php echo $cliente['sector']; ?>"><br>

                <label for="tarifa">Tarifa:</label>
                <input type="text" name="tarifa" value="<?php echo $cliente['tarifa']; ?>"><br>

                <input type="submit" value="Actualizar Cliente">
            </form>
        </td>
    </tr>
    <link rel="stylesheet" href="../css/gestion_cliente.css">
    <script>
    function mostrarFormulario(cedula) {
        var formulario = document.getElementById('form-' + cedula);
        if (formulario.style.display === 'none') {
            formulario.style.display = 'table-row';
        } else {
            formulario.style.display = 'none';
        }
    }
    </script>
    <?php
    
    
}
?>