<div class="container is-fluid mb-6">
	<h1 class="title">Posiciones</h1>
	<h2 class="subtitle">Nueva posición</h2>
</div>

<div class="container pb-6 pt-6">

	<div class="form-rest mb-6 mt-6"></div>

	<form action="./php/posicion_guardar.php" method="POST" class="FormularioAjax" autocomplete="off" >
		<div class="columns">
		  	<div class="column">
		    	<div class="control">
					<label>Posición</label>
				  	<input class="input" type="text" name="posicion_posicion" placeholder="Ingrese el número de la posición" placeholder="Ingrese dato" pattern="[a-zA-Z0-9-]{2,50}" maxlength="50" required >
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-info is-rounded">Guardar</button>
		</p>
	</form>
</div>