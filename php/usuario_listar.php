<?php
$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$campos = 
"usuario.usuario_id,
 usuario.usuario_nombre,
 usuario.usuario_apellido,
 usuario.usuario_usuario,
 usuario.usuario_correo,
 usuario.estadousuario_id,
 usuario.rol_id,
 usuario.area_id,
 rol.rol_id,
 rol.rol_nombre,
 area.area_id,
 area.area_nombre,
 estadousuario.estadousuario_id,
 estadousuario.estadousuario_nombre";
 

 if (isset($busqueda) && $busqueda != "") {

	$consulta_datos = "SELECT $campos FROM usuario 
	INNER JOIN area ON usuario.area_id=area.area_id 
	INNER JOIN rol ON usuario.rol_id=rol.rol_id
	INNER JOIN estadousuario ON usuario.estadousuario_id=estadousuario.estadousuario_id
	WHERE usuario.usuario_nombre LIKE '%$busqueda%' 
	OR usuario.usuario_apellido LIKE '%$busqueda%' 
	OR usuario.usuario_correo LIKE '%$busqueda%' 
	ORDER BY usuario.usuario_usuario ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE usuario_nombre LIKE '%$busqueda%' OR usuario_usuario LIKE '%$busqueda%'";

} elseif ($area_id > 0) {

	$consulta_datos = "SELECT $campos FROM usuario 
	INNER JOIN area ON usuario.area_id=area.area_id 
	INNER JOIN rol ON usuario.rol_id=rol.rol_id 
	INNER JOIN estadousuario ON usuario.estadousuario_id=estadousuario.estadousuario_id
	WHERE usuario.area_id='$area_id' 
	ORDER BY usuario.usuario_usuario ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE area_id='$area_id'";

} elseif ($rol_id > 0) {

	$consulta_datos = "SELECT $campos FROM usuario 
	INNER JOIN area ON usuario.area_id=area.area_id 
	INNER JOIN rol ON usuario.rol_id=rol.rol_id 
	INNER JOIN estadousuario ON usuario.estadousuario_id=estadousuario.estadousuario_id
	WHERE usuario.rol_id='$rol_id' 
	ORDER BY usuario.usuario_usuario ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE rol_id='$rol_id'";

} elseif ($estadousuario_id > 0) {

	$consulta_datos = "SELECT $campos FROM usuario 
	INNER JOIN area ON usuario.area_id=area.area_id 
	INNER JOIN rol ON usuario.rol_id=rol.rol_id 
	INNER JOIN estadousuario ON usuario.estadousuario_id=estadousuario.estadousuario_id
	WHERE usuario.estadousuario_id='$estadousuario_id' 
	ORDER BY usuario.usuario_usuario ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(usuario_id) FROM usuario WHERE estadousuario_id='$estadousuario_id'";

} else {

	$consulta_datos = "SELECT $campos FROM usuario 
	INNER JOIN area ON usuario.area_id=area.area_id 
	INNER JOIN rol ON usuario.rol_id=rol.rol_id 
	INNER JOIN estadousuario ON usuario.estadousuario_id=estadousuario.estadousuario_id
	ORDER BY usuario.usuario_usuario ASC LIMIT $inicio,$registros";

	$consulta_total = "SELECT COUNT(usuario_id) FROM usuario";
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
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
					<th>Correo</th>
                    <th>Estado</th>
                    <th>Área</th>
					<th>Rol</th>
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
                    <td>' . $rows['usuario_nombre'] . '</td>
                    <td>' . $rows['usuario_apellido'] . '</td>
                    <td>' . $rows['usuario_usuario'] . '</td>
					<td>' . $rows['usuario_correo'] . '</td>
					<td>' . $rows['estadousuario_nombre'] . '</td>
                    <td>' . $rows['area_nombre'] . '</td>
					<td>' . $rows['rol_nombre'] . '</td>
					<td>
					<a href="index.php?vista=user_update&user_id_up=' . $rows['usuario_id'] . '" class="button is-success is-rounded is-small">Actualizar</a>
                    </td>
                    </tr>
            ';
		$contador++;
	}
	$pag_final = $contador - 1;
} else {
	if ($total >= 1) {
		$tabla .= '
				<tr class="has-text-centered" >
					<td colspan="7">
						<a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
							Haga clic acá para recargar el listado
						</a>
					</td>
				</tr>
			';
	} else {
		$tabla .= '
				<tr class="has-text-centered" >
					<td colspan="7">
						No hay registros en el sistema
					</td>
				</tr>
			';
	}
}


$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
	$tabla .= '<p class="has-text-right">Mostrando usuarios <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion = null;
echo $tabla;

if ($total >= 1 && $pagina <= $Npaginas) {
	echo paginador_tablas($pagina, $Npaginas, $url, 7);
}
