<?php
	require_once "main.php";

	/* Almacenando id */
    $id=limpiar_cadena($_POST['posicion_id']);


    /* Verificando posición */
	$check_posicion=conexion();
	$check_posicion=$check_posicion->query("SELECT * From posicion Where posicion_id='$id'");

    if($check_posicion->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                La posición no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_posicion->fetch();
    }
    $check_posicion=null;

    /* Almacenando datos */
    $posicion=limpiar_cadena($_POST['posicion_posicion']);
    


    /* Verificando campos obligatorios */
    if($posicion==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    /* Verificando integridad de los datos */
    if(verificar_datos("[a-zA-Z0-9-]{2,50}",$posicion)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                La posición no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    
    /* Verificando posición */
    if($posicion!=$datos['posicion_posicion']){
	    $check_posicion=conexion();
	    $check_posicion=$check_posicion->query("SELECT posicion_posicion From posicion Where posicion_posicion='$posicion'");
	    if($check_posicion->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
	                La posición ingresada ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_posicion=null;
    }


    /* Actualizar datos */
    $actualizar_posicion=conexion();
    $actualizar_posicion=$actualizar_posicion->prepare("UPDATE posicion Set posicion_posicion=:posicion Where posicion_id=:id");

    $marcadores=[
        ":posicion"=>$posicion,
        ":id"=>$id
    ];

    if($actualizar_posicion->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡Categoria Actualizada!</strong><br>
                La posición se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Lo sentimos, ocurrio un error inesperado!</strong><br>
                No se pudo actualizar la posicion, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_posicion=null;