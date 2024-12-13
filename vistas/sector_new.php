<div class="container is-fluid mb-6">
	<h1 class="title">Sector</h1>
	<h2 class="subtitle">Cargar sector</h2>
</div>
<div class="container pb-6 pt-6">
		<?php 
	    include "./inc/btn_atras.php";
		require_once "./php/main.php"; 
		?>

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/sector_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
    <div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Sector</label>
				  	<input class="input" type="text" name="sector_nombre" placeholder="Ingrese el nombre del sector" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		  </div>
		        
       	<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>