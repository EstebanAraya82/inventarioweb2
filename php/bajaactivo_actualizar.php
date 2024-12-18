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
$activoid = limpiar_cadena($_POST['solicitudbaja_activo']);
$fechaso = limpiar_cadena($_POST['fecha_solicitud']);
$codigo = limpiar_cadena($_POST['solicitud_codigo']);
$nombreapro = limpiar_cadena($_POST['aprobador_nombre']);
$apellidoapro = limpiar_cadena($_POST['aprobador_apellido']);
$estadosol = limpiar_cadena($_POST['solicitudbaja_estadosolicitud']);
$fechaapro = limpiar_cadena($_POST['fecha_aprobacion']);
$motivo = limpiar_cadena($_POST['motivo']);
// $documento = limpiar_cadena($_POST['documento']);


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
  $check_activo = $check_activo->query("SELECT activo_id From activo where activo_id='$id'");
  if ($check_activo->rowCount() > 0) {
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    El Activo Fijo ya esta ingresado
    </div>
    ';
    exit();
  }
  $check_activo = null;
  
  /*verificar fecha solicitud */
  $check_fechaso = conexion();
  $check_fechaso = $check_fechaso->query("SELECT fecha_solicitud From solicitudbaja where fecha_solicitud='$fechaso'");
  if ($check_fechaso->rowCount() <= 0) {
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    la fecha no corresponde
    </div>
    ';
    exit();
  }
  $check_fechaso = null;
  
  if (verificar_datos("[0-9]{3,300}", $codigo)) {
    echo '
    <div class="notification is-danger is-light">
    <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
    Los datos del codigo no corresponde con el formato solicitado
  </div>';
    exit();
  }
  
  
/* Actualizando datos */
$actualizar_solicitud = conexion();
$actualizar_solicitud = $actualizar_solicitud->prepare("UPDATE solicitudbaja SET solicitadornom=:solicitadornom,solicitadorape=:solicitadorape,activo_id=:activoid,fecha_solicitud=:fechaso,
solicitud_codigo=:codigo,aprobadornom=:aprobadornom,aprobadorape=:aprobadorape,estadosolicitud_id=:estadosol,fecha_aprobacion=:fechaapro,motivo=:motivo WHERE solicitud_id=:id");

$marcadores = [
    ":solicitadornom" => $solicitadornom,
    ":solicitadorape" => $solicitadorape,
    ":activoid" => $activoid,
    ":fechaso" => $fechaso,
    ":codigo" => $codigo,
    ":aprobadornom" => $nombreapro,
    ":aprobadorape" => $apellidoapro,
    ":estadosol" => $estadosol,
    ":fechaapro" => $fechaapro,
    ":motivo" => $motivo,
    // ":documento" => $documento,
    ":id"=> $id
];


if ($actualizar_solicitud->execute($marcadores)) {
    echo '
            <div class="notification is-info is-light">
                <strong>¡Activo Actualizado!</strong><br>
                La solicitud se actualizo con exito
            </div>
        ';
} else {
    echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar la solicitud, por favor intente nuevamente
            </div>
        ';
}
$actualizar_solicitud = null;
