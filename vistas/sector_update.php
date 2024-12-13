<div class="container is-fluid mb-6">
	<h1 class="title">Sectores</h1>
	<h2 class="subtitle">Actualizar sector</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_atras.php";
		require_once "./php/main.php";

		$id = (isset($_GET['sector_id_up'])) ? $_GET['sector_id_up'] : 0;
		$id=limpiar_cadena($id);

		/* Verificando sector */
    	$check_sector=conexion();
    	$check_sector=$check_sector->query("SELECT * FROM sector WHERE sector_id='$id'");

        if($check_sector->rowCount()>0){
        	$datos=$check_sector->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/sector_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="sector_id" value="<?php echo $datos['sector_id']; ?>" required >

		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="sector_nombre" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required value="<?php echo $datos['sector_nombre']; ?>" >
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
		$check_sector=null;
	?>
</div>