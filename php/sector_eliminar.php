<?php
	/* Almacenando datos */
    $sector_id_del=limpiar_cadena($_GET['sector_id_del']);

    /* Verificando sector */
    $check_sector=conexion();
    $check_sector=$check_sector->query("SELECT * FROM sector WHERE sector_id='$sector_id_del'");

    if($check_sector->rowCount()==1){

    	$datos=$check_sector->fetch();

    	$eliminar_sector=conexion();
    	$eliminar_sector=$eliminar_sector->prepare("DELETE FROM sector WHERE sector_id=:id");

    	$eliminar_sector->execute([":id"=>$sector_id_del]);

    	if($eliminar_sector->rowCount()==1){

    		echo '
	            <div class="notification is-info is-light">
	                <strong>¡Sector eliminado!</strong><br>
	                Los datos del secotr se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el sector, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_sector=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El sector que intenta eliminar no existe
            </div>
        ';
    }
    $check_sector=null;