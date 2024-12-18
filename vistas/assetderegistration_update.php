<?php
require_once "main.php";

/* Almacenando id */
$id = limpiar_cadena($_POST['solicitud_id']);


/* Verificando solicitud */
$check_solicitud = conexion();
$check_solicitud = $check_solicitud->query("SELECT * FROM solicitudbaja WHERE solicitud_id='$id'");

if ($check_solicitud->rowCount() <= 0) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                La solicitud no existe en el sistema
            </div>
        ';
    exit();
} else {
    $datos = $check_solicitud->fetch();
}
$check_solicitud = null;


/* Almacenando datos */
$solicitadornom = limpiar_cadena($_POST['usuario_nombre']);
$solicitadorape = limpiar_cadena($_POST['usuario_apellido']);
$activoid = limpiar_cadena($_POST['activo_id']);
$fechaso = limpiar_cadena($_POST['fecha_solicitud']);
$codigo = limpiar_cadena($_POST['solicitud_codigo']);
$nombreapro = limpiar_cadena($_POST['usuario_nombre']);
$apellidoapro = limpiar_cadena($_POST['usuario_apellido']);
$estadosol = limpiar_cadena($_POST['solicitud_estado']);
$fechaapro = limpiar_cadena($_POST['fecha_aprobacion']);
$motivo = limpiar_cadena($_POST['motivo']);
$documento = limpiar_cadena($_POST['documento']);




/* Verificando campos obligatorios */
if ($solicitadornom == "" || $solicitadorape == "" || $activoid == "" || $fechaso == "" || $codigo=="" || $nombreapro=="" || $apellidoapro == "" ||
 $estadosol == "" || $fechaapro == "" || $motivo == "" || $documento == "") {
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

if (verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{2,300}", $comentario)) {
    echo '
                <div class="notification is-danger is-light">
                    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    El rcomentario no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9]{2,300}", $documento)) {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El responsable no coincide con el formato solicitado
            </div>
        ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}", $categoria)) {
    echo '
                <div class="notification is-danger is-light">
                    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    La categoria no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9-]{1,50}", $piso)) {
    echo '
                <div class="notification is-danger is-light">
                     <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    El piso no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-Z0-9-]{2,50}", $posicion)) {
    echo '
                <div class="notification is-danger is-light">
                     <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                     La posición no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,50}", $area)) {
    echo '
                <div class="notification is-danger is-light">
                     <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                    La área no coincide con el formato solicitado
                </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}", $sector)) {
    echo '
                <div class="notification is-danger is-light">
                     <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                      El sector no coincide con el formato solicitado
                 </div>
            ';
    exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{2,50}", $estadoactivo)) {
    echo '
                 <div class="notification is-danger is-light">
                     <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                      El sector no coincide con el formato solicitado
                </div>
            ';
    exit();
}


/* Verificando codigo */
if ($activo != $datos['activo_codigo']) {
    $check_codigo = conexion();
    $check_codigo = $check_codigo->query("SELECT activo_codigo FROM activo WHERE activo_codigo='$codigo'");
    if ($check_codigo->rowCount() > 0) {
        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El codigo ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
        exit();
    }
    $check_codigo = null;
}

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
if ($estadoactivo != $estadoactivo['estadoactivo_id']) {
    $check_estadoactivo = conexion();
    $check_estadoactivo = $check_estadoactivo->query("SELECT estadoactivo_id FROM estadoactivo WHERE estadoactivo_id='$estadoactivo'");
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
$actualizar_activo = $actualizar_activo->prepare("UPDATE activo SET activo_codigo=:codigo,activo_marca=:marca,activo_modelo=:modelo,activo_serial=:serial,activo_comentario=:comentario,activo_documento=:documento,activo_categoria=:categoria
    activo_piso=:piso,activo_posicion=:posicion,activo_area=:area,activo_sector=:sector,activo_estadoactivo=:estadoactivo WHERE activo_id=:id");

$marcadores = [
    ":codigo" => $codigo,
    ":marca" => $marca,
    ":modelo" => $modelo,
    ":serial" => $serial,
    ":comentario" => $comentario,
    ":documento" => $documento,
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
