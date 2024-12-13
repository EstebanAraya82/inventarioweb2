<div class="container is-fluid mb-6">
	<h1 class="title">Pisos</h1>
	<h2 class="subtitle">Actualizar piso</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_atras.php";
		require_once "./php/main.php";

		$id = (isset($_GET['floor_id_up'])) ? $_GET['floor_id_up'] : 0;
		$id=limpiar_cadena($id);

		/* Verificando piso */
    	$check_piso=conexion();
    	$check_piso=$check_piso->query("SELECT * FROM piso WHERE piso_id='$id'");

        if($check_piso->rowCount()>0){
        	$datos=$check_piso->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/piso_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="piso_id" value="<?php echo $datos['piso_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="piso_numero" pattern="[0-9-]{1,50}" maxlength="50" required value="<?php echo $datos['piso_numero']; ?>" >
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
		$check_piso=null;
	?>
</div>