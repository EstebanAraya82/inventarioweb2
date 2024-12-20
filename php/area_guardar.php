<?php
require_once "main.php";

/*== Almacenando datos ==*/
$nombre = limpiar_cadena($_POST['area_nombre']);

/* Verificando campos obligatorios */
if ($nombre == "") {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
    exit();
}


/*== Verificando integridad de los datos ==*/
if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,50}", $nombre)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El nombre no coincide con el formato solicitado
            </div>
        ';
    exit();
}

/* Verificando nombre */
$check_nombre = conexion();
$check_nombre = $check_nombre->query("SELECT area_nombre FROM area WHERE area_nombre='$nombre'");
if ($check_nombre->rowCount() > 0) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                La área ingresada ya se encuentra registrada, por favor elija otra
            </div>
        ';
    exit();
}
$check_nombre = null;


/* Guardando datos */
$guardar_area = conexion();
$guardar_area = $guardar_area->prepare("INSERT INTO area (area_nombre) VALUES(:nombre)");

$marcadores = [
    ":nombre" => $nombre,
];

$guardar_area->execute($marcadores);

if ($guardar_area->rowCount() == 1) {
    echo '
            <div class="notification is-info is-light">
                <strong>¡Categoria registrada exitosamente!</strong><br>
                La área se registro con exito
            </div>
        ';
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo registrar la categoría, por favor intente nuevamente
            </div>
        ';
}
$guardar_area = null;
