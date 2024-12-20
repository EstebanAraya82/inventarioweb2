<?php
session_start();

// Verificar que el usuario tiene el rol adecuado antes de realizar la eliminación
if (isset($_SESSION['rol_id']) && $_SESSION['rol_id'] == 1) { // rol_id = 1 corresponde a "admin"

    // Recuperar el ID del activo que se desea "eliminar" (en realidad, desactivar)
    $asset_id_del = limpiar_cadena($_GET['asset_id_del']);

    // Conexión a la base de datos
    $conexion = conexion();

    // Verificar si el activo existe
    $check_activo = $conexion->query("SELECT * FROM activo WHERE activo_id='$asset_id_del'");

    if ($check_activo->rowCount() == 1) {

        // Realizar la acción de actualizar el estado del activo a "baja" (estadoactivo_id = 7)
        $eliminar_activo = $conexion->prepare("UPDATE activo SET estadoactivo_id = 7 WHERE activo_id = :id");
        $eliminar_activo->execute([":id" => $asset_id_del]);

        if ($eliminar_activo->rowCount() == 1) {
            echo '
                <div class="notification is-info is-light">
                    <strong>¡Activo desactivado!</strong><br>
                    El activo ha sido dado de baja con éxito.
                </div>
            ';
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Error!</strong><br>
                    No se pudo dar de baja el activo. Intenta nuevamente.
                </div>
            ';
        }
        $eliminar_activo = null;
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong><br>
                El activo no existe.
            </div>
        ';
    }

} else {
    // Si el usuario no tiene el rol adecuado, mostrar un mensaje
    echo "No tienes permisos para eliminar este activo.";
    exit; // Detener el script si no tiene permisos
}
?>
