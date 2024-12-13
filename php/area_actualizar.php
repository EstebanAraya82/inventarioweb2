<?php
	require_once "main.php";

	/* Almacenando id */
    $id=limpiar_cadena($_POST['area_id']);


    /* Verificando area */
	$check_area=conexion();
	$check_area=$check_area->query("SELECT * From area Where area_id='$id'");

    if($check_area->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El área no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_area->fetch();
    }
    $check_area=null;

    /* Almacenando datos */
    $nombre=limpiar_cadena($_POST['area_nombre']);
    


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
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{3,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    
    /* Verificando nombre */
    if($nombre!=$datos['area_nombre']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT area_nombre From area Where area_nombre='$nombre'");
	    if($check_nombre->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_nombre=null;
    }


    /* Actualizar datos */
    $actualizar_area=conexion();
    $actualizar_area=$actualizar_area->prepare("UPDATE area Set area_nombre=:nombre Where area_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":id"=>$id
    ];

    if($actualizar_area->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Categoria Actualizada!</strong><br>
                El área se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar la categoría, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_area=null;