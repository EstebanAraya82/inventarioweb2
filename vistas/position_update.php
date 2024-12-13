<div class="container is-fluid mb-6">
	<h1 class="title">Posiciones</h1>
	<h2 class="subtitle">Actualizar posición</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_atras.php";
		require_once "./php/main.php";

		$id = (isset($_GET['position_id_up'])) ? $_GET['position_id_up'] : 0;
		$id=limpiar_cadena($id);

		/* Verificando sector */
    	$check_posicion=conexion();
    	$check_posicion=$check_posicion->query("SELECT * FROM posicion WHERE posicion_id='$id'");

        if($check_posicion->rowCount()>0){
        	$datos=$check_posicion->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/sector_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="posicion_id" value="<?php echo $datos['posicion_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Posición</label>
				  	<input class="input" type="text" name="posicion_posicion" pattern="[a-zA-Z0-9-]{2,50}" maxlength="50" required value="<?php echo $datos['sector_nombre']; ?>" >
				</div>
		  	</div>
		  </div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_posicion=null;
	?>
</div>