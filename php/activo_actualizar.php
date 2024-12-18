<?php
require_once "main.php";

/* Almacenando id */
$id = limpiar_cadena($_POST['activo_id']);


/* Verificando activo */
$check_activo = conexion();
$check_activo = $check_activo->query("SELECT * FROM activo WHERE activo_id='$id'");

if ($check_activo->rowCount() <= 0) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El equipo no existe en el sistema
            </div>
        ';
    exit();
} else {
    $datos = $check_activo->fetch();
}
$check_activo = null;


/* Almacenando datos */
$codigo = limpiar_cadena($_POST['activo_codigo']);
$marca = limpiar_cadena($_POST['activo_marca']);
$modelo = limpiar_cadena($_POST['activo_modelo']);
$serial = limpiar_cadena($_POST['activo_serial']);
$categoria = limpiar_cadena($_POST['activo_categoria']);
$piso = limpiar_cadena($_POST['activo_piso']);
$posicion = limpiar_cadena($_POST['activo_posicion']);
$area = limpiar_cadena($_POST['activo_area']);
$sector = limpiar_cadena($_POST['activo_sector']);
$estadoactivo = limpiar_cadena($_POST['activo_estado']);




/* Verificando campos obligatorios */
if ($codigo == "" || $marca == "" || $modelo == "" || $serial == "" | $categoria == "" || $piso == "" || $posicion == "" || $area == "" || $sector == "" || $estadoactivo == "") {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
    exit();
}


/* Verificando integridad de los datos */
if (verificar_datos("[0-9]{3,50}", $codigo)) {
    echo '
                <div class="notification is-danger is-light">
                    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    El COdigo no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,50}", $marca)) {
    echo '
                <div class="notification is-danger is-light">
                    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    La marca no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{2,50}", $modelo)) {
    echo '
                <div class="notification is-danger is-light">
                    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    El modelo no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9]{3,50}", $serial)) {
    echo '
                <div class="notification is-danger is-light">
                    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    El serial no coincide con el formato solicitado
                </div>
            ';
    exit();
}


// if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}", $sector)) {
//     echo '
//                  <div class="notification is-danger is-light">
//                      <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
//                       El sector no coincide con el formato solicitado
//                 </div>
//             ';
//     exit();
// }


/* Verificando categoria */
if ($categoria != $datos['categoria_id']) {
    $check_categoria = conexion();
    $check_categoria = $check_categoria->query("SELECT categoria_id FROM categoria WHERE categoria_id='$categoria'");
    if ($check_categoria->rowCount() <= 0) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                La categoría seleccionada no existe
	            </div>
	        ';
        exit();
    }
    $check_categoria = null;
}

/* Verificando piso */
if ($piso != $datos['piso_id']) {
    $check_piso = conexion();
    $check_piso = $check_piso->query("SELECT piso_id FROM piso WHERE piso_id='$piso'");
    if ($check_piso->rowCount() <= 0) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El piso seleccionada no existe
	            </div>
	        ';
        exit();
    }
    $check_piso = null;
}

/* Verificando posición */
if ($posicion != $datos['posicion_id']) {
    $check_posicion = conexion();
    $check_posicion = $check_posicion->query("SELECT posicion_id FROM posicion WHERE posicion_id='$posicion'");
    if ($check_posicion->rowCount() <= 0) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                La posición seleccionada no existe
	            </div>
	        ';
        exit();
    }
    $check_posicion = null;
}

/* Verificando área */
if ($area != $datos['area_id']) {
    $check_area = conexion();
    $check_area = $check_area->query("SELECT area_id FROM area WHERE area_id='$area'");
    if ($check_area->rowCount() <= 0) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                La área seleccionada no existe
	            </div>
	        ';
        exit();
    }
    $check_area = null;
}

/* Verificando sector */
if ($sector != $datos['sector_id']) {
    $check_sector = conexion();
    $check_sector = $check_sector->query("SELECT sector_id FROM sector WHERE sector_id='$sector'");
    if ($check_sector->rowCount() <= 0) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El sector seleccionado no existe
	            </div>
	        ';
        exit();
    }
    $check_sector = null;
}

/* Verificando estado activo */
if ($estadoactivo != $datos['estadoactivo_id']) {
    $check_estadoactivo = conexion();
    $check_estadoactivo = $check_estadoactivo->query("SELECT estadoactivo_id FROM activo WHERE estadoactivo_id='$estadoactivo'");
    if ($check_estadoactivo->rowCount() <= 0) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El estado seleccionado no existe
	            </div>
	        ';
        exit();
    }
    $check_estadoactivo = null;
}





/* Actualizando datos */
$actualizar_activo = conexion();
$actualizar_activo = $actualizar_activo->prepare("UPDATE activo SET activo_codigo=:codigo,activo_marca=:marca,activo_modelo=:modelo,activo_serial=:serial,categoria_id=:categoria,
    piso_id=:piso,posicion_id=:posicion,area_id=:area,sector_id=:sector,estadoactivo_id=:estadoactivo WHERE activo_id=:id");

$marcadores = [
    ":codigo" => $codigo,
    ":marca" => $marca,
    ":modelo" => $modelo,
    ":serial" => $serial,
    ":categoria" => $categoria,
    ":piso" => $piso,
    ":posicion" => $posicion,
    ":area" => $area,
    ":sector" => $sector,
    ":estadoactivo" => $estadoactivo,
    ":id" => $id
       
];


if ($actualizar_activo->execute($marcadores)) {
    echo '
            <div class="notification is-info is-light">
                <strong>¡Activo Actualizado!</strong><br>
                El activo se actualizo con exito
            </div>
        ';
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el activo, por favor intente nuevamente
            </div>
        ';
}
$actualizar_activo = null;
