<?php
	/* Almacenando datos */
    $category_id_del=limpiar_cadena($_GET['category_id_del']);

    /* Verificando categoria */
    $check_categoria=conexion();
    $check_categoria=$check_categoria->query("SELECT * FROM categoria WHERE categoria_id='$category_id_del'");

    if($check_categoria->rowCount()==1){

    	$datos=$check_categoria->fetch();

    	$eliminar_categoria=conexion();
    	$eliminar_categoria=$eliminar_categoria->prepare("DELETE FROM categoria WHERE categoria_id=:id");

    	$eliminar_categoria->execute([":id"=>$category_id_del]);

    	if($eliminar_categoria->rowCount()==1){

    		echo '
	            <div class="notification is-info is-light">
	                <strong>¡Equipo eliminado!</strong><br>
	                Los datos de la categoria se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ups ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar la categoria, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_categoria=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ups ocurrio un error inesperado!</strong><br>
                La categoria que intenta eliminar no existe
            </div>
        ';
    }
    $check_categoria=null;