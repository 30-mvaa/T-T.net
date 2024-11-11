<?php
// PHP al inicio del archivo para manejar la sesión y cerrar sesión si es necesario
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'logout') {
    session_unset();
    session_destroy();

    // Configurar encabezados para evitar el almacenamiento en caché de la página
    header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
    header('Pragma: no-cache'); // HTTP 1.0.
    header('Expires: 0'); // Proxies.

    // Enviar una respuesta de éxito
    echo 'success';
    exit();
}

// Si no se está haciendo una solicitud de cierre de sesión, el resto del código HTML sigue aquí
?>