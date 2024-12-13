<div class="container is-fluid mb-6">
	<h1 class="title">Áreas</h1>
	<h2 class="subtitle">Nueva área</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/area_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Nombre</label>
				  	<input class="input" type="text" name="area_nombre" placeholder="Ingrese el nombre del área" placeholder="Ingrese dato" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>