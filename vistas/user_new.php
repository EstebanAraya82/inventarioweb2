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

	<form action="./php/usuario_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
    <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombres</label>
				  	<input class="input" type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Apellidos</label>
				  	<input class="input" type="text" name="usuario_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Usuario</label>
				  	<input class="input" type="text" name="usuario_usuario" pattern="[a-zA-Z0-9@.]{4,50}" maxlength="50" required >
				</div>
		  	</div>
		  	<div class="column">
		    	<div class="control">
					<label>Correo</label>
				  	<input class="input" type="email" name="usuario_correo" maxlength="70" >
				</div>
		  	</div>
		</div>
        <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Clave</label>
				  	<input class="input" type="password" name="usuario_clave_1" placeholder="Ingrese clave" pattern="[a-zA-Z0-9$@.-*]{7,50}" maxlength="50" required >
				</div>
		  	</div>             
           	<div class="column">
		    	<div class="control">
					<label>Repetir clave</label>
				  	<input class="input" type="password" name="usuario_clave_2" placeholder="Repita clave" pattern="[a-zA-Z0-9$@.-*]{7,50}" maxlength="50" required >
				</div>
		  	</div>           
              </div>    
              <div class="columns">    
			  <div class="column">
			<label>Estado</label><br>
			<div class="select is-rounded">
				<select name="usuario_estado">
					<option value="" selected="" >Seleccione estado</option>					
					<?php
					    $estados=conexion();
						$estados=$estados->query("SELECT * From estado");
						if($estados->rowCount()>0){
							$estados=$estados->fetchAll();
							foreach($estados as $row){
								echo '<option value="'.$row['estado_id'].'" >'.$row['estado_nombre'].'</option>';

							}
						}
						$estados=null;
					?>
				</select>
			</div>
		</div>
        <div class="column">
			<label>Rol</label><br>
			<div class="select is-rounded">
				<select name="usuario_rol">
					<option value="" selected="" >Seleccione rol</option>					
					<?php
					    $roles=conexion();
						$roles=$roles->query("SELECT * From rol");
						if($roles->rowCount()>0){
							$roles=$roles->fetchAll();
							foreach($roles as $row){
								echo '<option value="'.$row['rol_id'].'" >'.$row['rol_nombre'].'</option>';

							}
						}
						$roles=null;
					?>
				</select>
			</div>
		</div>
		</div>             
        </div>   
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>