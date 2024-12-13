<div class="container is-fluid mb-6">
	<h1 class="title">Áreas</h1>
	<h2 class="subtitle">Actualizar área</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_atras.php";
		require_once "./php/main.php";

		$id = (isset($_GET['area_id_up'])) ? $_GET['area_id_up'] : 0;
		$id=limpiar_cadena($id);

		/* Verificando area */
    	$check_area=conexion();
    	$check_area=$check_area->query("SELECT * FROM area WHERE area_id='$id'");

        if($check_area->rowCount()>0){
        	$datos=$check_area->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/area_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="area_id" value="<?php echo $datos['area_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="area_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required value="<?php echo $datos['area_nombre']; ?>" >
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
		$check_area=null;
	?>
</div>