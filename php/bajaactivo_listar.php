<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$campos = "solicitudbaja.solicitud_id,
solicitudbaja.solicitadornom,
solicitudbaja.solicitadorape,
solicitudbaja.activo_id,
solicitudbaja.fecha_solicitud,
solicitudbaja.solicitud_codigo,
solicitudbaja.aprobadornom,
solicitudbaja.aprobadorape,
solicitudbaja.estadosolicitud_id,
solicitudbaja.fecha_aprobacion,
solicitudbaja.motivo,
solicitudbaja.documento,
activo.activo_id,
activo.activo_codigo,
estadosolicitud.estadosolicitud_id,
estadosolicitud.estadosolicitud_nombre";

if (isset($busqueda) && $busqueda != "") {
	$consulta_datos = "SELECT $campos FROM solicitudbaja 
	INNER JOIN activo On solicitudbaja.activo_id=activo.activo_id 
	INNER JOIN estadosolicitud On solicitudbaja.estadosolicitud_id=estadosolicitud.estadosolicitud_id 
	where solicitudbaja.solicitud_codigo Like '$busqueda%' 
	Or solicitudbaja.solicitadornom Like '$busqueda%' 
	Or solicitudbaja.solicitadorape Like '$busqueda%' 
	Or solicitudbaja.fecha_solicitud Like '$busqueda%' 
	Or solicitudbaja.aprobadornom Like '$busqueda%' 
	Or solicitudbaja.aprobadorape Like '$busqueda%' 
	Or solicitudbaja.fecha_aprobacion Like '$busqueda%' 
	Or solicitudbaja.motivo Like '$busqueda%' 
	Or solicitudbaja.documento Like '$busqueda%' 
	Order By solicitudbaja.solicitud_codigo Asc Limit $inicio,$registros";

	$consulta_total = "SELECT COUNT(solicitud_id) FROM solicitudbaja where solicitud_codigo Like '%$busqueda%'";
} elseif ($activo_id > 0) {

	$consulta_datos = "SELECT $campos FROM solicitudbaja 
	INNER JOIN activo On solicitudbaja.activo_id=activo.activo_id 
	INNER JOIN estadosolicitud On solicitudbaja.estadosolicitud_id=estadosolicitud.estadosolicitud_id 
	 WHERE solicitudbaja.activo_id='$activo_id' ORDER BY solicitudbaja.solicitud_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(solicitud_id) FROM solicitudbaja WHERE activo_id='$activo_id'";
} elseif ($estadosolicitud_id > 0) {

	$consulta_datos = "SELECT $campos FROM solicitudbaja 
	INNER JOIN activo On solicitudbaja.activo_id=activo.activo_id 
	INNER JOIN estadosolicitud On solicitudbaja.estadosolicitud_id=estadosolicitud.estadosolicitud_id 
	 WHERE solicitudbaja.activo_id='$activo_id' ORDER BY solicitudbaja.solicitud_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(solicitud_id) FROM solicitudbaja WHERE estadosolicitud_id='$estadosolicitud_id'";
} else {

	$consulta_datos = "SELECT $campos FROM solicitudbaja 
	INNER JOIN activo On solicitudbaja.activo_id=activo.activo_id 
	INNER JOIN estadosolicitud On solicitudbaja.estadosolicitud_id=estadosolicitud.estadosolicitud_id 
	Order By solicitudbaja.solicitud_codigo Asc Limit $inicio,$registros";

	$consulta_total = "SELECT COUNT(solicitud_id) FROM solicitudbaja";
}

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

$Npaginas = ceil($total / $registros);

$tabla .= '
	<div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                	<th>#</th>
					<th>Código Solicitud</th>
                    <th>Nombre solicitante</th>
                    <th>Apellido solicitante</th>
					<th>Código activo</th>
					<th>Fecha solicitud</th>					
					<th>Nombre aprobador</th>
					<th>Apellido aprobador</th>
					<th>Estado solicitud</th>
					<th>Fecha de aprobación</th>		
					<th>Motivo</th>	
					<th colspan="2">Opciones</th>
                </tr>
            </thead>
            <tbody>
	';

if ($total >= 1 && $pagina <= $Npaginas) {
	$contador = $inicio + 1;
	$pag_inicio = $inicio + 1;
	foreach ($datos as $rows) {
		$tabla .= '
				<tr class="has-text-centered" >
					<td>' . $contador . '</td>
					<td>' . $rows['solicitud_codigo'] . '</td>
                    <td>' . $rows['solicitadornom'] . '</td>
                    <td>' . $rows['solicitadorape'] . '</td>
                    <td>' . $rows['activo_codigo'] . '</td>
					<td>' . $rows['fecha_solicitud'] . '</td>
                    <td>' . $rows['aprobadornom'] . '</td>
					<td>' . $rows['aprobadorape'] . '</td>
					<td>' . $rows['estadosolicitud_nombre'] . '</td>
					<td>' . $rows['fecha_aprobacion'] . '</td>
					<td>' . $rows['motivo'] . '</td>
					
					<td>
					<a href="index.php?vista=assetderegistration_update&assetderegistration_id_up=' . $rows['solicitud_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    </tr>
            ';
		$contador++;
	}
	$pag_final = $contador - 1;
} else {
	if ($total >= 1) {
		$tabla .= '
				<p class="has-text-centered" >
					<a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
						Haga clic acá para recargar el listado
					</a>
				</p>
			';
	} else {
		$tabla .= '
				<p class="has-text-centered" >No hay registros en el sistema</p>
			';
	}
}

if ($total > 1 && $pagina <= $Npaginas) {
	$tabla .= '<p class="has-text-right">Mostrando equipos <strong>' . $pag_inicio .
		'</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion = null;
echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
	echo paginador_tablas($pagina, $Npaginas, $url, 7);
}