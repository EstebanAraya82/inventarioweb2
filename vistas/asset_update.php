<div class="container is-fluid mb-12">
	<h1 class="title">Activos</h1>
	<h2 class="subtitle">Actualizar activo</h2>
</div>

<div class="container pb-12 pt-12">
	<?php
	include "./inc/btn_atras.php";
	require_once "./php/main.php";

	$id = (isset($_GET['asset_id_up'])) ? $_GET['asset_id_up'] : 0;
	$id = limpiar_cadena($id);

	/* Verificar equipo */
	$check_activo = conexion();
	$check_activo = $check_activo->query("SELECT * FROM activo WHERE activo_id='$id'");

	if ($check_activo->rowCount() > 0) {
		$datos = $check_activo->fetch();
	?>

		<div class="form-rest mb-12 mt-12"></div>

		<h2 class="title has-text-centered"><?php echo $datos['activo_codigo']; ?></h2>

		<form action="./php/activo_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off">

			<input type="hidden" name="activo_id" value="<?php echo $datos['activo_id']; ?>" required>

			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Activo Fijo</label>
						<input class="input" type="text" name="activo_codigo" placeholder="Ingrese dato" pattern="[0-9]{3,50}" maxlength="50" require value="<?php echo $datos['activo_codigo']; ?>">
					</div>
				</div>

				<div class="column">
					<div class="control">
						<label>Marca</label>
						<input class="input" type="int" name="activo_marca" placeholder="Ingrese dato" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ]{2,50}" maxlength="50" required value="<?php echo $datos['activo_marca']; ?>">
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<div class="control">
						<label>Modelo</label>
						<input class="input" type="text" name="activo_modelo" placeholder="Ingrese dato" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{2,50}" maxlength="50" required value="<?php echo $datos['activo_modelo']; ?>">
					</div>
				</div>
				<div class="column">
					<div class="control">
						<label>Serial</label>
						<input class="input" type="text" name="activo_serial" placeholder="Ingrese dato" pattern="[a-zA-Z0-9]{3,50}" maxlength="50" required value="<?php echo $datos['activo_serial']; ?>">
					</div>
				</div>
			</div>

			<div class="columns">
				<div class="column">
					<label>Categoria</label><br>
					<div class="select is-rounded">
						<select name="activo_categoria">
							<option value="" selected="">Seleccione una opción</option>
							<?php
							$categorias = conexion();
							$categorias = $categorias->query("SELECT * From categoria");
							if ($categorias->rowCount() > 0) {
								$categorias = $categorias->fetchAll();
								foreach ($categorias as $row) {
									if ($datos['categoria_id'] == $row['categoria_id']) {
										echo '<option value="' . $row['categoria_id'] . '" selected="" >' . $row['categoria_nombre'] . ' (Actual)</option>';
									} else {
										echo '<option value="' . $row['categoria_id'] . '" >' . $row['categoria_nombre'] . '</option>';
									}
								}
							}

							$categorias = null;
							?>
						</select>
					</div>
				</div>
				<div class="column">
					<label>Piso</label><br>
					<div class="select is-rounded">
						<select name="activo_piso">
							<option value="" selected="">Seleccione una opción</option>
							<?php
							$pisos = conexion();
							$pisos = $pisos->query("SELECT * From piso");
							if ($pisos->rowCount() > 0) {
								$pisos = $pisos->fetchAll();
								foreach ($pisos as $row) {
									if ($datos['piso_id'] == $row['piso_id']) {
										echo '<option value="' . $row['piso_id'] . '" selected="" >' . $row['piso_numero'] . ' (Actual)</option>';
									} else {
										echo '<option value="' . $row['piso_id'] . '" >' . $row['piso_numero'] . '</option>';
									}
								}
							}

							$pisos = null;
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<label>Posición</label><br>
					<div class="select is-rounded">
						<select name="activo_posicion">
							<option value="" selected="">Seleccione una opción</option>
							<?php
							$posiciones = conexion();
							$posiciones = $posiciones->query("SELECT * From posicion");
							if ($posiciones->rowCount() > 0) {
								$posiciones = $posiciones->fetchAll();
								foreach ($posiciones as $row) {
									if ($datos['posicion_id'] == $row['posicion_id']) {
										echo '<option value="' . $row['posicion_id'] . '" selected="" >' . $row['posicion_posicion'] . ' (Actual)</option>';
									} else {
										echo '<option value="' . $row['posicion_id'] . '" >' . $row['posicion_posicion'] . '</option>';
									}
								}
							}

							$posiciones = null;
							?>
						</select>
					</div>
				</div>
				<div class="column">
					<label>Area</label><br>
					<div class="select is-rounded">
						<select name="activo_area">
							<option value="" selected="">Seleccione una opción</option>
							<?php
							$areas = conexion();
							$areas = $areas->query("SELECT * From area");
							if ($areas->rowCount() > 0) {
								$areas = $areas->fetchAll();
								foreach ($areas as $row) {
									if ($datos['area_id'] == $row['area_id']) {
										echo '<option value="' . $row['area_id'] . '" selected="" >' . $row['area_nombre'] . ' (Actual)</option>';
									} else {
										echo '<option value="' . $row['area_id'] . '" >' . $row['area_nombre'] . '</option>';
									}
								}
							}

							$areas = null;
							?>

						</select>
					</div>
				</div>
			</div>
			<div class="columns">
				<div class="column">
					<label>Sector</label><br>
					<div class="select is-rounded">
						<select name="activo_sector">
							<option value="" selected="">Seleccione una opción</option>
							<?php
							$sectores = conexion();
							$sectores = $sectores->query("SELECT * From sector");
							if ($sectores->rowCount() > 0) {
								$sectores = $sectores->fetchAll();
								foreach ($sectores as $row) {
									if ($datos['sector_id'] == $row['sector_id']) {
										echo '<option value="' . $row['sector_id'] . '" selected="" >' . $row['sector_nombre'] . ' (Actual)</option>';
									} else {
										echo '<option value="' . $row['sector_id'] . '" >' . $row['sector_nombre'] . '</option>';
									}
								}
							}

							$sectores = null;
							?>
						</select>
					</div>
				</div>
				<div class="column">
					<label>Estado</label><br>
					<div class="select is-rounded">
						<select name="activo_estado">
							<option value="" selected="">Seleccione una opción</option>
							<?php
							$estadoactivos = conexion();
							$estadoactivos = $estadoactivos->query("SELECT * From activo");
							if ($estadoactivos->rowCount() > 0) {
								$estadoactivos = $estadoactivos->fetchAll();
								foreach ($estadoactivos as $row) {
									if ($datos['activo_estado'] == $row['activo_estado']) {
										echo '<option value="' . $row['activo_estado'] . '" selected="" >' . $row['activo_estado'] . ' (Actual)</option>';
									} 
								}
							}

							$estadoactivos = null;
							?>
						</select>
					</div>
				</div>
			</div>

			
			<p class="has-text-centered">
				<button type="submit" class="button is-success is-rounded">Actualizar</button>
			</p>
		</form>
	<?php
	} else {
		include "./inc/alerta_error.php";
	}
	$check_activo = null;
	?>
</div>