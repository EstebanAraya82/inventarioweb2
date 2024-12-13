<?php
	/* Almacenando datos */
    $asset_id_del=limpiar_cadena($_GET['asset_id_del']);

    /* Verificando activo */
    $check_activo=conexion();
    $check_activo=$check_activo->query("SELECT * FROM activo WHERE activo_id='$asset_id_del'");

    if($check_activo->rowCount()==1){

    	$datos=$check_activo->fetch();

    	$eliminar_activo=conexion();
    	$eliminar_activo=$eliminar_activo->prepare("DELETE FROM activo WHERE activo_id=:id");

    	$eliminar_activo->execute([":id"=>$asset_id_del]);

    	if($eliminar_activo->rowCount()==1){

    		echo '
	            <div class="notification is-info is-light">
	                <strong>¡Equipo eliminado!</strong><br>
	                Los datos del activo se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el activo, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_activo=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El activo que intenta eliminar no existe
            </div>
        ';
    }
    $check_activo=null;