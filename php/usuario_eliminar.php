<?php
	/* Almacenando datos */
    $user_id_del=limpiar_cadena($_GET['user_id_del']);

    /* Verificando usuario */
    $check_usuario=conexion();
    $check_usuario=$check_usuario->query("SELECT * FROM usuario WHERE usuario_id='$user_id_del'");

    if($check_usuario->rowCount()==1){

    	$datos=$check_usuario->fetch();

    	$eliminar_usuario=conexion();
    	$eliminar_usuario=$eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id=:id");

    	$eliminar_usuario->execute([":id"=>$user_id_del]);

    	if($eliminar_usuario->rowCount()==1){

    		echo '
	            <div class="notification is-info is-light">
	                <strong>¡Equipo eliminado!</strong><br>
	                Los datos del usuario se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el usuario, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_usuario=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El usuario que intenta eliminar no existe
            </div>
        ';
    }
    $check_usuario=null;