<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$campos = "activo.activo_id,activo.activo_codigo,activo.activo_marca,activo.activo_modelo,activo.activo_serial,activo.categoria_id,activo.piso_id,activo.posicion_id,activo.area_id,activo.sector_id,activo.estadoactivo_id,categoria.categoria_id,categoria.categoria_nombre,piso.piso_id,
    piso.piso_numero,posicion.posicion_id,posicion.posicion_posicion,area.area_id,area.area_nombre,sector.sector_id,sector.sector_nombre,estadoactivo.estadoactivo_id,estadoactivo.estadoactivo_nombre,activo.fecha_ingreso";

if (isset($busqueda) && $busqueda != "") {
	$consulta_datos = "SELECT $campos FROM activo 
	INNER JOIN categoria On activo.categoria_id=categoria.categoria_id 
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
	INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	where activo.activo_codigo Like '$busqueda%' 
	Or activo.activo_marca Like '%$busqueda%' 
	Or activo.activo_modelo Like '%$busqueda%' 
	Or activo.activo_serial Like '%$busqueda%'
	Order By activo.activo_codigo Asc Limit $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo where activo_codigo Like '%$busqueda%' Or activo_serial Like '%$busqueda%'";
	
} elseif ($categoria_id > 0) {

	$consulta_datos = "SELECT $campos FROM activo 
	INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id 
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
	INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	WHERE activo.categoria_id='$categoria_id' 
	ORDER BY activo.activo_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo WHERE categoria_id='$categoria_id'";

} elseif ($sector_id > 0) {

	$consulta_datos = "SELECT $campos FROM activo 
	INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id 
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
	INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	WHERE activo.sector_id='$sector_id' 
	ORDER BY activo.activo_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo WHERE sector_id='$sector_id'";
	
} elseif ($area_id > 0) {

	$consulta_datos = "SELECT $campos FROM activo 
	INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id 
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
	INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	WHERE activo.area_id='$area_id' 
	ORDER BY activo.activo_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo WHERE area_id='$area_id'";
	
} elseif ($posicion_id > 0) {

	$consulta_datos = "SELECT $campos FROM activo 
	INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id 
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
	INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	WHERE activo.posicion_id='$posicion_id' 
	ORDER BY activo.activo_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo WHERE posicion_id='$posicion_id'";

} elseif ($piso_id > 0) {

	$consulta_datos = "SELECT $campos FROM activo 
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
	INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	WHERE activo.piso_id='$piso_id' 
	ORDER BY activo.activo_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo WHERE piso_id='$piso_id'";

} elseif ($estadoactivo_id > 0) {

	$consulta_datos = "SELECT $campos FROM activo
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
	INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	WHERE activo.estadoactivo_id='$estadoactivo_id' 
	ORDER BY activo.activo_codigo ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo WHERE estadoactivo_id='$estadoactivo_id'";
} else {

	$consulta_datos = "SELECT $campos FROM activo 
	INNER JOIN categoria ON activo.categoria_id=categoria.categoria_id 
	INNER JOIN piso On activo.piso_id=piso.piso_id 
	INNER JOIN posicion On activo.posicion_id=posicion.posicion_id
    INNER JOIN area On activo.area_id=area.area_id 
	INNER JOIN sector ON activo.sector_id=sector.sector_id 
	INNER JOIN estadoactivo ON activo.estadoactivo_id=estadoactivo.estadoactivo_id 
	Order By activo.activo_codigo Asc Limit $inicio,$registros";

	$consulta_total = "SELECT COUNT(activo_id) FROM activo";
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
                    <th>Código</th>
                    <th>Marca</th>
					<th>Modelo</th>
					<th>Serial</th>
					<th>Categoria</th>
					<th>Piso</th>
					<th>Posición</th>
					<th>Área</th>
					<th>Sector</th>		
					<th>Estado</th>		
					<th>Fecha</th>		
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
                    <td>' . $rows['activo_codigo'] . '</td>
                    <td>' . $rows['activo_marca'] . '</td>
                    <td>' . $rows['activo_modelo'] . '</td>
					<td>' . $rows['activo_serial'] . '</td>
                    <td>' . $rows['categoria_nombre'] . '</td>
                    <td>' . $rows['piso_numero'] . '</td>
					<td>' . $rows['posicion_posicion'] . '</td>
					<td>' . $rows['area_nombre'] . '</td>
					<td>' . $rows['sector_nombre'] . '</td>
					<td>' . $rows['estadoactivo_nombre'] . '</td>
					<td>' . $rows['fecha_ingreso'] . '</td>
					<td>
					<a href="index.php?vista=asset_update&asset_id_up=' . $rows['activo_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
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
