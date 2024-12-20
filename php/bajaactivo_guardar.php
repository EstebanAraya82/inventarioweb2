<?php

/*require_once "../inc/inicio_sesion.php";*/
require_once "../php/main.php";
/* Almacenamiento de datos */
$solicitadornom = limpiar_cadena($_POST['usuario_nombre']);
$solicitadorape = limpiar_cadena($_POST['usuario_apellido']);
$tipoBaja = limpiar_cadena($_POST['solicitudbaja_tipobaja']);
// $activoid = limpiar_cadena($_POST['activo_id']);
$activoid = limpiar_cadena($_POST['solicitudbaja_activo']);
$fechaso = limpiar_cadena($_POST['fecha_solicitud']);
$codigo = limpiar_cadena($_POST['solicitud_codigo']);
// $nombreapro = limpiar_cadena($_POST['aprobador_nombre']);
// $apellidoapro = limpiar_cadena($_POST['aprobador_apellido']);
//$estadosol = limpiar_cadena($_POST['solicitud_estado']);
$estadosol = limpiar_cadena($_POST['solicitudbaja_estadosolicitud']);
// $fechaapro = limpiar_cadena($_POST['fecha_aprobacion']);
$motivo = limpiar_cadena($_POST['motivo']);
$documento = limpiar_cadena($_FILES['documento']['name']);

/* Verificación de datos obligatorios */
if ($solicitadornom == "" || $solicitadorape == "" || $activoid == "" || $fechaso == "" || $codigo == "" || $estadosol == "" || $motivo == "") {
  echo '
    <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    No llenaste todos los datos solicitados
  </div>';
  exit();
}

/* Verificación de integridad de datos */

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}", $solicitadornom)) {
  echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    Los datos del solicitador no corresponden con el formato solicitado
  </div>';
  exit();
}

if (verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}", $solicitadorape)) {
  echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    Los datos del solicitador no corresponden con el formato solicitado
  </div>';
  exit();
}

/* verificar codigo */
$check_activo = conexion();
$check_activo = $check_activo->query("SELECT activo_id From activo where activo_id='$activoid'");
// if ($check_activo->rowCount() > 0) {
  if ($check_activo->rowCount() == 0) {
  // echo '
  // <div class="notification is-danger is-light">
  // <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  // El Activo Fijo ya esta ingresado
  // </div>
  // ';
  echo '
   <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  El Activo Fijo no esta ingresado
  </div>
  ';
  exit();
}
$check_activo = null;

/*verificar fecha solicitud */
// $check_fechaso = conexion();
// $check_fechaso = $check_fechaso->query("SELECT fecha_solicitud From solicitudbaja where fecha_solicitud='$fechaso'");
// if ($check_fechaso->rowCount() <= 0) {
//   echo '
//   <div class="notification is-danger is-light">
//   <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
//   la fecha no corresponde
//   </div>
//   ';
//   exit();
// }
// $check_fechaso = null;

if (verificar_datos("[0-9]{3,300}", $codigo)) {
  echo '
  <div class="notification is-danger is-light">
  <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
  Los datos del codigo no corresponde con el formato solicitado
</div>';
  exit();
}


/* Guardando datos */
$guardar_solicitud = conexion();
$guardar_solicitud = $guardar_solicitud->prepare("INSERT INTO solicitudbaja (solicitud_codigo,solicitadornom,solicitadorape,activo_id,fecha_solicitud,estadosolicitud_id,motivo, tipobaja_id,documento)
    VALUES(:codigo,:solicitadornom,:solicitadorape,:activoid,:fechaso,:estadosol,:motivo, :tipobaja_id,:documento)");

$target = '../documents/'.$_FILES['documento']['name'];
move_uploaded_file($_FILES['documento']['tmp_name'], $target);

$marcadores = [

  ":solicitadornom" => $solicitadornom,
  ":solicitadorape" => $solicitadorape,
  ":activoid" => $activoid,
  ":fechaso" => $fechaso,
  ":codigo" => $codigo,
  // ":aprobadornom" => $nombreapro,
  // ":aprobadorape" => $apellidoapro,
  ":estadosol" => $estadosol,
  // ":fechaapro" => $fechaapro,
  ":motivo" => $motivo,
  ":documento" => $documento,
  ":tipobaja_id" => $tipoBaja
];

$guardar_solicitud->execute($marcadores);

if ($guardar_solicitud->rowCount() == 1) {
  echo '
        <div class="notification is-info is-light">
        <strong>¡Activo Registrado!</strong><br>
        La solicitud se registro correctamente
    </div>
';
} else {
  echo '
    <div class="notification is-danger is-light">
        <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
        No se pudo registrar la solicitud, por favor intente nuevamente
    </div>
        ';
}
$guardar_solicitud = null;