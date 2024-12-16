<div class="container is-fluid mb-6">
	<h1 class="title">Usuarios</h1>
	<h2 class="subtitle">Alta usuario</h2>
</div>
<div class="container pb-6 pt-6">
	<?php
	include "./inc/btn_atras.php";
	require_once "./php/main.php";
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off">
		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Nombres</label>
					<input class="input" type="text" name="usuario_nombre" placeholder="Ingrese nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required>
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Apellidos</label>
					<input class="input" type="text" name="usuario_apellido" placeholder="Ingrese apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required>
				</div>
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Usuario</label>
					<input class="input" type="text" name="usuario_usuario" placeholder="Ingrese usuario" pattern="[a-zA-Z0-9@.]{4,50}" maxlength="50" required>
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Correo</label>
					<input class="input" type="email" name="usuario_correo" placeholder="Ingrese correo" maxlength="70">
				</div>
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<div class="control">
					<label>Clave</label>
					<input class="input" type="password" name="usuario_clave_1" placeholder="Ingrese clave" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" required>
				</div>
			</div>
			<div class="column">
				<div class="control">
					<label>Repetir clave</label>
					<input class="input" type="password" name="usuario_clave_2" placeholder="Ingrese clave" pattern="[a-zA-Z0-9$@.-]{7,50}" maxlength="50" required>
				</div>
			</div>
		</div>
		<div class="columns">
			<div class="column">
				<label>Estado</label><br>
				<div class="select is-rounded">
					<select name="usuario_estado">
						<option value="" selected="">Seleccione una opción</option>
						<?php
						$estadousuarios = conexion();
						$estadousuarios = $estadousuarios->query("SELECT * From estadousuario");
						if ($estadousuarios->rowCount() > 0) {
							$estadousuarios = $estadousuarios->fetchAll();
							foreach ($estadousuarios as $row) {
								echo '<option value="' . $row['estadousuario_id'] . '" >' . $row['estadousuario_nombre'] . '</option>';
							}
						}
						$estadousuarios = null;
						?>
					</select>
				</div>
			</div>
			<div class="column">
				<label>Área</label><br>
				<div class="select is-rounded">
					<select name="usuario_area">
						<option value="" selected="">Seleccione una opción</option>
						<?php
						$areas = conexion();
						$areas = $areas->query("SELECT * From area");
						if ($areas->rowCount() > 0) {
							$areas = $areas->fetchAll();
							foreach ($areas as $row) {
								echo '<option value="' . $row['area_id'] . '" >' . $row['area_nombre'] . '</option>';
							}
						}
						$areas = null;
						?>
					</select>
				</div>
			</div>
			<div class="column">
				<label>Rol</label><br>
				<div class="select is-rounded">
					<select name="usuario_rol">
						<option value="" selected="">Seleccione una opción</option>
						<?php
						$rol = conexion();
						$rol = $rol->query("SELECT * From rol");
						if ($rol->rowCount() > 0) {
							$rol = $rol->fetchAll();
							foreach ($rol as $row) {
								echo '<option value="' . $row['rol_id'] . '" >' . $row['rol_nombre'] . '</option>';
							}
						}
						$rol = null;
						?>
					</select>
				</div>
			</div>
		</div>
</div>
</div>



<p class="has-text-centered">
	<button type="submit" class="button is-info is-rounded">Guardar</button>
</p>
</form>
</div>