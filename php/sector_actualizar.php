<?php
	require_once "main.php";

	/* Almacenando id */
    $id=limpiar_cadena($_POST['sector_id']);


    /* Verificando piso */
	$check_sector=conexion();
	$check_sector=$check_sector->query("SELECT * From sector Where sector_id='$id'");

    if($check_sector->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El sector no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_sector->fetch();
    }
    $check_sector=null;

    /* Almacenando datos */
    $nombre=limpiar_cadena($_POST['sector_nombre']);
    


    /* Verificando campos obligatorios */
    if($nombre==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando integridad de los datos */
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El nombre del sector no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    
    /* Verificando número */
    if($nombre!=$datos['sector_nombre']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT sector_nombre From sector Where sector_nombre='$nombre'");
	    if($check_nombre->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El sector ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_nombre=null;
    }


    /* Actualizar datos */
    $actualizar_sector=conexion();
    $actualizar_sector=$actualizar_sector->prepare("UPDATE sector Set sector_nombre=:nombre Where sector_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":id"=>$id
    ];

    if($actualizar_sector->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Categoria Actualizada!</strong><br>
                El sector se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar el sector, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_sector=null;